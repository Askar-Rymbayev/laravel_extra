<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $casts = [
        'fields' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
