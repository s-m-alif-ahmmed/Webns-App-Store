@extends('admin.master')

@section('title')
    Add App
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('apps.index') }}">App</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New App</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add New App </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" action="{{ route('app-upload.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <input class="form-control" type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-12 form-group">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select class="form-control select2 form-select" name="company_id" id="company_id" data-placeholder="Choose one company" required>
                                        <option value="" selected>Choose one Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{$company->app_upload_id == $company->id ? 'selected' : ''}} >{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                                </div>

                                <div class="col-12 form-group">
                                    <label for="app_id" class="form-label">App</label>
                                    <select class="form-control select2 form-select" name="app_id" id="app_id" data-placeholder="Choose one app" required>
                                        <option value="">Select App</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('app_id')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="apk_version" class="form-label"> Apk App Version </label>
                                    <input class="form-control" type="text" name="apk_version" id="apk_version" placeholder="Enter apk app version" />
                                    <x-input-error :messages="$errors->get('apk_version')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="apk" class="form-label"> Apk App </label>
                                    <input class="form-control" type="file" name="apk" id="apk" placeholder="Enter apk" />
                                    <x-input-error :messages="$errors->get('apk')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
