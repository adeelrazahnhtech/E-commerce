<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAdmin extends Model
{
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
