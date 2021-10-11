<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
