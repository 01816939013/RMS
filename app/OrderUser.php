<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    protected $table = 'order_user';
    protected $fillable = ['order_id', 'user_id'];
}
