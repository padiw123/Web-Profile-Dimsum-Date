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
        $menus = Menu::with('likes')->get();
        $testimonials = Testimonial::with('user')->latest()->take(8)->get();
<<<<<<< HEAD
        $favoritMenuIds = Auth::check() 
            ? Auth::user()->favorits()->pluck('menu_id')->toArray()
            : [];
        return view('home', compact('menus', 'promos', 'testimonials', 'favoritMenuIds'));
        
=======

        $topFavoriteMenus = Menu::withCount('likes')
            ->orderByDesc('likes_count')
            ->limit(3)
            ->get();

        return view('home', compact('menus', 'promos', 'testimonials', 'topFavoriteMenus'));
>>>>>>> 5626a3260b67958f190755272fdc4bb4971435c0
    }
}
