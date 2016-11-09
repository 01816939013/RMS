<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';
    protected $fillable = ['title', 'description', 'status', 'image', 'price', 'user_id'];
}
