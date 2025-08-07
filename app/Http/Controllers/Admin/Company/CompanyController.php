<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use App\Models\Admin\App\App;
use App\Models\Admin\Company\Company;
use App\Models\Admin\Industry\Industry;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company']['company_manage']) && $permissionData['company']['company_manage'] == 'company_manage'){
                return view('admin.crud.company.manage',[
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $permissionData = json_decode(Auth::user()->permission, true);
            if($permissionData && isset($permissionData['company']['company_create']) && $permissionData['company']['company_create'] == 'company_create'){
                return view('admin.crud.company.index',[
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'unique:companies'],
            ]);
            $this->company = Company::createCompany($request);
            return redirect('/companies')->with('message', 'Company saved successfully.');
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
            if($permissionData && isset($permissionData['company']['company_detail']) && $permissionData['company']['company_detail'] == 'company_detail'){
                $decryptID = Crypt::decryptString($id);
                $company = Company::find($decryptID);
                
                if ($company) {
                    return view('admin.crud.company.detail', [
                        'company' => $company,
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
            if($permissionData && isset($permissionData['company']['company_edit']) && $permissionData['company']['company_edit'] == 'company_edit'){
                $decryptID = Crypt::decryptString($id);
                $company = Company::find($decryptID);

                if ($company) {
                    return view('admin.crud.company.edit', [
                        'company' => $company,
                        'industries' => Industry::all(),
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
                    Rule::unique('companies')->ignore($decryptID),
                ],
            ]);

            Company::updateCompany($request, $decryptID);
            return redirect('/companies')->with('message','Company update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }

    }

    /**
     * Change Status the specified resource.
     */
    public function changeCompanyStatus($id)
    {
        try {
            $company = Company::select('status')->where('id',$id)->first();
            if($company->status == 'Publish')
            {
                $status = 'Draft';
            }
            elseif($company->status == 'Draft')
            {
                $status = 'Publish';
            }
            Company::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected company status changed successfully.');
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
            Company::deleteCompany($id);
            return back()->with('message','Company delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
