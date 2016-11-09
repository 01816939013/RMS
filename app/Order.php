<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['total', 'status', 'cahIn', 'payment', 'change', 'customer_id'];
}
