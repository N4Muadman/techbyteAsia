<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/assets/js/slick/slick/slick.css" rel="stylesheet">
    <link href="/assets/fontawesome/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    @yield('title')
</head>

<body>
    @if (session()->has('success'))
        <div class="notification d-flex">
            <div>
                <div class="notifi-title">
                    <p class="notifi-success mb-0">Success</p>
                </div>
                <div class="notifi-content">
                    <div class="text">{{ session('success') }}</div>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="notification d-flex">
            <div>
                <div class="notifi-title">
                    <p class="text-danger mb-0">Error</p>
                </div>
                <div class="notifi-content">
                    <div class="text">{{ session('error') }}</div>
                </div>
            </div>
        </div>
    @endif
    <div class="menu">
        <div class="menu-top d-none d-md-block">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" width="80px"
                    alt=""></a>
        </div>
        <div class="menu-body">
            <ul>
                <li class="menu-item">
                    <a href="{{ route('aboutUs') }}">
                        <img src="/assets/images/about.png" alt="">
                        <span>about us</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('portfolio') }}">
                        <img src="/assets/images/structrure.png" alt="">
                        <span>portfolio</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contact') }}">
                        <img src="/assets/images/email.png" alt="">
                        <span>contact</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('recruitment') }}">
                        <img src="/assets/images/incruitment.png" alt="">
                        <span>recruitment</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('news') }}">
                        <img src="/assets/images/next100-ico.png" alt="">
                        <span>News</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="menu-footer">
            <div class="social-icon">
                <a href="https://x.com/techbyte_asia?s=21&t=rSpEJHc1XroM_3581VBCmA"><img src="/assets/images/twitterx.png" width="42px" alt="icon-x"></a>
            </div>
        </div>
    </div>

    <div class="menu-mobile">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" width="40px"
                alt=""></a>
        <div id="btn-nav-bar">
            <i class="fas fa-bars"></i>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/slick/slick/slick.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="/assets/js/particles.js"></script>

    <script>
        const notification = document.querySelector('.notification');
        if (notification) {
            setTimeout(() => {
                notification.classList.add('fadeOut');
            }, 3000);
        }

        document.getElementById('btn-nav-bar').addEventListener('click', () => {
            const menu = document.querySelector('.menu'); // Lấy phần tử menu
            if (menu.classList.contains('slideInMobile')) {
                menu.classList.remove('slideInMobile'); // Bỏ lớp slideInMobile
                menu.classList.add('slideOutMobile'); // Thêm lớp slideOutMobile
            } else {
                menu.classList.add('slideInMobile'); // Thêm lớp slideInMobile
                menu.classList.remove('slideOutMobile'); // Bỏ lớp slideOutMobile
            }
        })
    </script>
</body>

</html>
