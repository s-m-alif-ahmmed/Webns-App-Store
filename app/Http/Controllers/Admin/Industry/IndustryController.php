<?php

namespace App\Http\Controllers\Admin\Industry;

use App\Http\Controllers\Controller;
use App\Models\Admin\Industry\Industry;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class IndustryController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['industry']['industry_manage']) && $permissionData['industry']['industry_manage'] == 'industry_manage'){
                return view('admin.crud.industry.manage',[
                    'industries' => Industry::all(),
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
            if($permissionData && isset($permissionData['industry']['industry_create']) && $permissionData['industry']['industry_create'] == 'industry_create'){
                return view('admin.crud.industry.index');
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
            Industry::createIndustry($request);
            return redirect('/industry')->with('message', 'Industry saved successfully.');
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
            if($permissionData && isset($permissionData['industry']['industry_detail']) && $permissionData['industry']['industry_detail'] == 'industry_detail'){
                $decryptID = Crypt::decryptString($id);
                $industry = Industry::find($decryptID);

                if ($industry) {
                    return view('admin.crud.industry.detail', [
                        'industry' => $industry,
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
            if($permissionData && isset($permissionData['industry']['industry_edit']) && $permissionData['industry']['industry_edit'] == 'industry_edit'){
                $decryptID = Crypt::decryptString($id);
                $industry = Industry::find($decryptID);

                if ($industry) {
                    return view('admin.crud.industry.edit', [
                        'industry' => $industry,
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
                'name' => ['required',
                    Rule::unique('industries')->ignore($decryptID),
                ],
            ]);

            Industry::updateIndustry($request, $decryptID);
            return redirect('/industry')->with('message','Industry update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeIndustryStatus($id)
    {
        try {
            $industry = Industry::select('status')->where('id',$id)->first();
            if($industry->status == 'Publish')
            {
                $status = 'Draft';
            }
            elseif($industry->status == 'Draft')
            {
                $status = 'Publish';
            }
            Industry::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected industry status changed successfully.');
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
            Industry::deleteIndustry($id);
            return back()->with('message','Industry delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
