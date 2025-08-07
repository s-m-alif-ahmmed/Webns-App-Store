<?php

namespace App\Models\Admin\Industry;

use App\Models\Admin\Client\ClientCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Industry extends Model
{
    use HasFactory;


    private static $industries, $industry;

    public static function createIndustry($request)
    {
        try {
            self::$industry       = new Industry();
            self::saveBasicInfo(self::$industry, $request);
            self::$industry->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateIndustry($request, $id)
    {
        try {
            self::$industry = Industry::find($id);
            self::saveBasicInfo(self::$industry, $request);
            self::$industry->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteIndustry($id)
    {
        try {
            self::$industry = Industry::find($id);
            self::$industry->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($industry){
            $industry->industry_slug = Str::slug($industry->name, '-');
        });
        self::updating(function($industry){
            $industry->industry_slug = Str::slug($industry->name, '-');
        });
    }

    private static function saveBasicInfo($industry, $request)
    {
        self::$industry->name     = $request->name;
        self::$industry->user_id  = $request->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
