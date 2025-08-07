@extends('admin.master')

@section('title')
    User Profile
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

                                    <div class="row">
                                        <p class="mb-4 text-center text-17">Personal Info</p>
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['user_profile']['profile_edit']) && $permissionData['user_profile']['profile_edit'] == 'profile_edit')
                                        <span class="text-end">
                                            <a href="{{ route('profile.user.edit', Crypt::encryptString($user->id)) }}" class="btn all-btn-same text-end">
                                                <i class="fa fa-x fa-edit"></i>
                                                Edit
                                            </a>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <p class="text-success text-center">{{session('message')}}</p>
                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="photo" class="form-label">Profile Picture</label>
                                                    </div>
                                                    <div class="me-5 my-3 text-center">
                                                        @if(Auth::user()->photo)
                                                            <img src="{{asset($user->photo)}}" alt="Profile Photo" alt="Employee" class="border-2 rounded-3" id="profileImage" onclick="openImageEditor()" height="150" width="150" />
                                                        @else
                                                            <img src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Profile Photo" alt="Employee" class="border-2 rounded-3" id="profileImage" onclick="openImageEditor()" height="150" width="150" />
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="name" class="form-label">Full Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->name)
                                                            <p class="form-control" >{{Auth::user()->name}}</p>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->email)
                                                            <p class="form-control" >{{Auth::user()->email}}</p>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Phone Number</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->number)
                                                        <p class="form-control" >{{Auth::user()->number}}</p>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Employee ID</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->employee_id)
                                                            <p class="form-control" >{{Auth::user()->employee_id}}</p>
                                                        @else
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Department</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->department)
                                                            <p class="form-control">{{ Auth::user()->department }}</p>
                                                        @else
                                                            <p class="form-control">No department assigned</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Designation</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        @if(Auth::user()->designation)
                                                            <p class="form-control">{{ Auth::user()->designation }}</p>
                                                        @else
                                                            <p class="form-control">No designation assigned</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
