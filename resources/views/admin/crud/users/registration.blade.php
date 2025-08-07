@extends('admin.master')

@section('title')
    Create User
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
                            <li class="breadcrumb-item active" aria-current="page"> Create New User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>
        <hr/>

        <div class="container mb-5 pb-5 pt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="justify-content-center border-bottom">
                            <div class="col-md-12 py-3">
                                <h2 class="text-center fw-bold">Create New User</h2>
                            </div>
                        </div>

                        <form method="POST" id="signup" action="{{ route('register') }}">
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" :value="old('name')" autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="email" id="emailInput" placeholder="Enter email" aria-describedby="addon-wrapping" required autofocus autocomplete="username" />
                                            <span class="input-group-text" id="addon-wrapping">@webnstech.net</span>
                                        </div>
                                        <div id="emailError" class="text-danger"></div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="department">Department</label>
                                        <input type="text" class="form-control" name="department" placeholder="Enter department" :value="old('department')" autofocus autocomplete="department" />
                                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" placeholder="Enter designation" :value="old('designation')" autofocus autocomplete="designation" />
                                        <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="employee_id">Employee ID</label>
                                        <input type="text" class="form-control" name="employee_id" placeholder="Enter employee id" :value="old('employee_id')" autofocus autocomplete="employee_id" />
                                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="number">Phone Number</label>
                                        <input type="text" class="form-control" name="number" placeholder="Enter phone number" :value="old('number')" autofocus autocomplete="number" />
                                        <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required autocomplete="new-password" />
                                        <small id="lowercase-message" class="text-danger d-block"></small>
                                        <small id="uppercase-message" class="text-danger d-block"></small>
                                        <small id="digit-message" class="text-danger d-block"></small>
                                        <small id="special-char-message" class="text-danger d-block"></small>
                                        <small id="length-message" class="text-danger d-block"></small>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                        <small id="match-message" class="text-danger d-block"></small>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                </div>
                            </div>

                            <div class="flex items-center text-center mb-5">
                                <button class="btn all-btn-same" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

        // Assuming you have a form with the ID "signup"
        document.getElementById('signup').addEventListener('submit', function (event) {

            // Validate Email
            var emailInput = document.getElementById('emailInput');
            var emailInputValue = emailInput.value;

            if (emailInputValue.includes('@')) {
                document.getElementById('emailError').innerText = "Email cannot contain '@' symbol";
                event.preventDefault(); // Prevent form submission
            } else if (emailInputValue.length < 3 || emailInputValue.length > 30) {
                document.getElementById('emailError').innerText = "Email must be between 3 and 30 characters";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById('emailError').innerText = "";
            }

            // Concatenate the input value with the domain
            var finalEmail = emailInputValue + '@webnstech.net';

            // Set the concatenated value back to the input field
            emailInput.value = finalEmail;

        });

        document.getElementById('emailInput').addEventListener('input', function (event) {
            var emailInputValue = event.target.value;

            if (emailInputValue.includes('@')) {
                document.getElementById('emailError').innerText = "Email cannot contain '@' symbol";
            } else if (emailInputValue.length < 3 || emailInputValue.length > 30) {
                document.getElementById('emailError').innerText = "Email must be between 3 and 30 characters";
            } else {
                document.getElementById('emailError').innerText = "";
            }
        });

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

    </script>

@endsection


