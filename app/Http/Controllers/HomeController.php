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

        $topFavoriteMenus = Menu::withCount('likes')
            ->orderByDesc('likes_count')
            ->limit(3)
            ->get();

        return view('home', compact('menus', 'promos', 'testimonials', 'topFavoriteMenus'));
    }
}
