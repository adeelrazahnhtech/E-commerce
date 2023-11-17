<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id', 'id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'userpackages', 'user_id', 'package_id')->withPivot('created_at');
    }

  
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function reviews(){
        return $this->morphMany(Review::class,'reviewable');
    }

    public function user_role(){
        return $this->belongsTo(Role::class , 'role','id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'token',
        'password',
        'email_verified',
    ];

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
        'password' => 'hashed',
    ];

    // ACCESSOR
    protected $appends = ['order','review'];
    // public function getOrderAttribute()   // accessor for single product
    // {
    //     return auth()->user()->orders->whereHas('products', fn($q) => $q->where('product_id', request()->product))->exists();
    // }

    // public function getReviewAttribute(){
    //     return auth()->user()->reviews->where('product_id', request()->product)->exists();
    // }
}
