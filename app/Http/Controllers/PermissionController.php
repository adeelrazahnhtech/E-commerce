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
       $sellers = User::with('user_role')->where('role','=',2)->get();
       return view('admin.seller.list',compact('sellers'));
    }

    public function approve($sellerId)
    {
      $user = User::findOrFail($sellerId);

          $user->update(['email_verified' => 1]);
          flash()->addSuccess('Seller has been approved');

      return redirect()->route('seller');
    }


    public function disapprove($sellerId)
    {
      $user = User::findOrFail($sellerId);

        $user->update(['email_verified' => 0]);
      flash()->addSuccess('Seller has been disapproved');

      return redirect()->route('seller');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
     
        return view('admin.seller.create');
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
