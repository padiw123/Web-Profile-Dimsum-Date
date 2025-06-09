<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    // Menampilkan semua testimoni dari semua user
    public function index()
    {
        $testimonials = Testimonial::with('user')->latest()->get();
        return view('testimoni.list', compact('testimonials'));
    }

    // Menampilkan halaman untuk menulis review
    public function create()
    {
        return view('testimoni.review');
    }

    // Menyimpan review baru
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('testimonial.history')->with('success', 'Terima kasih atas ulasan Anda!');
    }

    // Menampilkan riwayat testimoni user yang sedang login
    public function history()
    {
        $testimonials = Testimonial::where('user_id', Auth::id())->latest()->get();
        return view('testimoni.riwayat', compact('testimonials'));
    }

}
