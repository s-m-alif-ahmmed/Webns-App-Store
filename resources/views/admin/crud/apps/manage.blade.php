@extends('admin.master')

@section('title')
    Apps
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Apps</li>
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
                    <a class="btn all-btn-same rounded-3" href="{{ route('apps.create') }}">Add App</a>
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
                            <th> App Logo </th>
                            <th> App Link </th>
                            @php
                                $permissionData = json_decode(Auth::user()->permission, true);
                            @endphp
                            @if($permissionData && isset($permissionData['app']['app_status']) && $permissionData['app']['app_status'] == 'app_status')
                                <th> Status </th>
                            @endif
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($apps as $app)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($app->company)
                                        {{ $app->company->name }}
                                    @endif
                                </td>
                                <td>{{$app->name}}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset($app->image) }}" alt="{{$app->alt}}" style="height: 60px; width: auto;"/>
                                </td>
                                <td>
                                    @if($app->company_id)
                                        @php
                                            $company_code = $app->company->company_code;
                                            $company_url = route('home.company', ['company_code' => $company_code]);
                                        @endphp
                                        <a class="btn all-btn-same" href="{{ $company_url }}" target="_blank">
                                            View
                                        </a>
                                        <button class="copyUrlButton btn all-btn-same" data-url="{{ $company_url }}" data-bs-placement="top" title="Link Copied" >
                                            Copy
                                        </button>
                                    @endif
                                </td>
                                @php
                                    $permissionData = json_decode(Auth::user()->permission, true);
                                @endphp
                                @if($permissionData && isset($permissionData['app']['app_status']) && $permissionData['app']['app_status'] == 'app_status')
                                    <td>
                                        @if($app->status == 'Publish')
                                            <a href="{{ route('change.apps.status', $app->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                        @else($app->status == 'Draft')
                                            <a href="{{ route('change.apps.status', $app->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        {{-- Commented out permission check for brevity --}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['app']['app_detail']) && $permissionData['app']['app_detail'] == 'app_detail')
                                            <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                <a href="{{route('apps.show', Crypt::encryptString($app->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['app']['app_edit']) && $permissionData['app']['app_edit'] == 'app_edit')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('apps.edit', Crypt::encryptString($app->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['app']['app_delete']) && $permissionData['app']['app_delete'] == 'app_delete')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('apps.destroy', $app->id )}}" method="post" id="deleteForm{{ $app->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $app->id }}', 'Are you sure to delete this app?', 'btn-danger')">
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
