@extends('admin.master')

@section('title')
    Industry Details
@endsection

@section('content')

    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('industry.index') }}">Industry</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Industry Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['clients_all']['category_create']) && $permissionData['clients_all']['category_create'] == 'category_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('industry.create') }}"> Add Industry</a>
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
                        <div class="card-header fs-3 fw-bold">Industry Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Industry Created </th>
                                    <td>{{$industry->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                                </tr>
                                <tr>
                                    <th> Added By </th>
                                    <td>
                                        @if($industry->user_id)
                                            {{$industry->user->name}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Industry Name </th>
                                    <td>{{$industry->name}}</td>
                                </tr>
                                <tr>
                                    <th> Industry Status</th>
                                    <td>
                                        {{$industry->status}}
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['industry']['industry_status']) && $permissionData['industry']['industry_status'] == 'industry_status')
                                            @if($industry->status == 'Publish')
                                                <a href="{{ route('change.industry.status', $industry->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn all-btn-same">Publish</a>
                                            @else($industry->status == 'Draft')
                                                <a href="{{ route('change.industry.status', $industry->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Draft</a>
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
                                            @if($permissionData && isset($permissionData['industry']['industry_edit']) && $permissionData['industry']['industry_edit'] == 'industry_edit')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                    <a href="{{route('industry.edit', Crypt::encryptString($industry->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                            @endif
                                            @if($permissionData && isset($permissionData['industry']['industry_delete']) && $permissionData['industry']['industry_delete'] == 'industry_delete')
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                    <form action="{{ route('industry.destroy', $industry->id )}}" method="post" id="deleteForm{{ $industry->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $industry->id }}', 'Are you sure to delete this industry?', 'btn-danger')">
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

@endsection
