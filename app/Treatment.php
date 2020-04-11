<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = ['complaint', 'status', 'nursling_id', 'created_at', 'updated_at'];
}
