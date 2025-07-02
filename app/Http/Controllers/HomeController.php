<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promo;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        $menus = Menu::all();
        $testimonials = Testimonial::with('user')->latest()->take(8)->get();
        $favoritMenuIds = Auth::check() 
            ? Auth::user()->favorits()->pluck('menu_id')->toArray()
            : [];
        return view('home', compact('menus', 'promos', 'testimonials', 'favoritMenuIds'));
        
    }
}
