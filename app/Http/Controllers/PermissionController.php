<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('user_role')->where('role', '!=', 1)->get();
        return view('admin.seller.list', compact('users'));
    }

    public function approve($sellerId)
    {
        $user = User::findOrFail($sellerId);

        $user->update(['email_verified' => 1, 'token' => null]);
        flash()->addSuccess('User has been approved');

        return redirect()->route('user');
    }


    public function disapprove($sellerId)
    {
        $user = User::findOrFail($sellerId);

        $user->update(['email_verified' => null]);
        flash()->addSuccess('User has been disapproved');

        return redirect()->route('user');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request, $sellerId)
    {
        $user = User::findOrFail($sellerId);
      
        $selectedPermissions = $request->input('permissions',[]);
        $permissionId =   collect($selectedPermissions)->map(function ($permissionName){
                return Permission::firstOrCreate(['name'=>$permissionName])->id; 
                 });

            $user->permissions()->sync($permissionId);

        return redirect()->route('user');
    }


    public function create($sellerId)
    {
        $permissions = Permission::with(['seller'=>fn($q)=>$q->where('seller_id', $sellerId)])->get(); // here it filters within the relation 
        // $permissions = Permission::with('seller')->whereHas('seller', fn($q)=>$q->where('seller_id', $sellerId))->get(); // here it filters over all queries like it retrives that records who assign to the seller 
        // $permissions = Permission::with('seller')->get(); // here it retrives all the permission based on the seller 

        $seller = User::with('permissions')->findOrFail($sellerId);
        return view('admin.seller.create', compact('seller', 'permissions'));
    }


    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
