<?php

namespace App\Http\Controllers;

use App\Models\ProfilePhoto;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.dashboard.setting',['users' => User::all()]);
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.dashboard.setting');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'photo' => [
                    'required',
                    'unique:' . User::class . ',photo,NULL,id', // Adjust the column names and table name as needed
                ],
            ], [
                'photo.unique' => 'This image already taken.',
            ]);

            ProfilePhoto::createProfilePhoto($request);
            return back()->with('message','Profile info save successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            return view('admin.dashboard.settings',[
                'user' => User::find($id),
            ]);
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
            ProfilePhoto::updateProfilePhoto($request, $id);
            return back()->with('message', 'Profile info updated successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProfilePhoto::deleteProfilePhoto($id);
            return back()->with('message', 'Profile info remove successfully.');
        }catch (DecryptException $e){
            return view('admin.error.error');
        }
    }
}
