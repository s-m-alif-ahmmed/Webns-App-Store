@extends('admin.master')

@section('title')
    Company Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('companies.index') }}">Company</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Company Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['company']['company_create']) && $permissionData['company']['company_create'] == 'company_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('companies.create') }}"> Add Company</a>
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
                        <div class="card-header fs-3 fw-bold">Company Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Company App Page Link </th>
                                    <td>
                                        @php
                                            $company_url = route('home.company', ['company_code' => $company->company_code]);
                                        @endphp
                                        <!-- Link to view the app -->
                                        <a class="btn all-btn-same" href="{{ route('home.company', ['company_code' => $company->company_code]) }}" target="_blank">
                                            View App
                                        </a>
                                        <!-- Button to copy company URL -->
                                        <button class="copyUrlButton btn all-btn-same" data-url="{{ $company_url }}" data-bs-placement="top" title="Link Copied" >
                                            Copy
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Company Created </th>
                                    <td>{{$company->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> Added By </th>
                                    <td>
                                        @if($company->user_id)
                                            {{$company->user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @if($company->industry_id)
                                <tr>
                                    <th> Industry Name </th>
                                    <td>
                                        {{ $company->industry->name }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th> Company Name </th>
                                    <td>{{$company->name}}</td>
                                </tr>
                                <tr>
                                    <th> Company Code </th>
                                    <td>{{$company->company_code}}</td>
                                </tr>
                                <tr>
                                    <th> Company Logo </th>
                                    <td>
                                        @if($company->image)
                                            <img class="img-fluid" src="{{ asset($company->image) }}" alt="{{ $company->alt }}" style="height: 60px; width: auto;">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Company Logo Alt Text </th>
                                    <td>{{$company->alt}}</td>
                                </tr>
                                <tr>
                                    <th> Company Code </th>
                                    <td>{{$company->company_code}}</td>
                                </tr>
                                <tr>
                                    <th> Company Status</th>
                                    <td>
                                        {{$company->status}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['company']['company_status']) && $permissionData['company']['company_status'] == 'company_status')
                                            @if($company->status == 'Publish')
                                                <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                            @else($company->status == 'Draft')
                                                <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
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
                                            @if($permissionData && isset($permissionData['company']['company_edit']) && $permissionData['company']['company_edit'] == 'company_edit')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                    <a href="{{route('companies.edit', Crypt::encryptString($company->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                            @endif
                                            @if($permissionData && isset($permissionData['company']['company_delete']) && $permissionData['company']['company_delete'] == 'company_delete')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                    <form action="{{ route('companies.destroy', $company->id )}}" method="post" id="deleteForm{{ $company->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $company->id }}', 'Are you sure to delete this company?', 'btn-danger')">
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
