<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user){
        return in_array('seller_edit',auth()->user()->permissions->pluck('name')->toArray())
                        ? Response::allow()
                        : Response::deny('You are not allowed to edit the seller');
    }

    public function update(User $user){
        return in_array('seller_update',auth()->user()->permissions->pluck('name')->toArray())
                        ? Response::allow()
                        : Response::deny('You are not allowed to update the seller');
    }

    public function delete(User $user){
      foreach(auth()->user()->permissions as $permission){
        if($permission->name === 'seller_delete'){
              return Response::allow();
            }

          }
          return Response::deny('You are not allowed to delete the seller');
  }
}
