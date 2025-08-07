@extends('admin.master')

@section('title')
    App Upload
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage App Upload</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- Commented out permission check for brevity --}}
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['app']['app_create']) && $permissionData['app']['app_create'] == 'app_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('app-upload.create') }}">Add App</a>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        {{-- message --}}
        @if(session('message'))
            <p class="text-center text-muted">{{ session('message') }}</p>
        @endif
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr>
                            <th> SL </th>
                            <th> Company Name </th>
                            <th> App Name </th>
                            <th> Latest Version </th>
                            @php
                                $permissionData = json_decode(Auth::user()->permission, true);
                            @endphp
                            @if($permissionData && isset($permissionData['app_upload']['apk_app_status']) && $permissionData['app_upload']['apk_app_status'] == 'apk_app_status')
                                <th> Apk Status </th>
                            @endif
                            @if($permissionData && isset($permissionData['app_upload']['app_upload_status']) && $permissionData['app_upload']['app_upload_status'] == 'app_upload_status')
                                <th> Status </th>
                            @endif
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($app_uploads as $app_upload)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($app_upload->company_id)
                                        {{ $app_upload->app->company->name }}
                                    @endif
                                </td>
                                <td>
                                    @if($app_upload->app_id)
                                        {{ $app_upload->app->name }}
                                    @endif
                                </td>
                                <td>
                                    @if($app_upload->apk_version)
                                        APK Version: {{$app_upload->apk_version}}
                                    @endif

                                </td>
{{--                                <td>--}}
{{--                                    @if($app_upload->apps->companies->isNotEmpty())--}}
{{--                                        @php--}}
{{--                                            $company_code = $app_upload->companies->first()->company_code;--}}
{{--                                            $app_url = route('home.company.app', ['company_code' => $company_code, 'app_slug' => $app_upload->app_slug]);--}}
{{--                                        @endphp--}}
{{--                                        <a class="btn all-btn-same" href="{{ $app_upload_url }}" target="_blank">--}}
{{--                                            View--}}
{{--                                        </a>--}}
{{--                                        <button class="copyUrlButton btn all-btn-same" data-bs-placement="top" title="Link Copied" >--}}
{{--                                            Copy--}}
{{--                                        </button>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                                @php
                                    $permissionData = json_decode(Auth::user()->permission, true);
                                @endphp
                                @if($permissionData && isset($permissionData['app_upload']['apk_app_status']) && $permissionData['app_upload']['apk_app_status'] == 'apk_app_status')
                                    <td>
                                        @if($app_upload->apk)
                                            @if($app_upload->apk_status == 'Publish')
                                                <a href="{{ route('change.apk.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                            @else($app_upload->apk_status == 'Draft')
                                                <a href="{{ route('change.apk.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                @endif

                                @if($permissionData && isset($permissionData['app_upload']['app_upload_status']) && $permissionData['app_upload']['app_upload_status'] == 'app_upload_status')
                                    <td>
                                        @if($app_upload->status == 'Publish')
                                            <a href="{{ route('change.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                        @else($app_upload->status == 'Draft')
                                            <a href="{{ route('change.app.upload.status', $app_upload->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        {{-- Commented out permission check for brevity --}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['app_upload']['app_upload_detail']) && $permissionData['app_upload']['app_upload_detail'] == 'app_upload_detail')
                                            <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                <a href="{{route('app-upload.show', Crypt::encryptString($app_upload->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['app_upload']['app_upload_edit']) && $permissionData['app_upload']['app_upload_edit'] == 'app_upload_edit')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('app-upload.edit', Crypt::encryptString($app_upload->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['app_upload']['app_upload_delete']) && $permissionData['app_upload']['app_upload_delete'] == 'app_upload_delete')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('app-upload.destroy', $app_upload->id )}}" method="post" id="deleteForm{{ $app_upload->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $app_upload->id }}', 'Are you sure to delete this app?', 'btn-danger')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <!-- Add this script at the bottom of your Blade view or in a separate JS file -->
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            // Initialize tooltips for all buttons with the class 'copyUrlButton'--}}
{{--            var copyButtons = document.querySelectorAll('.copyUrlButton');--}}
{{--            copyButtons.forEach(function(button) {--}}
{{--                var tooltip = new bootstrap.Tooltip(button, {--}}
{{--                    trigger: 'manual'--}}
{{--                });--}}

{{--                button.addEventListener('click', function() {--}}
{{--                    // Get the current URL using PHP--}}
{{--                    var currentUrl = "{{ $app_upload_url }}";--}}

{{--                    // Create a temporary input element--}}
{{--                    var tempInput = document.createElement('input');--}}
{{--                    tempInput.value = currentUrl;--}}
{{--                    document.body.appendChild(tempInput);--}}

{{--                    // Select the URL text--}}
{{--                    tempInput.select();--}}
{{--                    tempInput.setSelectionRange(0, 99999); /* For mobile devices */--}}

{{--                    // Copy the URL to the clipboard--}}
{{--                    document.execCommand('copy');--}}

{{--                    // Remove the temporary input--}}
{{--                    document.body.removeChild(tempInput);--}}

{{--                    // Show the tooltip--}}
{{--                    tooltip.show();--}}

{{--                    // Hide the tooltip after 2 seconds--}}
{{--                    setTimeout(function() {--}}
{{--                        tooltip.hide();--}}
{{--                    }, 2000);--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

{{--    <style>--}}
{{--        .tooltip-inner {--}}
{{--            background-color: #f8c243 !important;--}}
{{--            color: #ffffff; /* Adjust text color for contrast */--}}
{{--        }--}}
{{--        .tooltip-arrow::before {--}}
{{--            border-bottom-color: #f8c243 !important;--}}
{{--            border-top-color: #f8c243 !important;--}}
{{--        }--}}

{{--    </style>--}}

@endsection
