<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nursling extends Model
{
    protected $fillable = ['nickname', 'address', 'phone', 'bredd', 'owner_name', 'user_id', 'category_id', 'created_at', 'updated_at'];
}
