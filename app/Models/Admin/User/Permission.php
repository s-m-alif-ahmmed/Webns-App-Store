<?php

namespace App\Models\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Permission extends Model
{
    use HasFactory;

    private static $user, $users, $permission, $permissions;

    public static function updatePermission($request, $id)
    {
        try {
            self::$user = User::find($id);
            self::saveBasicInfo(self::$user, $request);
            self::$user->update();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    private static function saveBasicInfo($user, $request)
    {
        self::$user->permission                  = $request->permission;
    }

}
