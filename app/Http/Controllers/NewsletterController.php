<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        Newsletter::create(['email' => $request->email]);

        // Kirim email ke kamu (ganti alamat emailmu di bawah)
        Mail::raw('Ada subscriber baru: ' . $request->email, function ($message) use ($request) {
            $message->to('2200018174@webmail.uad.ac.id') // Ganti dengan emailmu
                    ->subject('Subscriber Baru dari Website');
        });

        return back()->with('success', 'Terima kasih telah berlangganan!');
    }
}

