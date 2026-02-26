<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
     protected $fillable = ['name'];
    public function users()
{
    return $this->hasMany(User::class);
}

public function posts()
{
    return $this->hasMany(Post::class);
}
}
