@extends('admin.master')

@section('title')
    Companies
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Companies</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- Commented out permission check for brevity --}}
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['company']['company_create']) && $permissionData['company']['company_create'] == 'company_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('companies.create') }}">Add Company</a>
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
                            <th> Company Logo </th>
                            <th> Company Apps Link </th>
                            @php
                                $permissionData = json_decode(Auth::user()->permission, true);
                            @endphp
                            @if($permissionData && isset($permissionData['company']['company_status']) && $permissionData['company']['company_status'] == 'company_status')
                                <th> Status </th>
                            @endif
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody id="category-table">
                        @foreach($companies as $company)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$company->name}}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset($company->image) }}" alt="{{$company->alt}}" style="height: 60px; width: auto;"/>
                                </td>
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
                                @php
                                    $permissionData = json_decode(Auth::user()->permission, true);
                                @endphp
                                @if($permissionData && isset($permissionData['company']['company_status']) && $permissionData['company']['company_status'] == 'company_status')
                                    <td>
                                        @if($company->status == 'Publish')
                                            <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                        @else($company->status == 'Draft')
                                            <a href="{{ route('change.company.status', $company->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        {{-- Commented out permission check for brevity --}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['company']['company_detail']) && $permissionData['company']['company_detail'] == 'company_detail')
                                            <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                                <a href="{{route('companies.show', Crypt::encryptString($company->id))}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company']['company_edit']) && $permissionData['company']['company_edit'] == 'company_edit')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('companies.edit', Crypt::encryptString($company->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['company']['company_delete']) && $permissionData['company']['company_delete'] == 'company_delete')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('companies.destroy', $company->id )}}" method="post" id="deleteForm{{ $company->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $company->id }}', 'Are you sure to delete this company?', 'btn-danger')">
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
