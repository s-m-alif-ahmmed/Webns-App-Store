<?php

namespace App\Models\Admin\Company;

use App\Models\Admin\App\App;
use App\Models\Admin\Industry\Industry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;

    private static $company, $companies, $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/company/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory . self::$imageName;
            return self::$imageUrl;
        } catch (\Exception $e) {
            // Log or handle the exception accordingly
            return view('admin.error.error');
        }
    }

    public static function createCompany($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$company = new Company();
            self::saveBasicInfo(self::$company, $request, self::$imageUrl);
            self::$company->save();

            return self::$company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateCompany($request, $id)
    {
        try {
            self::$company = Company::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$company->image)){
                    unlink(self::$company->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$company->image;
            }

            self::saveBasicInfo(self::$company, $request, self::$imageUrl);
            self::$company->save();
            return self::$company;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($company){
            $company->company_slug = Str::slug($company->name, '-');
            $company->company_code = self::generateRandomCode(15);
        });
        self::updating(function($company){
            $company->company_slug = Str::slug($company->name, '-');
        });
    }

    private static function generateRandomCode($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function deleteCompany($id)
    {
        try {
            self::$company = Company::find($id);
            if (file_exists(self::$company->image))
            {
                unlink(self::$company->image);
            }
            self::$company->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($company, $request, $imageUrl)
    {
        $company->image         = $imageUrl;
        $company->alt           = $request->alt;
        $company->name          = $request->name;
        $company->user_id       = $request->user_id;
        $company->industry_id   = $request->industry_id;
    }


    public function industry()
    {
        return $this->belongsTo(Industry::class,'industry_id');
    }

    public function apps()
    {
        return $this->hasMany(App::class, 'company_id');
    }

    public function industries()
    {
        return $this->belongsToMany(Industry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
