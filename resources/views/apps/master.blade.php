<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{--    CSS Links--}}
    @include('apps.include.css')

    <!-- Document Title
    ============================================= -->
    <title>@yield('title')</title>

</head>

<body class="stretched" data-menu-breakpoint="1200">


<style>
    body.loading {
        overflow: hidden;
    }

    #global-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #FFFFFF; /* Change background color if needed */
        z-index: 9999999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 80px;
        height: 80px;
        display: grid;
        border: 4.5px solid #0000;
        border-radius: 50%;
        border-color: #ffffff #fba000;
        animation: spinner-e04l1k 1s infinite linear;
    }

    .spinner::before,
    .spinner::after {
        content: "";
        grid-area: 1/1;
        margin: 2.2px;
        border: inherit;
        border-radius: 50%;
    }

    .spinner::before {
        border-color: #ffffff #ffb400;
        animation: inherit;
        animation-duration: 0.5s;
        animation-direction: reverse;
    }

    .spinner::after {
        margin: 8.9px;
    }

    @keyframes spinner-e04l1k {
        100% {
            transform: rotate(1turn);
        }
    }
</style>

<!-- GLOBAL-LOADER -->
{{--<div id="global-loader">--}}
{{--    <div class="spinner">--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Document Wrapper -->
<div id="wrapper">

    <!-- Header-->
    @include('apps.include.header')
    <!-- #header end -->

    {{--    Main section--}}
    @yield('content')
    {{--    End Main Section--}}

    <!-- Footer-->
    @include('apps.include.footer')
    <!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top-->
@include('apps.include.top')

<!-- JavaScripts -->
@include('apps.include.js')

</body>
</html>

