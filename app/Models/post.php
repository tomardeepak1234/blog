<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Postlike;
use  App\Models\comment;

class Post extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'state_id'
    ];

    protected $table='posts';
    
      public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function state()
{
    return $this->belongsTo(State::class);
}
    
       public function likes()
    {
        return $this->hasMany(PostLike::class,'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

