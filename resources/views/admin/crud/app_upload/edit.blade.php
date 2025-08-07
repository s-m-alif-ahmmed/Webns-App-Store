@extends('admin.master')

@section('title')
    Edit App
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('app-upload.index') }}">Apps</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit App</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit App</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('app-upload.update', Crypt::encryptString($app_upload->id) )}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')


                                <input class="form-control" type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-12 form-group">
                                    <label for="company_id" class="form-label">Company</label>
                                    <select class="form-control select2 form-select" name="company_id" id="company_id" data-placeholder="Choose one company" required>
                                        <option value="" selected>Choose one Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $company->id ==  $app_upload->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                                </div>

                                <div class="col-12 form-group">
                                    <label for="app_id" class="form-label">App</label>
                                    <select class="form-control select2 form-select" name="app_id" id="app_id" data-placeholder="Choose one app" required>
                                        @if ($app_upload->app_id)
                                            <option value="{{ $app_upload->app->id }}">{{ $app_upload->app->name }}</option>
                                        @else
                                            <option value="">Select App</option>
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('app_id')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="apk_version" class="form-label"> Apk App Version </label>
                                    <input class="form-control" type="text" name="apk_version" id="apk_version" value="{{ $app_upload->apk_version }}" placeholder="Enter apk app version" />
                                    <x-input-error :messages="$errors->get('apk_version')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="apk" class="form-label"> Apk App </label>
                                    <input class="form-control" type="file" name="apk" id="apk" value="{{ $app_upload->apk }}" placeholder="Enter apk" />
                                    @if(!empty($app_upload->apk))
                                        @php
                                            $app_upload->apk_size = file_exists(public_path($app_upload->apk)) ? filesize(public_path($app_upload->apk)) : 0;
                                        @endphp
                                        <div class="my-2">
                                            <label>Current APK: </label>
                                            {{ basename($app_upload->apk) }} ({{ number_format($app_upload->apk_size / 1048576, 2) }} MB)
                                        </div>
                                    @endif
                                    <x-input-error :messages="$errors->get('apk')" class="mt-2" />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn all-btn-same px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
