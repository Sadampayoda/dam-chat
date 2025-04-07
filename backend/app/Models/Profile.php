<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ['id'];


    public function userDesc()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
