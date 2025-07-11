<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image_url',
    ];
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_menu')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
    protected function displayImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = $this->image_url;

                if (Storage::disk('public')->exists($path)) {
                    return Storage::disk('public')->url($path);
                }

                if (file_exists(public_path('assets/img/menu/' . $path))) {
                    return asset('assets/img/menu/' . $path);
                }
            },
        );
    }

    public function likes(): HasMany
{
    return $this->hasMany(MenuLike::class);
}
}


