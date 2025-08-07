@extends('admin.master')

@section('title')
    Users
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @php
                $permissionData = json_decode(Auth::user()->permission, true);
            @endphp
            @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_create']) && $permissionData['users_all']['employ_all']['employ_create'] == 'employ_create')
                <div class="">
                    <a class="btn all-btn-same rounded-3" href="{{ route('register') }}">Add User</a>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>
        <hr/>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th> Employee ID </th>
                                <th> Name</th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        @if($user->employee_id)
                                            {{$user->employee_id}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->name)
                                            {{$user->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->email)
                                            {{$user->email}}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $permissionData = json_decode(Auth::user()->permission, true);
                                        @endphp
                                        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_detail']) && $permissionData['users_all']['employ_all']['employ_detail'] == 'employ_detail')
                                            <span class="d-inline-block ms-2" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="User Detail">
                                                <a href="{{ route('users.detail', Crypt::encryptString($user->id)) }}" class="btn btn-bitbucket btn-sm">
                                                    <i class="fa fa-solid fa-eye"></i>
                                                </a>
                                            </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_permission']) && $permissionData['users_all']['employ_all']['employ_permission'] == 'employ_permission')
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Access Permissions">
                                            <a href="{{route('permission.edit', Crypt::encryptString($user->id) )}}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-solid fa-lock"></i>
                                            </a>
                                        </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_password']) && $permissionData['users_all']['employ_all']['employ_password'] == 'employ_password')
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Change Password">
                                            <a href="{{route('users.password', Crypt::encryptString($user->id) )}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-solid fa-key"></i>
                                            </a>
                                        </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_edit']) && $permissionData['users_all']['employ_all']['employ_edit'] == 'employ_edit')
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('users.edit', Crypt::encryptString($user->id) )}}" class="btn btn-success btn-sm btn-warning">
                                                <i class="fa fa-solid fa-edit"></i>
                                            </a>
                                        </span>
                                        @endif
                                        @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_delete']) && $permissionData['users_all']['employ_all']['employ_delete'] == 'employ_delete')
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('delete.user', $user->id) }}" id="deleteForm{{ $user->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="return deleteAction('{{ $user->id }}', 'Are you sure to delete this user?', 'btn-danger')">
                                                    <i class="fa fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
