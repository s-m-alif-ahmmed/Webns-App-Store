<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\Permission;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
//            $permissionData = json_decode(Auth::user()->permission, true);
//            if($permissionData && isset($permissionData['users_all']['employ_all']['employ_permission']) && $permissionData['users_all']['employ_all']['employ_permission'] == 'employ_permission'){
                $decryptID = Crypt::decryptString($id);
                return view('admin.crud.users.permissions',[
                    'user' => User::find($decryptID),
                ]);
//            }else{
//                return view('admin.error.error');
//            }
        }catch (DecryptException $e){
            $decryptID = Crypt::decryptString($id);
            return view('admin.error.error',[
                'user' => User::find($decryptID),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Get the user
            $user = User::find($id);

            // Convert array of permissions to JSON
            $permissions = json_encode($request->input('permission'));

            // Update user's permission
            $user->update(['permission' => $permissions]);

            Permission::updatePermission($request, $id);

            return back()->with('message','User permission info update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }
}
