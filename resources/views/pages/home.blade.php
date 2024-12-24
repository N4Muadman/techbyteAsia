@extends('layout')
@section('title')
    <title>TECHBYTE TECHNOLOGY INVESTMENT COMPANY LIMITED</title>
@endsection
@section('content')
<div id="fullscreenBg" class="d-none d-md-block">
    @foreach ($banners as $banner)
        <div class="slick-item" style="background-image: url('{{ $banner->image_path }}');">
            <div class="fog-bg"></div>
            {{-- <div class="textBox" style="top: 50px; color: #000">
                We are <span>ONE</span> united group of <span>TECHNOPRENEURS</span>
                <br>
                who endlessly <span>STARTUP</span> innovative <span>TECHNOLOGIES</span> to
            </div> --}}
        </div>
    @endforeach
</div>
<div class="d-block d-md-none">
    <div class="menu-home">
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
</div>
@endsection
