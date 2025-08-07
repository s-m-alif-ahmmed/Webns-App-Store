@extends('admin.master')

@section('title')
    Settings
@endsection

@section('content')

    <section class="py-5">

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
                                            <p class="mb-4 text-17">Password Info</p>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <p class="text-success text-center">{{session('message')}}</p>
                                        </div>
                                        <form class="" action="{{route('password.update')}}" method="post">
                                            @csrf
                                            @method('put')

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
                                                        <label for="current_password" class="form-label">Current Password</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="input-group mb-3">
                                                                <input type="password" name="current_password" class="form-control" id="current_password" placeholder="current password" aria-describedby="basic-addon1" required/>
                                                                <span class="input-group-text bg-white" id="basic-addon1">
                                                                    <i class="fa fa-eye text-gray" id="togglePassword"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>
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
