<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'number',
        'photo',
        'department',
        'designation',
        'employee_id',
        'permission',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    private static $user, $users;

    public static function updateUser($request, $id)
    {
        try {
            self::$user = User::find($id);
            self::saveBasicInfo(self::$user, $request);
            self::$user->save();
        } catch (ModelNotFoundException $e) {
            return view('error');
        }
    }

    private static function saveBasicInfo($user, $request)
    {
        self::$user->name                   = $request->name;
        self::$user->email                  = $request->email;
        self::$user->employee_id            = $request->employee_id;
        self::$user->number                 = $request->number;
        self::$user->department             = $request->department;
        self::$user->designation            = $request->designation;
    }

}
