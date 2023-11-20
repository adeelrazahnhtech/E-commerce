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
        $sellers = User::with('user_role')->where('role', '=', 2)->get();
        return view('admin.seller.list', compact('sellers'));
    }

    public function approve($sellerId)
    {
        $user = User::findOrFail($sellerId);

        $user->update(['email_verified' => 1, 'token' => null]);
        flash()->addSuccess('Seller has been approved');

        return redirect()->route('seller');
    }


    public function disapprove($sellerId)
    {
        $user = User::findOrFail($sellerId);

        $user->update(['email_verified' => null]);
        flash()->addSuccess('Seller has been disapproved');

        return redirect()->route('seller');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function store(Request $request, $sellerId)
    {
        $user = User::findOrFail($sellerId);
        $selectedPermissions = $request->input('permissions', []);
        foreach ($selectedPermissions as $permission) {

            $permission = Permission::firstOrCreate(['name' => $permission]);
        }
        $user->permissions()->attach($permission->id);

        return redirect()->route('seller');
    }


    public function create($sellerId)
    {
        $permissions = Permission::with(['seller'=>fn($q)=>$q->where('seller_id', $sellerId)])->get();
        // dd($permissions);
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
