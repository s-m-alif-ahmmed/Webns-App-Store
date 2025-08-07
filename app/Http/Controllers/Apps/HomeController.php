<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Admin\App\App;
use App\Models\Admin\App\AppUpload;
use App\Models\Admin\Company\Company;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function company($company_code)
    {
        $company = Company::where('company_code', $company_code)->firstOrFail();
        $apps = App::where('company_id', $company->id)->get();
        $app_ids = $apps->pluck('id');

        $app_uploads = AppUpload::whereIn('app_id', $app_ids)->get();

        return view('apps.pages.company', [
            'company' => $company,
            'apps' => $apps,
            'app_uploads' => $app_uploads,
        ]);
    }

//    public function companyApp($company_code, $app_slug)
//    {
//        $company = Company::where('company_code', $company_code)->firstOrFail();
//        $app = App::where('company_id', $company->id)->where('app_slug', $app_slug)->firstOrFail();
//        $app_uploads = AppUpload::where('app_id', $app->id)->get();
//
//        return view('apps.pages.company-app', [
//            'app' => $app,
//            'app_uploads' => $app_uploads,
//        ]);
//    }




    public function error()
    {
        return view('apps.error.error');
    }
}
