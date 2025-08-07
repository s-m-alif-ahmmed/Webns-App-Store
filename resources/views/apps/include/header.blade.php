<!-- Header -->
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

<nav id="nav" class="nav scrolled">
    <i class="uil uil-bars navOpenBtn"></i>
    {{--    Logo--}}
    <div id="logo" class="me-lg-0 my-1">
        <a href="https://www.webnstech.net" target="_blank" class="logo">
            <video  id="slide-video" class="d-block" style="height: 50px; width: auto;" preload="auto" loop autoplay playsinline muted>
                <source src='{{ asset('/') }}company/images/header/web_logo_animation.mp4' type='video/mp4'>
            </video>
        </a>
    </div>
    <!-- #logo end -->

    <ul class="nav-links">
        <i class="uil uil-times navCloseBtn text-white"></i>
        <li>
            <a href="https://www.webnstech.net" target="_blank">
                <span class="fw-bold" style="margin-left: -70px;">
                    <i class="fa-solid fa-home" style="font-size: 20px;"></i> Home
                </span>
            </a>
        </li>
        <li class="header-social-icon" style="margin-left: -20px;">
            <ul class="navbar d-flex">
                <li class="nav-link p-0 mx-1">
                    <a class="nav-item" href="https://www.linkedin.com/company/webns-tech/mycompany/">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
                <li class="nav-link p-0 mx-1">
                    <a class="nav-item" href="https://www.facebook.com/WebnsTech">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li class="nav-link p-0 mx-1">
                    <a class="nav-item" href="https://www.youtube.com/@webnstechnologyltd">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
                <li class="nav-link p-0 mx-1">
                    <a class="nav-item" href="https://www.pinterest.com/webnstechnologyltd">
                        <i class="fa-brands fa-pinterest-p"></i>
                    </a>
                </li>
                <li class="nav-link p-0 mx-1">
                    <a class="nav-item" href="https://twitter.com/WEBNSTechnology">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </li>
                <li class="nav-link p-0 m-1">
                    <a class="nav-item" href="https://webnstechnologyltdsspace.quora.com">
                        <i class="fa-brands fa-quora"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-copyright">
            <p class="text-black pe-3" style="font-size: 12px;">
                &copy; 2024 All Rights Reserved by WEBNS Technology Ltd.
            </p>
        </li>
    </ul>

    <i class="uil uil-search search-icon" id="searchIcon"></i>
{{--    <div class="search-box">--}}
{{--        <form class="d-flex" action="#" method="GET">--}}
{{--            <input type="text" placeholder="Search here..." />--}}
{{--            <button type="submit" class="border-0 bg-transparent">--}}
{{--                <i class="uil uil-search search-icon"></i>--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}

    <div class=""></div>

{{--    <div class="search-container">--}}
{{--        <form action="/search" method="get">--}}
{{--            <input class="search expandright" id="searchright" type="search" name="q" placeholder="Search">--}}
{{--            <label class="button searchbutton" for="searchright"><span class="mglass">&#9906;</span></label>--}}
{{--        </form>--}}
{{--    </div>--}}

</nav>
<!-- #header end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    #searchIcon{
        display: none;
    }
</style>

<script>

    window.addEventListener('scroll', function() {
        var header = document.getElementById('nav');
        if (window.scrollY >= 510) {
            header.style.height = '60px';
        } else {
            header.style.height = '75px';
        }
    });

    // Set initial height to 75px when the page loads
    window.addEventListener('load', function() {
        var header = document.getElementById('nav');
        header.style.height = '75px';
    });

    const nav = document.querySelector(".nav"),
        searchIcon = document.querySelector("#searchIcon"),
        searchBox = document.querySelector(".search-box"),
        navOpenBtn = document.querySelector(".navOpenBtn"),
        navCloseBtn = document.querySelector(".navCloseBtn");

    searchIcon.addEventListener("click", () => {
        nav.classList.toggle("openSearch");
        nav.classList.remove("openNav"); // Close navigation menu when opening search input
    });

    navOpenBtn.addEventListener("click", () => {
        nav.classList.add("openNav");
        nav.classList.remove("openSearch");
        searchIcon.classList.replace("uil-times", "uil-search");
    });

    navCloseBtn.addEventListener("click", () => {
        nav.classList.remove("openNav");
    });

    // Close header when clicking outside of it
    document.addEventListener("click", function(event) {
        const isClickInsideNav = nav.contains(event.target);
        if (!isClickInsideNav && window.innerWidth <= 992) {
            nav.classList.remove("openNav");
            nav.classList.remove("openSearch");
        }
    });

    document.addEventListener("click", function(event) {
        const isClickInsideNav = nav.contains(event.target);
        if (!isClickInsideNav) {
            nav.classList.remove("openSearch");
            // searchIcon.classList.replace("uil-times", "uil-search",);
        }
    });

</script>
