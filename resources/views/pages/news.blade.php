@extends('layout')
@section('title')
<title>News</title>
@endsection

@section('content')
    <div id="particles-js"></div>
    <div class="news">
        <div class="page-header">
            <div class="title">News</div>
            <div class="title-link"><a href="{{ route('home') }}">Home /</a> <span>News</span></div>
        </div>

        <div class="news-content">
            <div class="row" style="width: 99%">
                <div class="col-12 col-md-8 news-main">
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <div class="news-1">
                                @if (!empty($news_main[0]))
                                    <a href="{{ route('newsDetail', $news_main[0]->id) }}" class="a-img">
                                        <div class="img-parent mb-3">
                                            <div class="img" style="background-image: url('{{ $news_main[0]->image }}')"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('newsDetail', $news_main[0]->id) }}" class="title">{{ $news_main[0]->title }}</a>
                                    <p class="author mt-3">{{ $news_main[0]->user->name }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <div class="news-2">
                                @if (!empty($news_main[1]))
                                    <a href="{{ route('newsDetail', $news_main[1]->id) }}" class="a-img">
                                        <div class="img-parent">
                                            <div class="img" style="background-image: url('{{ $news_main[1]->image }}')"></div>
                                        </div>
                                    </a>
                                    <div class="p-3">
                                        <a href="{{ route('newsDetail', $news_main[1]->id) }}" class="title">{{ $news_main[1]->title }}</a>
                                        <p class="author mt-3">{{ $news_main[1]->user->name }}</p>
                                        <div class="d-none d-md-block">
                                            <p class="short_content">{{ $news_main[1]->short_content }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <div class="news-3">
                                @if (!empty($news_main[2]))
                                    <a href="{{ route('newsDetail', $news_main[2]->id) }}" class="a-img">
                                        <div class="img-parent mb-3">
                                            <div class="img" style="background-image: url('{{ $news_main[2]->image }}')"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('newsDetail', $news_main[2]->id) }}" class="title">{{ $news_main[2]->title }}</a>
                                    <p class="author mt-3">{{ $news_main[2]->user->name }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <div class="news-4">
                                @if (!empty($news_main[3]))
                                    <a href="{{ route('newsDetail', $news_main[3]->id) }}" class="a-img">
                                        <div class="img-parent mb-3">
                                            <div class="img" style="background-image: url('{{ $news_main[3]->image }}')"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('newsDetail', $news_main[3]->id) }}" class="title">{{ $news_main[3]->title }}</a>
                                    <p class="author mt-3">{{ $news_main[3]->user->name }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <div class="news-5">
                                @if (!empty($news_main[4]))
                                    <a href="{{ route('newsDetail', $news_main[4]->id) }}" class="a-img">
                                        <div class="img-parent mb-3">
                                            <div class="img" style="background-image: url('{{ $news_main[4]->image }}')"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('newsDetail', $news_main[4]->id) }}" class="title">{{ $news_main[4]->title }}</a>
                                    <p class="author mt-3">{{ $news_main[4]->user->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="header-quick-view">
                        <h2>Quick view</h2>
                        <a href="">See more</a>
                    </div>
                    <div class="quick-view">
                        @forelse ($quickView as $it)
                            <div class="quick-view-item">
                                <a href="{{ route('newsDetail', $it->id) }}" class="title">{{ $it->title }}</a>
                                <a href="{{ route('newsDetail', $it->id) }}" class="a-img">
                                    <div class="img-parent">
                                        <div class="img" style="background-image: url('{{ $it->image }}')"></div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-white">No news yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row mt-3" style="width: 99%">
                <div class="col-12 col-md-8">
                    <div class="news-list-3">
                        @forelse ($news_remaining as $it)
                            <div class="news-list-item">
                                <a href="{{ route('newsDetail', $it->id) }}" class="a-img">
                                    <div class="img-parent">
                                        <div class="img" style="background-image: url('{{ $it->image }}')"></div>
                                    </div>
                                </a>
                                <div class="ms-4">
                                    <a href="{{ route('newsDetail', $it->id) }}" class="title">{{ $it->title }}</a>
                                    <p class="short_content mt-2">
                                        {{ $it->short_content }}
                                    </p>
                                    <p class="author">{{ $it->user->name }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-white">No news yet</p>
                        @endforelse

                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="news-banner">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
