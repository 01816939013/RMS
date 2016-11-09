<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMeal extends Model
{
    protected $table = 'order_meal';
    protected $fillable = ['order_id', 'meal_id'];
}
