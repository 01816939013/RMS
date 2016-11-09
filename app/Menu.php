<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'menus';
    protected $fillable = ['title', 'type', 'description', 'status', 'image', 'user_id'];
}
