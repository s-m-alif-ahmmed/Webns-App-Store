@extends('admin.master')

@section('title')
    App Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('app-upload.index') }}">Apps</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">App Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['app_upload']['app_upload_create']) && $permissionData['app_upload']['app_upload_create'] == 'app_upload_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('app-upload.create') }}"> Add App</a>
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
                        <div class="card-header fs-3 fw-bold">App Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> App Page Link </th>
                                    <td>
                                        @if($app_upload->app_id)
                                            @php
                                                $company_code = $app_upload->company->company_code;
                                                $app_url = route('home.company', ['company_code' => $company_code]);
                                            @endphp
                                            <a class="btn all-btn-same" href="{{ $app_url }}" target="_blank">
                                                View
                                            </a>
                                            <button class="copyUrlButton btn all-btn-same" data-url="{{ $app_url }}" data-bs-placement="top" title="Link Copied" >
                                                Copy
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Publish Date </th>
                                    <td>{{$app_upload->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> Added By </th>
                                    <td>
                                        @if($app_upload->user_id)
                                            {{$app_upload->user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @if($app_upload->company_id)
                                    <tr>
                                        <th> Company Name </th>
                                        <td>
                                            {{ $app_upload->company->name }} ({{$app_upload->company->company_code}})
                                        </td>
                                    </tr>
                                @endif
                                @if($app_upload->app_id)
                                <tr>
                                    <th> App Name </th>
                                    <td>
                                        {{ $app_upload->app->name }}
                                    </td>
                                </tr>
                                @endif
                                @if($app_upload->app_id)
                                <tr>
                                    <th> App Logo </th>
                                    <td>
                                        <img class="img-fluid" src="{{ asset($app_upload->app->image) }}" alt="{{ $app_upload->app->alt }}" style="height: 70px; width: auto;">
                                    </td>
                                </tr>
                                @endif
                                @if($app_upload->apk)
                                    <tr>
                                        <th> Current APK </th>
                                        <td>
                                            @php
                                                $app_upload->apk_size = file_exists(public_path($app_upload->apk)) ? filesize(public_path($app_upload->apk)) : 0;
                                            @endphp
                                            {{ basename($app_upload->apk) }} ({{ number_format($app_upload->apk_size / 1048576, 2) }} MB)
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Download </th>
                                    <td>
                                        @if($app_upload->apk)
                                            <a href="/{{$app_upload->apk}}" class="btn all-btn-same" download>
                                                Download
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @if($app_upload->apk)
                                    <tr>
                                        <th> App APK Version </th>
                                        <td>{{$app_upload->apk_version}}</td>
                                    </tr>
                                @endif
                                @if($app_upload->apk)
                                    <tr>
                                        <th> APK App Status</th>
                                        <td>
                                            {{$app_upload->apk_status}}
                                            @php
                                                $permissionData = json_decode(Auth::user()->permission, true);
                                            @endphp
                                            @if($permissionData && isset($permissionData['app_upload']['apk_app_status']) && $permissionData['app_upload']['apk_app_status'] == 'apk_app_status')
                                                @if($app_upload->apk_status == 'Publish')
                                                    <a href="{{ route('change.apk.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                                @else($app_upload->apk_status == 'Draft')
                                                    <a href="{{ route('change.apk.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> App Status</th>
                                    <td>
                                        {{$app_upload->status}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['app_upload']['app_upload_status']) && $permissionData['app_upload']['app_upload_status'] == 'app_upload_status')
                                            @if($app_upload->status == 'Publish')
                                                <a href="{{ route('change.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                            @else($app_upload->status == 'Draft')
                                                <a href="{{ route('change.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            @php
                                                $permissionData = json_decode(Auth::user()->permission, true);
                                            @endphp
                                            @if($permissionData && isset($permissionData['app']['app_edit']) && $permissionData['app']['app_edit'] == 'app_edit')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                    <a href="{{route('app-upload.edit', Crypt::encryptString($app_upload->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                            @endif
                                            @if($permissionData && isset($permissionData['app']['app_delete']) && $permissionData['app']['app_delete'] == 'app_delete')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                    <form action="{{ route('app-upload.destroy', $app_upload->id )}}" method="post" id="deleteForm{{ $app_upload->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $app_upload->id }}', 'Are you sure to delete this app?', 'btn-danger')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips for all buttons with the class 'copyUrlButton'
            var copyButtons = document.querySelectorAll('.copyUrlButton');
            copyButtons.forEach(function(button) {
                var tooltip = new bootstrap.Tooltip(button, {
                    trigger: 'manual'
                });

                button.addEventListener('click', function() {
                    // Get the current URL using PHP
                    var currentUrl = button.getAttribute('data-url');

                    // Create a temporary input element
                    var tempInput = document.createElement('input');
                    tempInput.value = currentUrl;
                    document.body.appendChild(tempInput);

                    // Select the URL text
                    tempInput.select();
                    tempInput.setSelectionRange(0, 99999); /* For mobile devices */

                    // Copy the URL to the clipboard
                    document.execCommand('copy');

                    // Remove the temporary input
                    document.body.removeChild(tempInput);

                    // Show the tooltip
                    tooltip.show();

                    // Hide the tooltip after 2 seconds
                    setTimeout(function() {
                        tooltip.hide();
                    }, 2000);
                });
            });
        });
    </script>

    <style>
        .tooltip-inner {
            background-color: #f8c243 !important;
            color: #ffffff; /* Adjust text color for contrast */
        }
        .tooltip-arrow::before {
            border-bottom-color: #f8c243 !important;
            border-top-color: #f8c243 !important;
        }

    </style>

@endsection
