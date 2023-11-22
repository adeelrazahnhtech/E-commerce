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

    public function index(User $user) {
        
        return in_array('product_index', auth()->user()->permissions->pluck('name')->toArray())
                       ? Response::allow() 
                       : Response ::deny('You are not authorized to view all records');
        // dd(auth()->user()->permissions->toArray(), auth()->user()->permissions->pluck('name')->toArray());
    }
    
    public function create(User $user)
    {
        foreach (auth()->user()->permissions as $permission) {
            if($permission->name === 'product_create'){
                return Response::allow();
            }
        }
        return Response::deny('You are not authorized to create the product');

    }


    public function store(User $user){
        return in_array('product_store',auth()->user()->permissions->pluck('name')->toArray()) 
                        ? Response::allow() 
                        : Response::deny('You are not authorized to store the product');
    }


    public function edit(User $user){
        foreach (auth()->user()->permissions as $permission) {
            if($permission->name == 'product_edit'){
                return Response::allow();
            }
        }
        return Response::deny("You are not allowed to edit the product");
    }


    public function update(User $user){
        return in_array('product_update', auth()->user()->permissions->pluck('name')->toArray()) 
                        ? Response::allow()
                        : Response::deny("You are not allowed to update the product");
    }

    public function destroy(User $user){
        return in_array('product_delete', auth()->user()->permissions->pluck('name')->toArray()) 
                        ? Response::allow()
                        : Response::deny("You are not allowed to delete the product");
    }

    // public function __construct(User $user)
    // {
    //     //
    // }
}
