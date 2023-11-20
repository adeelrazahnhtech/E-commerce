<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{

    use HasFactory;
    protected $fillable = [
        'name'
    ];

    // public function users(){
    //     return $this->belongsToMany(User::class);
    // }

    public function seller(){
        return $this->hasOne(SellerPermission::class, 'permission_id', 'id');
    }
}
