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
    // public function isAdmin(User $user){
    //    return $user->email === 'admin@gmail.com' 
    //    ? Response::allow() : Response::deny('you don"t modify this post');
    // }

    public function productStore(User $user){
        return $user->email === 'admin@gamil.com' ? Response::allow() : Response::deny('you are not allowed to store');
    }

    // public function __construct(User $user)
    // {
    //     //
    // }
}
