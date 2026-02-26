<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   protected $fillable = [
    'first_name',
    'last_name',
    'username',
    'email',
    'phone',
    'role_id',
    'state_id',
    'profile_image',
    'bio',
    'password',
];

public function role()
{
    return $this->belongsTo(Role::class);
}

public function state()
{
    return $this->belongsTo(State::class);
}

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
{
    return $this->hasMany(Post::class);
}


}
