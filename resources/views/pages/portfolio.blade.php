@extends('layout')
@section('title')
<title>Portfolio</title>
@endsection

@section('content')
    <div id="particles-js"></div>
    <div class="portfolio">
        <div class="page-header">
            <div class="title">Portfolio</div>
            <div class="title-link"><a href="{{ route('home') }}">Home /</a> <span>Portfolio</span></div>
        </div>

        <div class="portfolio-content">
            @foreach ($portfolios->unique('category_id') as $it)
                <div class="portfolio-list">
                    <div class="portfolio-list-title">
                        <h2>{{ $it->category->name }}</h2>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($portfolios->where('category_id', $it->category_id) as $subItem)
                            @if($subItem->category_id == 3)
                                <div class="col-12 col-md-3 p-2">
                                    <div class="portfolio-list-item">
                                        <div class="img">
                                            <img src="{{ $subItem->image }}" width="100%" height="100%" alt="">
                                        </div>
                                        <div class="text">
                                            <p>{{ $subItem->content }}</p>
                                            <a href="{{ $subItem->link }}">Website</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 col-md-7 p-2">
                                    <div class="portfolio-list-item" style="height: 350px">
                                        <div class="img">
                                            <img src="{{ $subItem->image }}" width="100%" height="100%"  alt="">
                                        </div>
                                        <div class="text">
                                            <p style="font-size: 28px">{{ $subItem->content }}</p>
                                            <a style="font-size: 20px" href="{{ $subItem->link }}">Website</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
