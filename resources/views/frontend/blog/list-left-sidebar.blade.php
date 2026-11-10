@extends('frontend.layouts.app')

@section('title', 'Bucker – Blog List Left Sidebar')
@section('og_title', 'Bucker – Blog Left Sidebar')

@section('content')
    <!-- breadcrumbs area start -->
    <div class="breadcrumbs_aree breadcrumbs_bg mb-100" data-bgimg="{{ asset('assets/img/others/breadcrumbs-bg.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs_text">
                        <h1>Blog List Left Sidebar</h1>
                        <ul>
                            <li><a href="{{ route('home') }}">Home </a></li>
                            <li> // Blog List Left Sidebar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs area end -->

    <!-- blog page section start -->
    <div class="blog_page_section mb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="blog_sidebar blog_widget">
                        <div class="blog_widget_list">
                            <h3>Search Here</h3>
                            <div class="widget_search">
                                <form action="#">
                                    <input placeholder="Search Your Article" type="text">
                                    <button type="submit"><i class="ion-ios-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="blog_widget_list">
                            <h3>Post Categories</h3>
                            <div class="widget_category blog_widget_category">
                                <ul>
                                    <li><a href="#">Women Fashion <i class="icofont-curved-double-right"></i></a></li>
                                    <li><a href="#">Men Fashion <i class="icofont-curved-double-right"></i></a></li>
                                    <li><a href="#">Baby Fashion <i class="icofont-curved-double-right"></i></a></li>
                                    <li><a href="#">Fashion Shop <i class="icofont-curved-double-right"></i></a></li>
                                    <li><a href="#">New Collection <i class="icofont-curved-double-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog_widget_list">
                            <h3>Recent Post</h3>
                            <div class="recent_post_inner">
                                <div class="recent_post_list d-flex">
                                    <div class="recent_post_thumb">
                                        <a href="{{ route('blog.detail.left-sidebar') }}"><img
                                                src="{{ asset('assets/img/blog/blog-small1.png') }}" alt=""></a>
                                    </div>
                                    <div class="recent_post_content">
                                        <span><i class="icofont-calendar"></i> 22 Aug, 2021</span>
                                        <h4><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolo
                                                conse tetur adi.</a></h4>
                                    </div>
                                </div>
                                <div class="recent_post_list d-flex">
                                    <div class="recent_post_thumb">
                                        <a href="{{ route('blog.detail.left-sidebar') }}"><img
                                                src="{{ asset('assets/img/blog/blog-small2.png') }}" alt=""></a>
                                    </div>
                                    <div class="recent_post_content">
                                        <span><i class="icofont-calendar"></i> 22 Aug, 2021</span>
                                        <h4><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolor sit, elit, is
                                                .</a></h4>
                                    </div>
                                </div>
                                <div class="recent_post_list d-flex">
                                    <div class="recent_post_thumb">
                                        <a href="{{ route('blog.detail.left-sidebar') }}"><img
                                                src="{{ asset('assets/img/blog/blog-small3.png') }}" alt=""></a>
                                    </div>
                                    <div class="recent_post_content">
                                        <span><i class="icofont-calendar"></i> 22 Aug, 2021</span>
                                        <h4><a href="{{ route('blog.detail.left-sidebar') }}"> harum dolorum culpa quas are</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="recent_post_list d-flex">
                                    <div class="recent_post_thumb">
                                        <a href="{{ route('blog.detail.left-sidebar') }}"><img
                                                src="{{ asset('assets/img/blog/blog-small4.png') }}" alt=""></a>
                                    </div>
                                    <div class="recent_post_content">
                                        <span><i class="icofont-calendar"></i> 22 Aug, 2021</span>
                                        <h4><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolo
                                                conse tetur adi.</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog_widget_list tags">
                            <h3>Tags</h3>
                            <div class="widget_tags">
                                <ul>
                                    <li><a href="#">Cookies</a></li>
                                    <li><a href="#">Doughnuts</a></li>
                                    <li><a href="#">Desserts</a></li>
                                    <li><a href="#">Muffins</a></li>
                                    <li><a href="#">Doughnuts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 order-1 order-lg-2">
                    <div class="blog_page_sidebar">
                        <div class="blog_page_inner">
                            <div class="row">
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.1s"
                                        data-wow-duration="1.1s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog1.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span>Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum doloril
                                                    sit amet consepy.</a></h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img1.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.2s"
                                        data-wow-duration="1.2s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog2.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span class="color2">Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolor sit, elit,
                                                    dolores is
                                                    .</a></h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img2.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.3s"
                                        data-wow-duration="1.3s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog3.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span class="color3">Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}"> harum dolorum culpa quas are
                                                    veniam</a>
                                            </h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img3.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.1s"
                                        data-wow-duration="1.1s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog4.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span>Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}">There are many of Lorem
                                                    Ipsum.</a></h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img1.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.1s"
                                        data-wow-duration="1.1s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog5.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span>Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum doloril
                                                    sit amet consepy.</a></h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img1.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-md-5">
                                    <div class="single_blog list-blog wow fadeInUp" data-wow-delay="0.2s"
                                        data-wow-duration="1.2s">
                                        <div class="blog_thumb">
                                            <a href="{{ route('blog.detail.left-sidebar') }}"><img src="{{ asset('assets/img/blog/blog6.png') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="blog_content">
                                            <div class="blog_arrow_btn">
                                                <a href="{{ route('blog.detail.left-sidebar') }}"><i
                                                        class="ion-arrow-right-c"></i></a>
                                            </div>
                                            <span class="color2">Brakery</span>
                                            <h3><a href="{{ route('blog.detail.left-sidebar') }}">Lorem ipsum dolor sit, elit,
                                                    dolores is
                                                    .</a></h3>
                                            <div class="blog__meta d-flex align-items-center">
                                                <div class="blog__meta__thumb">
                                                    <img src="{{ asset('assets/img/others/meta-img2.png') }}" alt="">
                                                </div>
                                                <div class="blog__meta__text">
                                                    <ul class="d-flex">
                                                        <li>By: Admin</li>
                                                        <li><i class="icofont-calendar"></i> 22 Aug, 2021</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination blog_pagination_sidebar">
                            <ul>
                                <li class="current"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="next"><a href="#"><i class="ion-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog page section end -->
@endsection
