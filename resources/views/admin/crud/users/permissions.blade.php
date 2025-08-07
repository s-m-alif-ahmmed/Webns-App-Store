@extends('admin.master')

@section('title')
    User Permission
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('users') }}">Users</a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> User Permission</li>
                        </ol>
                    </nav>
                </div>
            </div>
        @php
            $permissionData = json_decode(Auth::user()->permission, true);
        @endphp
        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_create']) && $permissionData['users_all']['employ_all']['employ_create'] == 'employ_create')
            <div class="">
                <a class="btn all-btn-same rounded-3" href="{{ route('register') }}">Add User</a>
            </div>
        @endif
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>
        <hr/>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header justify-content-center border-bottom">
                            <h2 class="fw-bold">User Permissions</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('permission.update', $user->id) }}" method="post">
                                @csrf
                                @method('patch')

                                <div class="row">
                                    <label for="">
                                        <input type="checkbox" data-checkem="all" />Select All
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="accordion" id="accordionExample">
                                        @include('admin.crud.users.permission.user')
                                        @include('admin.crud.users.permission.user_profile')
                                        @include('admin.crud.users.permission.industry')
                                        @include('admin.crud.users.permission.company')
                                        @include('admin.crud.users.permission.apps')
                                        @include('admin.crud.users.permission.app_upload')

                                    </div>

                                </div>

                                <div class="col-md-12 py-3 text-end">
                                    <input type="submit" value="Submit" class="btn all-btn-same">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
