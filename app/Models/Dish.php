<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function dishRestaurant()
    {
        return $this->belongsTo('App\Models\Restaurant', 'restaurant_id', 'id');
    }

    public function restaurantsDishes()
   {
       return $this->hasMany('App\Models\Dish', 'restaurant_id', 'id');
   }

}
