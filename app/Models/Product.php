<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'store_id', 'name', 'price', 'cuisine', 'category', 'description', 'measurement', 'image1', 'image2', 'availability', 
    ];

    public function userstore()
    {
        return $this->belongsTo(UserStore::class, 'store_id');
    }
}
