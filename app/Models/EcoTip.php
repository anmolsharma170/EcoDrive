<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoTip extends Model
{
    protected $fillable = ['title', 'description', 'category', 'image_url', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
