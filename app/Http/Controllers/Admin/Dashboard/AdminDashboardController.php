<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
   public function dashboard()
   {
       try {
           $user_name = Auth::user()->name;
           $users = User::all();
           return view('admin.dashboard.dashboard', compact('user_name', 'users'));
       } catch (DecryptException $e) {
           return view('admin.error.error');
       }
   }
}
