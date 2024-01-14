<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStore extends Model
{
    use HasFactory;

    protected $table = 'users_stores';

    protected $fillable = [
        'user_id', 'name', 'phone', 'address', 'city', 'state', 'postcode', 'current_location', 'description', 'food_cert_number', 'food_cert', 'account_number', 'sort_code', 'bank', 'availability', 'logo', 'cover_image', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'store_id');
    }
}
