<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
     'name',
     'image',
    ];

    public function setNameAttribute($value){    // mutator
        $this->attributes['name'] = strtoupper($value);
    }

    public function getNameAttribute($value){    // accessor
        return "Mr " . $value;
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
    public $timestamps = false;
}
