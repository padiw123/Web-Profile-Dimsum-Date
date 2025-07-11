<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuLikeController extends Controller
{
    public function toggleLike(Menu $menu)
    {
        $like = MenuLike::where('user_id', Auth::id())->where('menu_id', $menu->id)->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            MenuLike::create([
                'user_id' => Auth::id(),
                'menu_id' => $menu->id,
            ]);
            $isLiked = true;
        }

        return response()->json([
            'is_liked' => $isLiked,
            'likes_count' => $menu->likes()->count(),
        ]);
    }
}
