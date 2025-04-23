@extends('layout')

@section('title')
<title>Contact</title>
@endsection
@section('content')
    <div id="particles-js"></div>
    <div class="contact">
        <div class="page-header">
            <div class="title">Contact</div>
            <div class="title-link"><a href="{{ route('home') }}">Home /</a> <span>Contact</span></div>
        </div>
        <div class="contact-content">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2>"We are looking forward to hearing from you"</h2>
                    <p class="address-title">Address</p>
                    <p class="name-company"><span><i class="far fa-building"></i> </span>TECHBYTE TECHNOLOGY INVESTMENT COMPANY LIMITED</p>
                    <p class="address"><span><i class="fas fa-map-marker-alt"></i> </span>Head office: No. 10, Block H, Da Sy Police Housing Complex, Kien Hung Ward, Ha Dong District, Hanoi City, Vietnam</p>
                    <p class="address"><span><i class="fas fa-map-marker-alt"></i> </span>Transaction office: House 2B, 110 Nguyen Hoang Ton Street, Xuan La, Tay Ho, Hanoi</p>
                    <p class="phone-number"><span><i class="fas fa-phone"></i> </span><a href="tell:0973454140"> (+84) 973.454.140</a></p>
                    <p class="email"><span><i class="far fa-envelope"></i> </span> <a href="mailto:ai@idai.vn">ai@idai.vn</a></p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-content">
                        <h2>Contact US</h2>
                        <form action="{{ route('sendContact') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Full name <span>(*)</span></label>
                                <input type="text" class="form-control" name="full_name" placeholder="Enter full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone number <span>(*)</span></label>
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email <span>(*)</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Content</label>
                                <textarea name="content" id=""  rows="4" class="form-control" placeholder="Enter content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-contact">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
