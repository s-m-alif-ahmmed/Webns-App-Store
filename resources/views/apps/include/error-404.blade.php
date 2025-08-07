@extends('webns.master')

@section('title')
    404
@endsection

@section('content')

    <section class="back-gradient-yellow">
        <!-- PAGE -->
        <div class="page py-5">
            <!-- PAGE-CONTENT OPEN -->
            <div class="page-content error-page error2 py-5 mt-5">
                <div class="container text-center">
                    <div class="error-template">
                        <h2 class="text-white mb-2 fw-bolder">Error</h2>
                        <h2 class="text-white mb-2 fw-bolder ">404</h2>
                        <h5 class="error-details text-white">
                            Oops! Some error has occured, Requested page not found!
                        </h5>
                        <div class="text-center">
                            <a class="btn all-btn-same mt-5 mb-5" href="{{route('home')}}"> <i class="fa fa-long-arrow-left"></i> Back to Home </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE-CONTENT OPEN CLOSED -->
        </div>
        <!-- End PAGE -->
    </section>

@endsection
