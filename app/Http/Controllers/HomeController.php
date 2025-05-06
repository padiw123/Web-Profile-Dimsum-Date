<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        $menus = Menu::all();
        return view('welcome', compact('menus', 'promos'));
    }
}
