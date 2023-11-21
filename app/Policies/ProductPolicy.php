<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\SellerPermission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    
    public function productStore(User $user, SellerPermission $sellerPermission){
        return $user->id === $sellerPermission->seller_id 
        ? Response::allow() 
        : Response::deny('you are not authorized to store');
    }
    public function isAdmin(User $user){
       return $user->email === 'admin@gmail.com' 
       ? Response::allow() : Response::deny('you dont authorize this post');
    }

    public function productUpdate(User $user){
        return $user->role === 2 ? Response::allow() : Response::deny('you are not allowed to store');
    }
    // public function __construct(User $user)
    // {
    //     //
    // }
}
