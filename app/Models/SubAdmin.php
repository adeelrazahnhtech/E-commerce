<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;



class SubAdmin extends Authenticatable
{
    use  HasFactory;

    public function setPasswordAttribute($value){
        $this->attributes["password"] = Hash::make($value);
    }

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'role',
        'token',
        'password',
        'email_verified',
    ];

    
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
        'password' => 'hashed',
    ];
}
