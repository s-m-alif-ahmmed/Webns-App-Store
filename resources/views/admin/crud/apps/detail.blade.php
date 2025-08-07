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
                    <a href="{{ route('apps.index') }}">Apps</a>
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
            @if($permissionData && isset($permissionData['app']['app_create']) && $permissionData['app']['app_create'] == 'app_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('apps.create') }}"> Add App</a>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>

        <hr/>
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header fs-3 fw-bold">App Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> App Page Link </th>
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
                                </tr>
                                <tr>
                                    <th> Publish Date </th>
                                    <td>{{$app->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> Added By </th>
                                    <td>
                                        @if($app->user_id)
                                            {{$app->user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @if($app->company_id)
                                    <tr>
                                        <th> Company Name </th>
                                        <td>
                                            {{ $app->company->name }} ({{ $app->company->company_code }})
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> App Name </th>
                                    <td>{{$app->name}}</td>
                                </tr>
                                @if($app->image)
                                    <tr>
                                        <th> App Logo </th>
                                        <td>
                                            <img class="img-fluid" src="{{ asset($app->image) }}" alt="{{ $app->alt }}" style="height: 60px; width: auto;">
                                        </td>
                                    </tr>
                                @endif
                                @if($app->image)
                                    <tr>
                                        <th> App Logo Alt Text </th>
                                        <td>{{$app->alt}}</td>
                                    </tr>
                                @endif
                                @foreach($app_uploads->sortByDesc('created_at')->take(1) as $app_upload)
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
                                    @if($app_upload->apk)
                                        <tr>
                                            <th> Current APK Version </th>
                                            <td>{{$app_upload->apk_version}}</td>
                                        </tr>
                                    @endif
                                    @if($app_upload->apk)
                                        <tr>
                                            <th> Current APK Download </th>
                                            <td>
                                                <a href="/{{$app_upload->apk}}" class="btn all-btn-same" download>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($app_upload->ios)
                                            <tr>
                                                <th> Current IOS </th>
                                                <td>
                                                    @php
                                                        $app_upload->ios_size = file_exists(public_path($app_upload->ios)) ? filesize(public_path($app_upload->ios)) : 0;
                                                    @endphp
                                                    {{ basename($app_upload->ios) }} ({{ number_format($app_upload->ios_size / 1048576, 2) }} MB)
                                                </td>
                                            </tr>
                                    @endif
                                    @if($app_upload->ios)
                                        <tr>
                                            <th> Current IOS Version </th>
                                            <td>{{$app_upload->ios_version}}</td>
                                        </tr>
                                    @endif
                                    @if($app_upload->ios)
                                        <tr>
                                            <th> Current IOS Download </th>
                                            <td>
                                                <a href="/{{$app_upload->ios}}" class="btn all-btn-same" download>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <th> App Status</th>
                                    <td>
                                        {{$app->status}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['app']['app_status']) && $permissionData['app']['app_status'] == 'app_status')
                                            @if($app->status == 'Publish')
                                                <a href="{{ route('change.apps.status', $app->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                            @else($app->status == 'Draft')
                                                <a href="{{ route('change.apps.status', $app->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
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
                                                    <a href="{{route('apps.edit', Crypt::encryptString($app->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                            @endif
                                            @if($permissionData && isset($permissionData['app']['app_delete']) && $permissionData['app']['app_delete'] == 'app_delete')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                    <form action="{{ route('apps.destroy', $app->id )}}" method="post" id="deleteForm{{ $app->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $app->id }}', 'Are you sure to delete this app?', 'btn-danger')">
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
