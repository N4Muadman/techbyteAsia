@extends('layout')
@section('title')
    <title>ABOUT US</title>
@endsection
@section('content')
    <div id="particles-js"></div>
    <div class="aboutUs">
        <div class="page-header">
            <div class="title">About us</div>
            <div class="title-link"><a href="{{ route('home') }}">Home /</a> <span>About us</span></div>
        </div>
        <div class="aboutUs-content mt-5">
            <h2>&quot;Take action and research to turn technology into a tool for everyone&quot;
            </h2>
            <div class="text-center mt-5 mb-5">
                <img src="/assets/images/logoOurDNA.png" alt="">
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-team.png" width="100px" height="75px">
                        <p class="about-list-item-title">Team</p>
                        <p class="about-list-item-content">We are a united team, working together to build a high-quality platform that supports the developer community in creating and sharing the best source code products.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-passion.png" style="margin-bottom: 5px" width="100px" height="70px">
                        <p class="about-list-item-title">Passion</p>
                        <p class="about-list-item-content">We believe that a passion for programming is the key to limitless innovation and creativity. Every line of code embodies our enthusiasm.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-3.png" width="100px" height="75px">
                        <p class="about-list-item-title">Knowledge Sharing</p>
                        <p class="about-list-item-content">We strive to spread knowledge and programming experience to the community. Our platform is a place for learning, sharing, and growing together.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-4.png"  height="75px">
                        <p class="about-list-item-title">Customer First</p>
                        <p class="about-list-item-content">We are committed to delivering real value and dedicated support to our customers, helping them access and apply source code easily in real-world projects.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-5.png"  height="75px">
                        <p class="about-list-item-title">Embrace Changes</p>
                        <p class="about-list-item-content">The tech world is constantly evolving. We continuously learn and improve to provide the best products and services that meet market demands.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-6.png"  height="75px">
                        <p class="about-list-item-title">Initiative</p>
                        <p class="about-list-item-content">We encourage a spirit of creativity and proactivity in our work, developing optimal and unique solutions for the programming community.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-7.png"  height="75px">
                        <p class="about-list-item-title">Creativity</p>
                        <p class="about-list-item-content">Every product and service we offer is a result of continuous creativity, tailored to meet all our customers' source code needs.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 p-3 mb-5">
                    <div class="about-list-item">
                        <img src="/assets/images/icon-8.png"  height="75px">
                        <p class="about-list-item-title">Trust and Patience</p>
                        <p class="about-list-item-content">We build trust with our customers through patience and long-term commitment, always standing by their side in every project and challenge.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
