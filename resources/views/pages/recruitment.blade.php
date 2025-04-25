@extends('layout')

@section('title')
<title>Recruitment</title>
@endsection
@section('content')
    <div id="particles-js"></div>
    <div class="recruitment">
        <div class="page-header">
            <div class="title">Recruitment</div>
            <div class="title-link"><a href="{{ route('home') }}">Home /</a> <span>Recruitment</span></div>
        </div>
        <div class="recruitment-content">
            <h2>To satisfy your passion for programming, test first and create products for millions of users</h2>
            <div class="row justify-content-center mt-5">
                @forelse ($recruitments as $it)
                    <div class="col-12 col-md-4 p-3">
                        <div class="recruit-item">
                            <p class="recruit-position-job">{{ $it->position_job }}</p>
                            <p class="recruit-salary">Salary: {{ $it->salary }}</p>
                            <p class="recruit-time">{{ $it->time }}</p>
                            <p class="recruit-time">Expiration date: {{ $it->expiration_date }}</p>
                            <p class="recruit-time">{{$it->application->count()}} applicants have applied</p>
                            <a href="{{ route('recruitmentDetail', $it->id) }}" class="btn btn-contact">Apply now</a>
                        </div>
                    </div>

                @empty
                    <p class="text-center text-white">There are no jobs available.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
