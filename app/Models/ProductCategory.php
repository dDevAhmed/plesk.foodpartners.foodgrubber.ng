<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $connection = 'foodgrubber_admin';
    protected $table = 'categories'; 

    // todo - use in any controller that will call categories = product
    // public function index()
    // {
    //     $foodpartners = FoodPartner::all();
    //     // $newFoodpartners = FoodPartner::where('application_status', '0')->get();
    //     $newFoodpartners = FoodPartner::where('id', '1')->get();

    //     return view('people\foodpartners', [
    //         'foodpartners' => $foodpartners,
    //         'newFoodpartners' => $newFoodpartners,
    //     ]);
    // }

}
