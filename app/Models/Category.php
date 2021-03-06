<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static $defaultPhoto = 'defaults/categories/default.png';

    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
