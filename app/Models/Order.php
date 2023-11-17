<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_id',
        
        // 'status',
    ];


    
    // public function roles(){
    //     return $this->hasOneThrough(Role::class, User::class,'role');
    // }

    public function products(){
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id')->withPivot('quantity');
    }
}
