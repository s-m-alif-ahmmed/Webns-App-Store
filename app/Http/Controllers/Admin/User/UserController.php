<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\User\Department;
use App\Models\Admin\User\Designation;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Show all users resource.
     */
    public function users()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_all']['employ_manage']) && $permissionData['users_all']['employ_all']['employ_manage'] == 'employ_manage'){
                return view('admin.crud.users.manage',[
                    'users' => User::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show user detail resource.
     */
    public function profile($id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            return view('admin.dashboard.profile',[
                'user' => User::find($decryptID),
            ]);
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show user detail resource.
     */
    public function profileEdit($id)
    {
        try{
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['user_profile']['profile_edit']) && $permissionData['user_profile']['profile_edit'] == 'profile_edit'){
                $decryptID = Crypt::decryptString($id);
                return view('admin.dashboard.edit',[
                    'user' => User::find($decryptID),
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show the user detail resource.
     */
    public function usersDetail($id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_all']['employ_detail']) && $permissionData['users_all']['employ_all']['employ_detail'] == 'employ_detail'){
                $decryptID = Crypt::decryptString($id);
                $user = User::find($decryptID);

                if (!$user) {
                    // Handle the case where the user is not found
                    return view('admin.error.error');
                }

                return view('admin.crud.users.detail',[
                    'user' => $user,
                ]);
            }else{
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show the user change password resource.
     */
    public function password($id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_all']['employ_password']) && $permissionData['users_all']['employ_all']['employ_password'] == 'employ_password'){
                $decryptID = Crypt::decryptString($id);
                $this->user = User::find($decryptID);
                return view('admin.crud.users.password',[
                    'user' => $this->user,
                ]);
            }else {
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * the user change password resource.
     */
    public function passwordChange(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:25',
                    'confirmed',
                ],
            ]);

            // Retrieve the user by ID
            $user = User::find($id);

            if (!$user) {
                // Handle the case where the user is not found
                return back()->with('message', 'User not found.');
            }

            // Check if the password and password confirmation match
            if ($request->input('password') !== $request->input('password_confirmation')) {
                // Handle the case where the passwords do not match
                return back()->with('message', 'Password and confirmation do not match.');
            }

            // Update the user's password
            $user->forceFill([
                'password' => Hash::make($request->input('password')),
            ])->save();

            return back()->with('message', 'Password changed successfully.');
        } catch (DecryptException $e) {
            // Handle decryption errors
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['users_all']['employ_all']['employ_edit']) && $permissionData['users_all']['employ_all']['employ_edit'] == 'employ_edit'){
                $decryptID = Crypt::decryptString($id);
                return view('admin.crud.users.edit',[
                    'user' => User::find($decryptID),
                ]);
            }else {
                return view('admin.error.error');
            }
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            User::updateUser($request, $id);
            return back()->with('message','User info update successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * delete the specified resource in storage.
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect('/admin/users')->with('message', 'User not found.');
            }

            $user->delete();

            return redirect('/admin/users')->with('message', 'User delete successfully');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    public function dashboardError()
    {
        try {
            return view('admin.error.error');
        }catch (DecryptException $e) {
            return abort(404);
        }
    }


}
