@extends('frontend.layouts.app')

@section('title', 'Bucker – 404')
@section('og_title', 'Bucker – About Us')

@section('content')
    <!-- breadcrumbs area start -->
    <div class="breadcrumbs_aree breadcrumbs_bg mb-110" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs_text">
                        <h1>404</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home </a></li>
                            <li> // 404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs area end -->
    <!-- Begin Error 404 Area -->
    <div class="error-404-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-404-content">
                        <h1 class="title mb-4">404</h1>
                        <h2 class="sub-title mb-4">Page Cannot Be Found!</h2>
                        <p class="short-desc mb-7">Seems like nothing was found at this location. Try something else or
                            you
                            can go back to the homepage following the button below!</p>
                        <div class="button-wrap">
                            <a class="btn btn-danger btn-lg rounded-0" href="{{ route('home') }}">Back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error 404 Area End Here -->
@endsection
