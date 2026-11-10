<!--footer area start-->
    <footer class="footer_widgets">
        <div class="container">
            <div class="shipping_area">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <img src="{{ asset('assets/img/others/shipping1.png') }}" alt="">
                            </div>
                            <div class="shipping_text">
                                <h3>Free Shipping</h3>
                                <p>Capped at $39 per order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <img src="{{ asset('assets/img/others/shipping2.png') }}" alt="">
                            </div>
                            <div class="shipping_text">
                                <h3>Card Payments</h3>
                                <p>12 Months Installments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <img src="{{ asset('assets/img/others/shipping3.png') }}" alt="">
                            </div>
                            <div class="shipping_text">
                                <h3>Easy Returns</h3>
                                <p>Shop Wwith Confidence</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_footer">
                <div class="row">
                    <div class="col-12">
                        <div class="main_footer_inner d-flex">
                            <div class="footer_widget_list contact footer_list_width">
                                <h3>Contact Us</h3>
                                <div class="footer_contact_desc">
                                    <p>If you have any question.please
                                        contact us at <a href="#">demo@example.com</a></p>
                                </div>
                                <div class="footer_contact_info">
                                    <div class="footer_contact_info_list d-flex align-items-center">
                                        <div class="footer_contact_info_icon">
                                            <span class="pe-7s-map-marker"></span>
                                        </div>
                                        <div class="footer_contact_info_text">
                                            <p>Your address goes here.
                                                123, Address.</p>
                                        </div>
                                    </div>
                                    <div class="footer_contact_info_list d-flex align-items-center">
                                        <div class="footer_contact_info_icon">
                                            <span class="pe-7s-phone"></span>
                                        </div>
                                        <div class="footer_contact_info_text">
                                            <ul>
                                                <li><a href="tel:+0123456789">+ 0 123 456 789</a>
                                                </li>
                                                <li><a href="tel:+0123456789">+ 0 123 456 789</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="footer_menu_widget footer_list_width middle d-flex">
                                <div class="footer_widget_list">
                                    <h3>Information</h3>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="{{ route('about') }}"> About us</a></li>
                                            <li><a href="{{ route('contact') }}">Delivery information</a></li>
                                            <li><a href="{{ route('contact') }}">Privacy Policy</a></li>
                                            <li><a href="{{ route('contact') }}">Sales</a></li>
                                            <li><a href="{{ route('contact') }}">Terms & Conditions</a></li>
                                            <li><a href="{{ route('contact') }}">Shipping Policy</a></li>
                                            <li><a href="{{ route('contact') }}">EMI Payment</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="footer_widget_list">
                                    <h3>Account</h3>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="{{ route('account.dashboard') }}"> My account</a></li>
                                            <li><a href="{{ route('contact') }}">My orders</a></li>
                                            <li><a href="{{ route('contact') }}">Returns</a></li>
                                            <li><a href="{{ route('contact') }}">Shipping</a></li>
                                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                            <li><a href="{{ route('about') }}">How Does It Work</a></li>
                                            <li><a href="{{ route('account.login-register') }}">Merchant Sign Up</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="footer_widget_list footer_list_width">
                                <h3>newsletter</h3>
                                <div class="footer_newsletter">
                                    <div class="newsletter_desc">
                                        <p>If you have any question.please
                                            contact us at <a href="{{ route('contact') }}">Send Us a Email</a></p>
                                    </div>

                                    <div class="newsletter_subscribe">
                                        <form id="mc-form">
                                            <input id="mc-email" type="email" autocomplete="off"
                                                placeholder="Email Address">
                                            <button id="mc-submit"><i class="ion-arrow-right-c"></i></button>
                                        </form>
                                        <!-- mailchimp-alerts Start -->
                                        <div class="mailchimp-alerts text-centre">
                                            <div class="mailchimp-submitting"></div>
                                            <!-- mailchimp-submitting end -->
                                            <div class="mailchimp-success"></div>
                                            <!-- mailchimp-success end -->
                                            <div class="mailchimp-error"></div>
                                            <!-- mailchimp-error end -->
                                        </div><!-- mailchimp-alerts end -->
                                    </div>
                                    <div class="footer_paypal">
                                        <a href="#"><img src="{{ asset('assets/img/others/paypal.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="copyright_right text-center">
                    <p> © 2022 <a href="{{ route('home') }}"> Bucker.</a> Made with <i class="ion-heart"></i> by <a
                            href="https://themeforest.net/user/codecarnival/portfolio">CodeCarnival</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!--footer area end-->
