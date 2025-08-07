<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{asset('/')}}admin/images/brand/webns_logo.png" class="header-brand-img desktop-logo w-100" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/favicon.png" class="header-brand-img toggle-logo w-100 py-2" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/favicon.png" class="header-brand-img light-logo w-100 py-2" alt="logo" style="height: 50px;">
                <img src="{{asset('/')}}admin/images/brand/webns_logo.png" class="header-brand-img light-logo1 w-100" alt="logo" style="height: 50px;">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">
                <li>
                    <h3>Menu</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z"/>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                @php
                    $permissionData = json_decode(Auth::user()->permission, true);
                @endphp
                @if($permissionData && isset($permissionData['users_all']))
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="16" width="20" viewBox="0 0 640 512">
                                <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/>
                            </svg>
                            <span class="side-menu__label">Users</span>
                            <i class="angle fa fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1">
                                <a href="javascript:void(0)">Users</a>
                            </li>
                            @if($permissionData && isset($permissionData['users_all']['employ_all']['employ_manage']) && $permissionData['users_all']['employ_all']['employ_manage'] == 'employ_manage')
                                <li>
                                    <a href="{{ route('users') }}" class="slide-item">Manage Users</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if($permissionData && isset($permissionData['industry']))
                    @if($permissionData && isset($permissionData['industry']['industry_manage']) && $permissionData['industry']['industry_manage'] == 'industry_manage')
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('industry.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="20" width="20" viewBox="0 0 384 512">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <span class="side-menu__label">Industries Manage</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if($permissionData && isset($permissionData['company']))
                    @if($permissionData && isset($permissionData['company']['company_manage']) && $permissionData['company']['company_manage'] == 'company_manage')
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('companies.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="20" width="20" viewBox="0 0 384 512">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <span class="side-menu__label">Companies Manage</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if($permissionData && isset($permissionData['app']))
                    @if($permissionData && isset($permissionData['app']['app_manage']) && $permissionData['app']['app_manage'] == 'app_manage')
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('apps.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="20" width="20" viewBox="0 0 384 512">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <span class="side-menu__label">Create App</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if($permissionData && isset($permissionData['app_upload']))
                    @if($permissionData && isset($permissionData['app_upload']['app_upload_manage']) && $permissionData['app_upload']['app_upload_manage'] == 'app_upload_manage')
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('app-upload.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" height="20" width="20" viewBox="0 0 384 512">
                                    <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                <span class="side-menu__label">App Upload & Manage</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                                           width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
