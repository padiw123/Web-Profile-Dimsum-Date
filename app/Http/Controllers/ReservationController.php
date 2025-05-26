<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function sendReservation(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|string',
            'message' => 'nullable|string',
            'ordered_items_summary' => 'nullable|string',
            'total_payment' => 'nullable|string'
        ]);

        // Nomor WhatsApp restoran
        $restaurant_phone = '6282179577950';

        // Susun pesan dalam format teks biasa (bukan URL-encoded)
        $whatsapp_message =
            "*Reservation Request*\n\n" .
            "*Name:* {$validated['name']}\n" .
            "*Email:* {$validated['email']}\n" .
            "*Phone:* {$validated['phone']}\n" .
            "*Date:* {$validated['date']}\n" .
            "*Time:* {$validated['time']}\n" .
            "*Guests:* {$validated['guests']}\n" .
            "*Message:* " . ($validated['message'] ?? '-'). "\n\n" .
            "*Order Summary:*\n" .
            ($validated['ordered_items_summary'] ?? 'No items selected') . "\n\n" .
            "*Total Payment:* " . ($validated['total_payment'] ?? 'Rp 0');

        // Encode pesan untuk digunakan dalam URL
        $encoded_message = rawurlencode($whatsapp_message);

        // Redirect ke WhatsApp
        return redirect()->away("https://wa.me/{$restaurant_phone}?text={$encoded_message}");
    }
}
