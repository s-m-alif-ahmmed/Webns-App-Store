<?php

namespace App\Models\Admin\App;

use App\Models\Admin\Company\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppUpload extends Model
{
    use HasFactory;

    private static $app_upload, $app_uploads;
    private static $apk, $apkDirectory, $apkName, $apkUrl;

    public static function uploadApk($request, $app_id, $company_id)
    {
        try {
            if ($request->hasFile('apk')) {
                $app = App::findOrFail($app_id);
                $company = Company::findOrFail($company_id);

                self::$apk = $request->file('apk');
                self::$apkName = self::$apk->getClientOriginalName();
                self::$apkDirectory = "admin/app/apk/{$company->company_code}/{$app->app_slug}/";
                self::$apk->move(self::$apkDirectory, self::$apkName);
                self::$apkUrl         = self::$apkDirectory . self::$apkName;
                return self::$apkUrl;
            }
        } catch (\Exception $e) {
            // Log or handle the exception accordingly
            return view('admin.error.error');
        }
    }

    public static function createAppUpload($request)
    {
        try {
            $app_id = $request->app_id;
            $company_id = $request->company_id;

            self::$apkUrl = $request->file('apk') ? self::uploadApk($request, $app_id, $company_id) : null;

            self::$app_upload = new AppUpload();
            self::saveBasicInfo(self::$app_upload, $request, self::$apkUrl);
            self::$app_upload->save();

            return self::$app_upload;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateAppUpload($request, $id)
    {
        try {
            self::$app_upload = AppUpload::findOrFail($id);
            $app_id = $request->app_id;
            $company_id = $request->company_id;

            // Update APK if a new file is uploaded
            if($request->file('apk'))
            {
                if(file_exists(self::$app_upload->apk)){
                    unlink(self::$app_upload->apk);
                }
                self::$apkUrl = self::uploadApk($request, $app_id, $company_id);
            }
            else{
                self::$apkUrl = self::$app_upload->apk;
            }

            // Update basic information and save the record
            self::saveBasicInfo(self::$app_upload, $request, self::$apkUrl);
            self::$app_upload->save();
            return self::$app_upload;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }


    public static function deleteAppUpload($id)
    {
        try {
            self::$app_upload = AppUpload::find($id);
            if (file_exists(self::$app_upload->apk))
            {
                unlink(self::$app_upload->apk);
            }
            self::$app_upload->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($app_upload, $request, $apkUrl)
    {
        $app_upload->apk_version    = $request->apk_version;
        $app_upload->user_id        = $request->user_id;
        $app_upload->app_id         = $request->app_id;
        $app_upload->company_id     = $request->company_id;
        $app_upload->apk            = $apkUrl;
    }


    public function app()
    {
        return $this->belongsTo(App::class, 'app_id');
    }
    public function apps()
    {
        return $this->belongsToMany(App::class);
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
