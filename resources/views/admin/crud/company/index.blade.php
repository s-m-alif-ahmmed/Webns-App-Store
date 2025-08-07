@extends('admin.master')

@section('title')
    Add Company
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('companies.index') }}">Company</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Company</li>
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
                        <h5 class="mb-0">Add New Company </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <input class="form-control" type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-12">
                                    <label for="industry_id" class="form-label"> Industry </label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="industry_id" id="industry_id" data-placeholder="Choose industry" >
                                            <option >Select Industry</option>
                                            @foreach($industries as $industry)
                                                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="image" class="form-label"> Company Logo </label>
                                    <input class="form-control" type="file" name="image" id="image" placeholder="Enter company logo" required />
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="alt" class="form-label"> Company Logo Alt Text </label>
                                    <input class="form-control" type="text" name="alt" id="alt" placeholder="Enter company logo alt text" required />
                                    <x-input-error :messages="$errors->get('alt')" class="mt-2" />
                                </div>

                                <div class="col-12">
                                    <label for="name" class="form-label"> Company Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter company name" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
