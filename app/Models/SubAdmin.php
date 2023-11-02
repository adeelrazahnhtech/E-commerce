<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class SubAdmin extends Model
{

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
    
}
