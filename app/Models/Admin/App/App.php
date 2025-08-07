<?php

namespace App\Models\Admin\App;

use App\Models\Admin\Company\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class App extends Model
{
    use HasFactory;

    private static $app, $apps;
    private static $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image            = $request->file('image');
            self::$imageName        = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory        = "admin/images/app/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl         = self::$directory . self::$imageName;
            return self::$imageUrl;
        } catch (\Exception $e) {
            // Log or handle the exception accordingly
            return view('admin.error.error');
        }
    }

    public static function createApp($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$app      = new App();
            self::saveBasicInfo(self::$app, $request, self::$imageUrl);
            self::$app->save();

            return self::$app;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateApp($request, $id)
    {
        try {
            self::$app = App::find($id);

            if($request->file('image'))
            {
                if(file_exists(self::$app->image)){
                    unlink(self::$app->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$app->image;
            }
            self::saveBasicInfo(self::$app, $request, self::$imageUrl);
            self::$app->save();
            return self::$app;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($app){
            $app->app_slug = Str::slug($app->name, '-');
        });
        self::updating(function($app){
            $app->app_slug = Str::slug($app->name, '-');
        });
    }

    public static function deleteApp($id)
    {
        try {
            self::$app = App::find($id);
            if (file_exists(self::$app->image))
            {
                unlink(self::$app->image);
            }
            self::$app->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($app, $request, $imageUrl)
    {
        $app->name          = $request->name;
        $app->image         = $imageUrl;
        $app->alt           = $request->alt;
        $app->description   = $request->description;
        $app->user_id       = $request->user_id;
        $app->company_id    = $request->company_id;
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
