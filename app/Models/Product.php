<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function seller(){
        return $this->belongsTo(User::class);
    }

    public function sub_admin(){
        return $this->belongsTo(SubAdmin::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    
    public function reviewUser(): HasManyThrough{
        return $this->hasManyThrough(User::class, Review::class, 'reviewable_id','');
    }
 
    public $timestamps = false;
    protected $guarded = [];
}
