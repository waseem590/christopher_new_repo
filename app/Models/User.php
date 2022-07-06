<?php

namespace App\Models;

use App\Models\Offers\Offers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'email_code',
        'phone_code',
        'password',
        'code',
        'isLogin',
        'role',
        'is_email_verified',
        'is_phone_verified',
        'request_token',
        'reset_token',
        'funds',
        'fcm_token'
    ];

    public function user_offers()
    {
        return $this->hasMany(Offers::class,'user_id','id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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

    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user_methods(){
        return $this->belongsToMany(method::class, 'user_method','user_id','method_id')->withPivot('cash_tag');
    }
}
