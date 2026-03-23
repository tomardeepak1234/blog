<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use App\Models\Commentlikes;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'comment','parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // parent comment
public function parent()
{
    return $this->belongsTo(Comment::class, 'parent_id');
}

// replies
public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}

// comment likes

public function likes()
{
    return $this->hasMany(CommentLikes::class);
}
}
