<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'price_note',
        'features',
        'cta_link',
        'discount_type',
        'discount_value'
    ];

    protected $casts = [
        'features' => 'array',
        'discount_value' => 'float'
    ];
}
