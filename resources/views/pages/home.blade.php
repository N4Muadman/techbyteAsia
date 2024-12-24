@extends('layout')
@section('title')
    <title>TECHBYTE TECHNOLOGY INVESTMENT COMPANY LIMITED</title>
@endsection
@section('content')
<div id="fullscreenBg">
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
@endsection
