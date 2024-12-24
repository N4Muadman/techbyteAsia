@extends('layout')
@section('title')
<title>News detail</title>
@endsection

@section('content')
    <div id="particles-js"></div>
    <div class="container">
        <div class="news-detail">
            <div class="page-header">
                <div class="title">News detail</div>
                <div class="title-link"><a href="{{ route('home') }}">News /</a> <span>News detail</span></div>
            </div>
            <div class="news-detail-conent">
                <div class="row">
                    <div class="col-12 col-md-8 content-left">
                        <h1 class="text-white fs-2">{{ $news->title }}</h1>
                        <div class="user d-flex m-3">
                            <div class="user-img">
                                <img src="/assets/images/user.png" height="45px" width="45px" alt="">
                            </div>
                            <div class="ms-3">
                                <p>{{ $news->user->name }}</p>
                                <p>{{ $news->created_at }}</p>
                            </div>
                        </div>
                        <div class="news-detail-img">
                            <img src="{{ $news->image }}" style="border-radius: 15px" width="99%" alt="">
                        </div>
                        <div class="mt-3 text-white">
                            {!! $news->content !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="new-post">
                            <p class="heading">New post</p>
                            <div class="new-post-list">
                                @forelse ($post_new as $it)
                                    <div class="new-post-item">
                                        <a href="" class="a-img">
                                            <div class="img-parent">
                                                <div class="img" style="background-image: url('{{ $it->image }}')"></div>
                                            </div>
                                        </a>
                                        <a href="{{ route('newsDetail', $it->id) }}" class="title">{{ $it->title }}</a>
                                    </div>
                                @empty
                                    <p class="text-white">No news yet</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
