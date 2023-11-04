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

    public function reviews(){
        return $this->morphMany('App\\Models\\Review'::class,'reviewable');
    }

    public function products()
    {
        return $this->hasMany(Product::class,  'sub_admin_id','id');
    }

    public function user_role(){
        return $this->belongsTo(Role::class ,'role', 'id');
    }

    
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
