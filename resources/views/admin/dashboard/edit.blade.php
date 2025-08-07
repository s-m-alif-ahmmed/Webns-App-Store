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
                                        <p class="mb-4 text-center text-17">Personal Info Edit</p>
                                    </div>
                                    <div class="row">
                                        <p class="text-success text-center">{{session('message')}}</p>
                                    </div>
                                    <div class="row mb-4">

                                            <div class="col-md-12 d-flex justify-content-center text-center">
                                                @if(Auth::user()->photo)
                                                    <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                        <img class="mx-auto d-block" src="{{ asset(Auth::user()->photo) }}" alt="Employee" style="max-height: 150px; max-width: 150px;" />
                                                        <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                            <i class="fa fa-2x fa-edit text-white"></i>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 150px; width: 150px;">
                                                        <img class="mx-auto d-block" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="max-height: 150px; max-width: 150px;" />
                                                        <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                            <i class="fa fa-2x fa-edit text-white"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- The modal -->

                                            <div id="imageEditorModal" class="modal">
                                                <div class="modal-dialog modal-dialog-centered" style="margin-top: 50px; height: 500px!important; width: 500px!important;">
                                                    <div class="modal-content" >

                                                        <form action="{{ route('photo.update', Auth::user()->id) }}" id="imageForm" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('patch')

                                                            <input type="hidden" name="name" value="{{ Auth::user()->name ?? '' }}">
                                                            <input type="hidden" name="email" value="{{ Auth::user()->email ?? '' }}">
                                                            <input type="hidden" name="officer_id" value="{{ Auth::user()->employee_id ?? '' }}">
                                                            <input type="hidden" name="department_id" value="{{ Auth::user()->department ?? '' }}">
                                                            <input type="hidden" name="designation_id" value="{{ Auth::user()->designation ?? '' }}">
                                                            <input type="hidden" name="number" value="{{ Auth::user()->number ?? '' }}">

                                                            <div class="row">
                                                                <div class="d-flex">
                                                                    <div class="col-md-6 my-auto px-2">
                                                                        <div id="imagePreviewContainer" class="text-center py-3">
                                                                            @if(Auth::user()->photo)
                                                                                <img id="viewImage" src="{{asset(Auth::user()->photo)}}" alt="viewImage" class="px-2" style="max-height: 200px; max-width: 200px;">
                                                                            @else
                                                                                <img id="viewImage" class="rounded-circle" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="height: 100px; width: 100px;" id="profileImage" onclick="openImageEditor()">
                                                                            @endif
                                                                            <img id="previewImage" class="px-2" alt="Preview" style="max-height: 200px; max-width: 200px;">
                                                                            <input type="file" class="py-2" id="imageInput" name="photo" onchange="previewImage()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 my-auto">
                                                                    <span class="close text-center" onclick="closeImageEditor()">
                                                                        <span class="btn btn-success ">Close</span>
                                                                    </span>
                                                                        <div class="text-center mt-2 pe-0">
                                                                            <input type="submit" onclick="submitForm()" class="btn btn-primary" value="Change" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        @if(Auth::user()->photo)
                                                            <div class="text-center mt-2">
                                                                <form action="{{ route('photo.destroy', Auth::user()->id) }}" id="deleteForm{{ Auth::user()->id }}" method="post" enctype="multipart/form-data" >
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger" onclick="return deleteAction('{{ Auth::user()->id }}', 'Are you sure to remove this photo?', 'btn-danger')">Remove</button>
                                                                </form>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="container">
                                            <form action="{{route('users.update', Auth::user()->id)}}" id="edit" method="POST">

                                                @csrf
                                                @method('patch')

                                                <div class="row">
                                                    @php
                                                        $permissionData = json_decode(Auth::user()->permission, true);
                                                    @endphp
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ Auth::user()->name }}" required autofocus autocomplete="name" />
                                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                    </div>
                                                    @if($permissionData && isset($permissionData['user_profile']['profile_email']) && $permissionData['user_profile']['profile_email'] == 'profile_email')
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="email">Email</label>
                                                            <div class="input-group flex-nowrap">
                                                                <input type="text" class="form-control" name="email" id="emailInput" value="{{ Auth::user()->email }}" placeholder="Email" aria-describedby="addon-wrapping" required autofocus autocomplete="username" />
                                                                <span class="input-group-text" id="addon-wrapping">@webnstech.net</span>
                                                            </div>
                                                            <div id="emailError" class="text-danger"></div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="email">Email</label>
                                                            <div class="input-group flex-nowrap">
                                                                <input type="text" class="form-control" name="email" id="emailInput" value="{{ Auth::user()->email }}" placeholder="Email" aria-describedby="addon-wrapping" required autofocus autocomplete="username" readonly/>
                                                                <span class="input-group-text" id="addon-wrapping">@webnstech.net</span>
                                                            </div>
                                                            <div id="emailError" class="text-danger"></div>
                                                        </div>
                                                    @endif
                                                    @if($permissionData && isset($permissionData['user_profile']['profile_phone']) && $permissionData['user_profile']['profile_phone'] == 'profile_phone')
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="number">Number</label>
                                                            <input type="text" class="form-control" name="number" placeholder="Enter phone number" value="{{ Auth::user()->number }}" autofocus autocomplete="number" />
                                                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="number">Number</label>
                                                            <input type="text" class="form-control" name="number" placeholder="Enter phone number" value="{{ Auth::user()->number }}" readonly autofocus autocomplete="number" />
                                                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                                                        </div>
                                                    @endif
                                                    @if($permissionData && isset($permissionData['user_profile']['employee_id']) && $permissionData['user_profile']['employee_id'] == 'employee_id')
                                                        <div class="col-md-12">
                                                            <label class="form-label">Employee ID</label>
                                                            <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID" value="{{ Auth::user()->employee_id }}" autofocus autocomplete="employee_id" />
                                                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                                        </div>
                                                    @else
                                                        <div class="col-md-12">
                                                            <label class="form-label">Employee ID</label>
                                                            <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID" value="{{ Auth::user()->employee_id }}" readonly autofocus autocomplete="employee_id" />
                                                            <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                                                        </div>
                                                    @endif
                                                    @if($permissionData && isset($permissionData['user_profile']['profile_department']) && $permissionData['user_profile']['profile_department'] == 'profile_department')
                                                        <div class="col-md-6">
                                                            <label class="form-label">Department</label>
                                                            <input type="text" class="form-control" name="department" placeholder="Enter Department" value="{{ Auth::user()->department }}" autofocus autocomplete="department" />
                                                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <label class="form-label">Department</label>
                                                            <input type="text" class="form-control" name="department" placeholder="Enter Department" value="{{ Auth::user()->department }}" readonly autofocus autocomplete="department" />
                                                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                                        </div>
                                                    @endif
                                                    @if($permissionData && isset($permissionData['user_profile']['profile_designation']) && $permissionData['user_profile']['profile_designation'] == 'profile_designation')
                                                        <div class="col-md-6">
                                                            <label class="form-label">Designation</label>
                                                            <input type="text" class="form-control" name="designation" placeholder="Enter designation" value="{{ Auth::user()->designation }}" autofocus autocomplete="designation" />
                                                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <label class="form-label">Designation</label>
                                                            <input type="text" class="form-control" name="designation" placeholder="Enter designation" value="{{ Auth::user()->designation }}" readonly autofocus autocomplete="designation" />
                                                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-md-12 text-center my-3">
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

    <style>
        /* Style for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            width: 80%;
            border: 1px solid #888;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>


    <script>
        // Initialize the preview as hidden
        document.getElementById('previewImage').style.display = 'none';

        // Open the modal
        function openImageEditor() {
            document.getElementById('imageEditorModal').style.display = 'block';
        }

        // Close the modal
        function closeImageEditor() {

            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('imageInput');

            // Reset the file input and hide the preview
            fileInput.value = null;
            preview.src = '';
            preview.style.display = 'none';

            document.getElementById('imageEditorModal').style.display = 'none';
        }

        // Preview the selected image
        function previewImage() {
            var preview = document.getElementById('previewImage');
            var view = document.getElementById('viewImage');
            var fileInput = document.getElementById('imageInput');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview when an image is selected
                    view.style.display = 'none'; // Show the preview when an image is selected
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Hide the preview when no image is selected
            }
        }

        // Trigger the preview when the file input changes
        document.getElementById('imageInput').addEventListener('change', previewImage);

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


