@extends('admin.master')

@section('title')
    Change Password
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
                            <li class="breadcrumb-item active" aria-current="page"> User Change Password </li>
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

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- ROW-1 OPEN -->
            <div class="row" id="user-profile">
                <div class="col-lg-12">
                    <div class="tab-content">

                        <div class="card">
                            <div class="card-body border-0">
                                <div class="form-horizontal">

                                    {{-- Password Changes--}}

                                    <div>
                                        <div class="row">
                                            <p class="mb-4 text-17">User Change Password</p>
                                        </div>
                                        <form class="" action="{{route('users.password.update', $user->id)}}" method="post">
                                            @csrf
                                            @method('patch')

                                            @if(session('status') === 'password-updated')
                                                <p
                                                    x-data="{ show: true}"
                                                    x-show ="show"
                                                    x-transition
                                                    x-init="setTimeout(() => show = false, 2000)"
                                                    class="text-sm text-gray-600 text-center"
                                                >
                                                    {{__('Password Update Successfully')}}
                                                </p>
                                            @endif

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="password" class="form-label">New Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group mb-3">
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="new password" aria-describedby="basic-addon2" required>
                                                            <span class="input-group-text bg-white" id="basic-addon2">
                                                                <i class="fa fa-eye text-gray" id="toggleNewPassword"></i>
                                                            </span>
                                                        </div>
                                                        <small id="lowercase-message" class="text-danger d-block"></small>
                                                        <small id="uppercase-message" class="text-danger d-block"></small>
                                                        <small id="digit-message" class="text-danger d-block"></small>
                                                        <small id="special-char-message" class="text-danger d-block"></small>
                                                        <small id="length-message" class="text-danger d-block"></small>
                                                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group mb-3">
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password" aria-describedby="basic-addon3" required>
                                                            <span class="input-group-text bg-white" id="basic-addon3">
                                                                <i class="fa fa-eye text-gray" id="toggleConfirmPassword"></i>
                                                            </span>
                                                        </div>
                                                        <small id="match-message" class="text-danger d-block"></small>
                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button class="btn all-btn-same" id="submit-button" type="submit">save changes</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- COL-END -->
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!-- End CONTAINER -->

    </section>

@endsection
