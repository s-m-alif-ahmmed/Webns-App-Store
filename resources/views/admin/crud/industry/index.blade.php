@extends('admin.master')

@section('title')
    Add Industry
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('industry.index') }}">Industry</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Industry</li>
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
                        <h5 class="mb-0">Add New Industry </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" action="{{ route('industry.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                <input class="form-control" type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />

                                <div class="col-12">
                                    <label for="name" class="form-label"> Industry Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter industry name" required />
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
