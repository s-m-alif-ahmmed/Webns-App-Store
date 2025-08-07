@extends('apps.master')

@section('title')
    {{ $company->name }}
@endsection

@section('content')

    <section class="py-5" style="min-height: 90vh;">
        <div class="container">
            <div class="row card-space">
                <div class="col-md-10 col-sm-12 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body border-0 p-0">
                            @foreach($apps as $app)
                                <div class="row p-0 m-0">
                                    <div class="text-center p-0 m-0">
                                        <img class="img-fluid mt-4 shadow rounded-2" src="{{ asset($app->image) }}" alt="{{ $app->alt }}" style="height: 100px; width: auto;" />
                                    </div>
                                    <div class="top-text text-center app-detail" style="">
                                        <p class="fw-900 text-uppercase heading-down-style">App</p>
                                        <p class="fw-900 top-contact text-capitalize heading-top-style">{{ $app->name }}</p>
                                        <p class="text-color header-description" >
                                            {{ $app->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-sm-12 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">

                            @if($company->apps)
                                @if($apps->isNotEmpty())
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <span class="app">
                                                        App
                                                    </span>
                                                </th>
                                                <th scope="col" class="text-end">
                                                    <span class="download-text">
                                                        Download
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($apps->sortByDesc('created_at')->take(1) as $app)
                                                @if($app->status == 'Publish')
                                                    <tr>
                                                        <td>
                                                            <div class="">
                                                                <img class="img-fluid shadow app-img" src="{{ asset( $app->company->image) }}" alt="{{ $app->alt }}" />
                                                                <br>
                                                                <p class="company-name">
                                                                    {{ $app->company->name }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">
                                                            @foreach($app_uploads->where('app_id', $app->id)->sortByDesc('created_at')->take(1) as $app_upload)
                                                                @if($app_upload->status == 'Publish')
                                                                    @if($app_upload->apk)
                                                                        <p class="version">
                                                                            <span style="color: #f8c243;">Version:</span> {{ $app_upload->apk_version }}
                                                                        </p>
                                                                        <p class="download-btn">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="15px" height="15px" baseProfile="basic"><linearGradient id="AraffhWwwEqZfgFEBZFoqa" x1="18.102" x2="25.297" y1="3.244" y2="34.74" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#35ab4a"/><stop offset=".297" stop-color="#31a145"/><stop offset=".798" stop-color="#288739"/><stop offset="1" stop-color="#237a33"/></linearGradient><path fill="url(#AraffhWwwEqZfgFEBZFoqa)" d="M13.488,4.012C10.794,2.508,7.605,3.778,6.45,6.323L24.126,24l9.014-9.014L13.488,4.012z"/><linearGradient id="AraffhWwwEqZfgFEBZFoqb" x1="19.158" x2="21.194" y1="23.862" y2="66.931" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f14e5d"/><stop offset=".499" stop-color="#ea3d4f"/><stop offset="1" stop-color="#e12138"/></linearGradient><path fill="url(#AraffhWwwEqZfgFEBZFoqb)" d="M33.14,33.014L24.126,24L6.45,41.677 c1.156,2.546,4.345,3.815,7.038,2.312L33.14,33.014z"/><linearGradient id="AraffhWwwEqZfgFEBZFoqc" x1="32.943" x2="36.541" y1="14.899" y2="43.612" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#ffd844"/><stop offset=".519" stop-color="#ffc63f"/><stop offset="1" stop-color="#ffb03a"/></linearGradient><path fill="url(#AraffhWwwEqZfgFEBZFoqc)" d="M41.419,28.393 c1.72-0.96,2.58-2.676,2.581-4.393c-0.001-1.717-0.861-3.434-2.581-4.393l-8.279-4.621L24.126,24l9.014,9.014L41.419,28.393z"/><linearGradient id="AraffhWwwEqZfgFEBZFoqd" x1="13.853" x2="15.572" y1="5.901" y2="42.811" gradientUnits="userSpaceOnUse"><stop offset=".003" stop-color="#0090e6"/><stop offset="1" stop-color="#0065a0"/></linearGradient><path fill="url(#AraffhWwwEqZfgFEBZFoqd)" d="M6.45,6.323C6.168,6.948,6,7.652,6,8.408 v31.179c0,0.761,0.164,1.463,0.45,2.09l17.674-17.68L6.45,6.323z"/></svg>
                                                                            <a href="/{{$app_upload->apk}}" class="btn btn-sm text-white" style="background-color: #f8c243; margin-left: 5px;" download>
                                                                                Download
                                                                            </a>
                                                                        </p>
                                                                    @endif
                                                                @else
                                                                    N/A
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>

                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No Apps Found.</p>
                                @endif
                            @else
                                <p>No Apps Found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>

        .card-space{
            margin-bottom: 40px;
            @media screen and (max-width: 992px){
                margin-bottom: 20px;
            }
        }

        .app-detail{
            height: 160px;
            position: relative;
            overflow: hidden;
            @media screen and (max-width: 992px){
                height: 190px;
                position: relative;
                overflow: hidden;
            }
        }

        .header-description{
            margin: 10px 150px 0 150px;
            text-align: center;
            @media screen and (max-width: 992px){
                margin: 10px 20px 0 20px;
                text-align: center;
            }
        }

        .app{
            margin-left: 50px;
            @media screen and (max-width: 992px){
                margin-left: 50px;
            }
        }
        .download-text{
            margin-right: 50px;
            @media screen and (max-width: 992px){
                margin-right: 20px;
            }
        }
        .app-img{
            height: 80px;
            width: auto;
            border-radius: 5px;
            margin: 10px 0 20px 25px;
            @media screen and (max-width: 992px){
                height: 80px;
                width: auto;
                border-radius: 5px;
                margin: 0 0 20px 25px;
            }
        }
        .company-name{

            @media screen and (max-width: 992px){

            }
        }
        .version{
            margin: 40px 45px 0 0;
            @media screen and (max-width: 992px){
                margin: 40px 15px 0 0;
            }
        }
        .download-btn{
            margin: 5px 46px 0 0;
            @media screen and (max-width: 992px){
                margin: 10px 16px 0 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips for all buttons with the class 'copyUrlButton'
            var copyButtons = document.querySelectorAll('.copyUrlButton');
            copyButtons.forEach(function(button) {
                var tooltip = new bootstrap.Tooltip(button, {
                    trigger: 'manual'
                });

                button.addEventListener('click', function() {
                    // Get the URL from the data-url attribute
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
