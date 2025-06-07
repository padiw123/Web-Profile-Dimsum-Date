<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil order milik user yang login, urutkan dari yang terbaru
        // Eager load relasi 'menus' untuk menghindari N+1 problem
        $orders = $user->orders()->with('menus')->latest()->paginate(10);

        return view('history.list', compact('orders'));
    }

    public function show(Order $order)
    {
        // Untuk keamanan, pastikan pengguna yang login
        // hanya bisa melihat riwayat pesanannya sendiri.
        if (Auth::id() !== $order->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // Mengirim data order ke view 'history.detail'
        return view('history.detail', compact('order'));
    }
}
