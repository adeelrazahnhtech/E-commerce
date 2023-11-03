<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $fillable = [
        'rating',
        'review',
        // 'user_id',
        'product_id',
        'reviewable_type',
        'reviewable_id',
        'status',
    ];
    //defines the polymorphic reltionship in the review model
        public function reviewable()
        {  
             return $this->morphTo();
        }

    // public function product(){
    //     return $this->belongsTo(Product::class);
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
