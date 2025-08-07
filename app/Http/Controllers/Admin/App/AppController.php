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

class AppController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['app']['app_manage']) && $permissionData['app']['app_manage'] == 'app_manage'){
                return view('admin.crud.apps.manage',[
                    'apps' => App::all(),
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
            if($permissionData && isset($permissionData['app']['app_create']) && $permissionData['app']['app_create'] == 'app_create'){
                return view('admin.crud.apps.index',[
                    'companies' => Company::all(),
                ]);
            }else{
                return view('admin.error.error');
            }
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required'],
                'image' => ['required', 'image'],
                'alt' => ['required', 'string'],
                'description' => ['nullable', 'string'],
                'company_id' => ['required', 'exists:companies,id'],
            ]);
            $this->app = App::createApp($request);
            return redirect('/apps')->with('message', 'App saved successfully.');
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
            if($permissionData && isset($permissionData['app']['app_detail']) && $permissionData['app']['app_detail'] == 'app_detail'){
                $decryptID = Crypt::decryptString($id);
                $app = App::find($decryptID);
                $app_uploads = AppUpload::where('app_id', $decryptID)->get();

                if ($app) {
                    return view('admin.crud.apps.detail', [
                        'app' => $app,
                        'app_uploads' => $app_uploads,
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
            if($permissionData && isset($permissionData['app']['app_edit']) && $permissionData['app']['app_edit'] == 'app_edit'){
                $decryptID = Crypt::decryptString($id);
                $app = App::find($decryptID);

                if ($app) {
                    return view('admin.crud.apps.edit', [
                        'app' => $app,
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
                'name' => ['required'],
            ]);

            App::updateApp($request, $decryptID);
            return redirect('/apps')->with('message','App update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeAppStatus($id)
    {
        try {
            $app = App::select('status')->where('id',$id)->first();
            if($app->status == 'Publish')
            {
                $status = 'Draft';
            }
            elseif($app->status == 'Draft')
            {
                $status = 'Publish';
            }
            App::where('id',$id)->update(['status' => $status ]);
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
            App::deleteApp($id);
            return back()->with('message','App delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
