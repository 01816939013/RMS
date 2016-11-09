<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['title', 'description', 'status', 'image', 'rate', 'customer_id', 'order_id'];
}
