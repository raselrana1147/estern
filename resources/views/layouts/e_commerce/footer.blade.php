<footer id="colophon" class="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">Featured Products</h4>
                            <ul class="product_list_widget">
                                @foreach($feature_product as $fp)
                                <li>
                                    <a href="{{ route('details',$fp->id) }}" title="Tablet Thin EliteBook  Revolve 810 G6">
                                        @if($fp->image)
                                        <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $fp->image }}" src="{{ asset('assets/uploads/small/'.$fp->image) }}" alt="">
                                        @endif
                                        <span class="product-title">{{ $fp->name }}</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">&#2547;{{ $fp->price }}</span></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body"><h4 class="widget-title">Onsale Products</h4>
                            <ul class="product_list_widget">
                                @foreach($sale_product as $sp)
                                <li>
                                    <a href="{{ route('details',$fp->id) }}" title="Notebook Black Spire V Nitro  VN7-591G">
                                        @if($sp->image)
                                        <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $sp->image }}" src="{{ asset('assets/uploads/small/'.$sp->image) }}" alt="">
                                        @endif
                                        <span class="product-title">{{ $sp->title }}</span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount">&#2547;{{ $sp->price }}</span></ins>
                                        {{--<del><span class="amount">&#36;2,299.00</span></del>--}}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">Top Rated Products</h4>
                            <ul class="product_list_widget">
                                @foreach($top_product as $tp)
                                    <li>
                                        <a href="{{ route('details',$fp->id) }}" title="Notebook Black Spire V Nitro  VN7-591G">
                                            @if($tp->image)
                                            <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $tp->image }}" src="{{ asset('assets/uploads/small/'.$tp->image) }}" alt="">
                                            @endif
                                            <span class="product-title">{{ $tp->title }}</span>
                                        </a>
                                        <span class="electro-price"><ins><span class="amount">&#2547;{{ $tp->price }}</span></ins>
                                            {{--<del><span class="amount">&#36;2,299.00</span></del>--}}
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <h5 class="newsletter-title">Sign up to Newsletter</h5>
                    <span class="newsletter-marketing-text">...and receive <strong>coupon for first shopping</strong></span>
                </div>
                <div class="col-xs-12 col-sm-5">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your email address">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Subscribe Now</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-widgets">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-md-push-5">
                    <div class="columns">
                        <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">Find It Fast</h4>
                                <div class="menu-footer-menu-1-container">
                                    <ul id="menu-footer-menu-1" class="menu">
                                        @php
                                            $categories=DB::table('catgeories')->orderBy('id','desc')->take(7)->get();
                                        @endphp
                                    @foreach ($categories as $category)
                                        <li class="menu-item"><a href="{{ route('customrCategory','') }}/{{ $category->id }}">{{$category->name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">&nbsp;</h4>
                                <div class="menu-footer-menu-2-container">
                                    <ul id="menu-footer-menu-2" class="menu">
                                        @php
                                            $categories2=DB::table('catgeories')->orderBy('id','desc')->skip(7)->take(7)->get();
                                        @endphp
                                    @foreach ($categories2 as $category2)
                                        <li class="menu-item"><a href="{{ route('customrCategory','') }}/{{ $category2->id }}">{{$category2->name}}</a></li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                    <div class="columns">
                        <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                            <div class="body">
                                <h4 class="widget-title">Customer Care</h4>
                                <div class="menu-footer-menu-3-container">
                                    <ul id="menu-footer-menu-3" class="menu">
                                        <li class="menu-item"><a href="#">My Account</a></li>
                                        <li class="menu-item"><a href="#">Returns/Exchange</a></li>
                                        <li class="menu-item"><a href="#">FAQs</a></li>
                                     
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- /.columns -->

                </div><!-- /.col -->

                <div class="footer-contact col-xs-12 col-sm-12 col-md-5 col-md-pull-7">
                    <div class="footer-logo">
                        @php
                            $logo=App\Logo::findOrFail(1);
                        @endphp
                        <img src="{{ asset('assets/logo/'.$logo->logo) }}" alt="" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                    </div><!-- /.footer-contact -->

                    <div class="footer-call-us">
                        <div class="media">
                            <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>
                            <div class="media-body">
                                <span class="call-us-text">Got Questions ? Call us 24/7!</span>
                                <span class="call-us-number" style="font-size: 15px">01842-950701, 01842-950702</span>
                            </div>
                        </div>
                    </div><!-- /.footer-call-us -->


                    <div class="footer-address">
                        <strong class="footer-address-title">Contact Info</strong>
                        <address style="font-size: 12px;">Eastern Plaza Shopping Complex, Level-4, Shop-5/78, Sonargaon Road, Hatirpool, Dhaka-1205</address>
                    </div><!-- /.footer-address -->

                    <div class="footer-social-icons">
                        <ul class="social-icons list-unstyled">
                            <li><a class="fa fa-facebook" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-twitter" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-pinterest" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-linkedin" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-google-plus" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-tumblr" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-instagram" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-youtube" href="http://themeforest.net/user/shaikrilwan/portfolio"></a></li>
                            <li><a class="fa fa-rss" href="#"></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="pull-left flip copyright">&copy; <a href="#">Eastern Technologies Ltd</a> - All Rights Reserved</div>
            <div class="pull-right flip payment">
                <div class="footer-payment-logo">
                    <ul class="cash-card card-inline">
                        <li class="card-item">
                            <span>Developed By Artificial-soft.com</span>
                        </li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->
</footer><!-- #colophon -->