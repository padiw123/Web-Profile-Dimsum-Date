<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class);
    }
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'order_menu')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
