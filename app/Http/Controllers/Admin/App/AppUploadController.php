<?php

namespace App\Http\Controllers\Admin\App;

use App\Http\Controllers\Controller;
use App\Models\Admin\App\App;
use App\Models\Admin\App\AppUpload;
use App\Models\Admin\Company\Company;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class AppUploadController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['app_upload']['app_upload_manage']) && $permissionData['app_upload']['app_upload_manage'] == 'app_upload_manage'){
                return view('admin.crud.app_upload.manage',[
                    'app_uploads' => AppUpload::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['app_upload']['app_upload_create']) && $permissionData['app_upload']['app_upload_create'] == 'app_upload_create'){
                return view('admin.crud.app_upload.index',[
                    'apps' => App::all(),
                    'companies' => Company::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    public function getAppByCompany(Request $request)
    {
        $companyId = $request->input('company_id');
        $apps = App::where('company_id', $companyId)->get();

        return response()->json($apps);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'apk_version' => ['nullable', 'string'],
                'apk' => ['nullable', 'file'],
                'app_id' => ['required', 'exists:apps,id'],
            ]);
            $this->app_upload = AppUpload::createAppUpload($request);
            return redirect('/app-upload')->with('message', 'App saved successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['app_upload']['app_upload_detail']) && $permissionData['app_upload']['app_upload_detail'] == 'app_upload_detail'){
                $decryptID = Crypt::decryptString($id);
                $app_upload = AppUpload::find($decryptID);

                if ($app_upload) {
                    return view('admin.crud.app_upload.detail', [
                        'app_upload' => $app_upload,
                    ]);
                } else {
                    return view('admin.error.error');
                }
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
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
            if($permissionData && isset($permissionData['app_upload']['app_upload_edit']) && $permissionData['app_upload']['app_upload_edit'] == 'app_upload_edit'){
                $decryptID = Crypt::decryptString($id);
                $app_upload = AppUpload::find($decryptID);

                if ($app_upload) {
                    return view('admin.crud.app_upload.edit', [
                        'app_upload' => $app_upload,
                        'apps' => App::all(),
                        'companies' => Company::all(),
                    ]);
                } else {
                    return view('admin.error.error');
                }
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            // Assuming $industry is the current industry record being edited
            $validated = $request->validate([
                'apk_version' => ['nullable', 'string'],
                'apk' => ['nullable', 'file'],
                'app_id' => ['required', 'exists:apps,id'],
            ]);

            AppUpload::updateAppUpload($request, $decryptID);
            return redirect('/app-upload')->with('message','App update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeApkAppStatus($id)
    {
        try {
            $apk_app = AppUpload::select('apk_status')->where('id',$id)->first();
            if($apk_app->apk_status == 'Publish')
            {
                $apk_status = 'Draft';
            }
            elseif($apk_app->apk_status == 'Draft')
            {
                $apk_status = 'Publish';
            }
            AppUpload::where('id',$id)->update(['apk_status' => $apk_status ]);
            return back()->with('message','Selected apk app status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeAppUploadStatus($id)
    {
        try {
            $app_upload = AppUpload::select('status')->where('id',$id)->first();
            if($app_upload->status == 'Publish')
            {
                $status = 'Draft';
            }
            elseif($app_upload->status == 'Draft')
            {
                $status = 'Publish';
            }
            AppUpload::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected app status changed successfully.');
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
            AppUpload::deleteAppUpload($id);
            return back()->with('message','App delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
