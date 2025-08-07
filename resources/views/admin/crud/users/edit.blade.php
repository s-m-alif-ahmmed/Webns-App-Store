@extends('admin.master')

@section('title')
    User Profile
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
                            <li class="breadcrumb-item active" aria-current="page"> Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
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

                                    <div class="row">
                                        <p class="mb-4 text-center text-17">Edit User</p>
                                    </div>
                                    <div class="row mb-4">
                                        <form action="{{route('users.update', $user->id)}}" id="edit" method="POST">
                                            @csrf
                                            @method('patch')

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ $user->name }}" autofocus autocomplete="name" />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email</label>
                                                    <div class="input-group flex-nowrap">
                                                        <input type="text" class="form-control" name="email" id="emailInput" value="{{ $user->email }}" placeholder="Email" aria-describedby="addon-wrapping" required autofocus autocomplete="username" />
                                                        <span class="input-group-text" id="addon-wrapping">@webnstech.net</span>
                                                    </div>
                                                    <div id="emailError" class="text-danger"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="number">Phone Number</label>
                                                    <input type="text" class="form-control" name="number" placeholder="Enter phone number" value="{{ $user->number }}" autofocus autocomplete="number" />
                                                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Employee ID</label>
                                                    <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID" value="{{ $user->employee_id }}" autofocus autocomplete="employee_id" />
                                                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Department</label>
                                                    <input type="text" class="form-control" name="department" placeholder="Enter department" value="{{ $user->department }}" autofocus autocomplete="department" />
                                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Designation</label>
                                                    <input type="text" class="form-control" name="designation" placeholder="Enter designation" value="{{ $user->designation }}" autofocus autocomplete="designation" />
                                                    <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                                </div>

                                            </div>

                                            <div class="col-md-12 text-center mt-3 pt-3">
                                                <input type="submit" class="btn all-btn-same" value="update"/>
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

    <script>

        // Assuming you have a form with the ID "signup"
        document.getElementById('edit').addEventListener('submit', function (event) {

            // Validate Email
            var emailInput = document.getElementById('emailInput');
            var emailInputValue = emailInput.value;

            if (emailInputValue.includes('@webnstech.net')) {
                emailInputValue = emailInputValue.replace('@webnstech.net', ''); // Remove the domain
                emailInput.value = emailInputValue; // Set the modified value back to the input field
            }

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


            // Validate Number
            var numberInput = document.getElementById('numberInput');
            var numberInputValue = numberInput.value;

            if (numberInputValue.startsWith('+88019')) {
                numberInputValue = numberInputValue.replace('+88019', ''); // Remove the prefix
                numberInput.value = numberInputValue; // Set the modified value back to the input field
            }

            if (!validatePhoneNumber(numberInputValue)) {
                document.getElementById('numberError').innerText = "Invalid phone number format";
                event.preventDefault(); // Prevent form submission
            } else {
                document.getElementById('numberError').innerText = "";
            }

            // Concatenate the input value with the domain
            var finalNumber = '+88019' + numberInputValue;

            // Set the concatenated value back to the input field
            numberInput.value = finalNumber;
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

        document.getElementById('numberInput').addEventListener('input', function (event) {
            var numberInputValue = event.target.value;
            var isValid = validatePhoneNumber(numberInputValue);

            if (!isValid) {
                document.getElementById('numberError').innerText = "Invalid phone number format";
            } else {
                document.getElementById('numberError').innerText = "";
            }
        });

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePhoneNumber(number) {
            var re = /^[0-9]{8}$/; // Assuming 8 digits for the phone number
            return re.test(number);
        }
    </script>


@endsection

