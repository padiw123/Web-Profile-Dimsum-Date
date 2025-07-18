<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function reserve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email',
            'phone'                 => 'required|string|max:20',
            'date'                  => 'required|date',
            'time'                  => 'required',
            'service_type'          => 'required|string|in:dine_in,take_away',
            'guests'                => 'required_if:service_type,dine_in|nullable|string',
            'payment_method'        => 'required|string|in:cash,qris,cimb,mandiri',
            'message'               => 'nullable|string',
            'ordered_items_summary' => 'required|string',
            'total_payment'         => 'required|string',
            'order_items'           => 'required|json',
            'promo_id'              => 'nullable|exists:promos,id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $validated = $validator->validated();
        $orderItems = json_decode($validated['order_items'], true);

        if (empty($orderItems)) {
            return back()->with('error', 'Keranjang pesanan tidak boleh kosong.')->withInput();
        }

        DB::beginTransaction();
        try {
            $menuIds = array_column($orderItems, 'menu_id');
            $menusInDb = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

            $subtotal = 0;
            foreach($orderItems as $item) {
                $menu = $menusInDb->get($item['menu_id']);
                if ($menu) {
                    $subtotal += $menu->price * $item['quantity'];
                }
            }

            $discountAmount = 0;
            $finalTotalPrice = $subtotal;
            $promoTitle = '';
            $appliedPromoId = null;

            if (!empty($validated['promo_id'])) {
                $promo = Promo::find($validated['promo_id']);

                if ($promo && $promo->discount_type && ($subtotal >= ($promo->price ?? 0))) {
                    $promoTitle = $promo->title;
                    $appliedPromoId = $promo->id;

                    if ($promo->discount_type === 'fixed') {
                        $discountAmount = $promo->discount_value;
                    } elseif ($promo->discount_type === 'percentage') {
                        $discountAmount = $subtotal * ($promo->discount_value / 100);
                    }
                    $finalTotalPrice = max(0, $subtotal - $discountAmount);
                }
            }

            $serviceType = $validated['service_type'];
            $notes = "";
            $reservationDetails = "";

            if ($serviceType === 'dine_in') {
                $notes = "Reservasi Dine In untuk {$validated['guests']} orang pada tanggal {$validated['date']} jam {$validated['time']}.";
                $reservationDetails = "*Detail Reservasi:*\n" .
                                    "Tanggal: {$validated['date']}\n" .
                                    "Waktu: {$validated['time']}\n" .
                                    "Jumlah Tamu: {$validated['guests']}\n\n";
            } else {
                $notes = "Pesanan Take Away untuk diambil pada tanggal {$validated['date']} jam {$validated['time']}.";
                $reservationDetails = "*Info Pengambilan:*\n" .
                                    "Tanggal: {$validated['date']}\n" .
                                    "Waktu: {$validated['time']}\n\n";
            }

            $order = Order::create([
                'user_id'         => $user->id,
                'status'          => 'pending',
                'total_price'     => $finalTotalPrice,
                'discount_amount' => $discountAmount,
                'promo_id'        => $appliedPromoId,
                'notes'           => $notes,
                'service_type'    => $serviceType,
                'payment_method'  => $validated['payment_method'],
                'payment_status'  => 'unpaid',
            ]);

            $pivotData = [];
            foreach($orderItems as $item) {
                $menu = $menusInDb->get($item['menu_id']);
                if ($menu) {
                    $pivotData[$item['menu_id']] = ['quantity' => $item['quantity'], 'price' => $menu->price];
                }
            }
            $order->menus()->attach($pivotData);

            DB::commit();

            $paymentDetailsMessage = "";
            if ($discountAmount > 0) {
                $paymentDetailsMessage = "*Subtotal:* Rp " . number_format($subtotal, 0, ',', '.') . "\n" .
                                         "*Diskon ({$promoTitle}):* -Rp " . number_format($discountAmount, 0, ',', '.') . "\n" .
                                         "*Total Pembayaran:* Rp " . number_format($finalTotalPrice, 0, ',', '.');
            } else {
                $paymentDetailsMessage = "*Total Pembayaran:* Rp " . number_format($finalTotalPrice, 0, ',', '.');
            }

            $whatsappMessage = "*Reservasi & Pesanan Baru*\n\n" .
                            "*Order ID:* #{$order->id}\n" .
                            "*Nama:* {$validated['name']}\n" .
                            "*Telepon:* {$validated['phone']}\n\n" .
                            "*Detail Reservasi:*\n" .
                            "Tanggal: {$validated['date']}\n" .
                            "Waktu: {$validated['time']}\n" .
                            $reservationDetails .
                            "*Rincian Pesanan:*\n" .
                            $validated['ordered_items_summary'] . "\n\n" .
                            $paymentDetailsMessage . "\n\n" .
                            "Mohon untuk segera diproses. Terima kasih.";

            $whatsappUrl = 'https://api.whatsapp.com/send?phone=62895803622422&text=' . urlencode($whatsappMessage);

            return redirect()->away($whatsappUrl);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Reservation Error: ' . $e->getMessage() . ' on line ' . $e->getLine());
            return back()->with('error', 'Terjadi kesalahan sistem saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }
}
