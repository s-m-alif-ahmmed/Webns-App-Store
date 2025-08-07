@extends('admin.master')

@section('title')
    User Detail
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
                            <li class="breadcrumb-item active" aria-current="page"> User Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
{{--            @php--}}
{{--                $permissionData = json_decode(Auth::user()->permission, true);--}}
{{--            @endphp--}}
{{--            @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_create']) && $permissionData['users_all']['employ_all']['employ_create'] == 'employ_create')--}}
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('register') }}">Add User</a>
                </div>
{{--            @endif--}}
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
                            <h2>User Detail</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="d-flex">

                                    <div class="col-md-2 pb-2 d-flex justify-content-center text-center">
                                        @if($user->photo)
                                            <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                <img class="rounded-circle" src="{{ asset($user->photo) }}" alt="Employee" style="height: 100px; width: 100px;" id="profileImage" onclick="openImageEditor()">
                                                <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                    <i class="fa fa-edit text-white"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="image-profile" style="border-radius: 50%; overflow: hidden; height: 100px; width: 100px;">
                                                <img class="rounded-circle" src="{{ asset('/') }}admin/images/users/blank_image.jpg" alt="Employee" style="height: 100px; width: 100px;" id="profileImage" onclick="openImageEditor()">
                                                <div class="edit-button bg-gray w-100 h-50 pt-3" id="profileImage" onclick="openImageEditor()">
                                                    <i class="fa fa-edit text-white"></i>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- The modal -->

                                        <div id="imageEditorModal" class="modal">
                                            <div class="modal-dialog modal-dialog-centered" style="margin-top: 50px; height: 500px!important; width: 500px!important;">
                                                <div class="modal-content" >

                                                    <form action="{{ route('photo.update', $user->id) }}" id="imageForm" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')

                                                        <input type="hidden" name="name" value="{{ $user->name ?? '' }}">
                                                        <input type="hidden" name="email" value="{{ $user->email ?? '' }}">
                                                        <input type="hidden" name="officer_id" value="{{ $user->employee_id ?? '' }}">
                                                        <input type="hidden" name="department_id" value="{{ $user->department ?? '' }}">
                                                        <input type="hidden" name="designation_id" value="{{ $user->designation ?? '' }}">
                                                        <input type="hidden" name="number" value="{{ $user->number ?? '' }}">
                                                        <div class="row">
                                                            <div class="d-flex">
                                                                <div class="col-md-6 my-auto px-2">
                                                                    <div id="imagePreviewContainer" class="text-center py-3">
                                                                        @if($user->photo)
                                                                            <img id="viewImage" src="{{asset($user->photo)}}" alt="viewImage" class="px-2" style="max-height: 200px; max-width: 200px;">
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
                                                                        <input type="submit" class="btn all-btn-same" value="Change" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    @if($user->photo)
                                                        <div class="text-center mt-2">
                                                            <form action="{{ route('photo.destroy', $user->id) }}" method="post" enctype="multipart/form-data"  onclick="return confirm('Are you sure to delete this profile photo?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Remove</button>
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>


                                    <div class="col-md-10 pt-2">
                                        @if ($user->name)
                                        <h3>{{ $user->name }}</h3>
                                        @endif
                                        @if ($user->department)
                                        <h6>{{ $user->department }}</h6>
                                        @endif

                                        @if ($user->designation)
                                        <span class="d-flex">
                                            <i class="fa fa-solid fa-user-plus"></i>
                                        <h6 class="ps-1">{{ $user->designation }}</h6>
                                        </span>
                                        @endif

                                    </div>
                                </div>

                                <hr/>
                                <div class="row">
                                    <h3>Profile Info</h3>
{{--                                    @php--}}
{{--                                        $permissionData = json_decode(Auth::user()->permission, true);--}}
{{--                                    @endphp--}}
{{--                                    @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_edit']) && $permissionData['users_all']['employ_all']['employ_edit'] == 'employ_edit')--}}
                                        <span class="text-end">
                                            <a href="{{ route('users.edit', Crypt::encryptString($user->id)) }}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </span>
{{--                                    @endif--}}
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 text-end">
                                                <label class="">Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if ($user->email)
                                                    <input class="bg-white" value="{{ $user->email}}" disabled readonly />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 text-end">
                                                <label class="">Phone Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if ($user->number)
                                                    <input class="bg-white" value="{{ $user->number }}" disabled readonly />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 text-end">
                                                <label class="">Employee ID</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if ($user->employee_id)
                                                    <input class="bg-white" value="{{$user->employee_id}}" disabled readonly />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 text-end">
                                                <label class="">Department</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if ($user->department)
                                                    <input class="bg-white" value="{{$user->department}}" disabled readonly />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 text-end">
                                                <label class="">Designation</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if ($user->designation)
                                                    <input class="bg-white" value="{{$user->designation}}" disabled readonly />
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
        </div>
    </section>

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

    </script>
@endsection
