<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/bootstrap.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/font-awesome.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/animate.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/font-electro.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/owl-carousel.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/style.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/colors/yellow.css') }}" media="all" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,700italic,800,800italic,600italic,400italic,300italic' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="{{ asset('assets/frontend/assets/images/fav-icon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
     <link rel="stylesheet" type="text/css" href="{{ asset('css/tostr.css') }}">


    @stack('css')
</head>

<body class="page home page-template-default single-product full-width">
<input type="hidden" value="{{ URL::to('/') }}/" id="base-url">
<input type="hidden" value="" id="search_reatime_product_url" data-action="{{ route('search.realtime.product') }}">

<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

    @include('layouts.e_commerce.top_head')

    @if(Request::routeIs(['ecommerce']))
        @include('layouts.e_commerce.header')
    @endif

    @if(Request::routeIs(['details','customrCategory','subcategory.front','brands','customer.login','cart.item','product.search','checkout','checkout.confirm','privacy.policy']))
        @include('layouts.e_commerce.details_header')
    @endif

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            @yield('content')

        </div><!-- .container -->
    </div><!-- #content -->

    <section class="brands-carousel">
        <div class="container">
            <h6 style="font-size: 25px">Brands</h6>

            <div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">

               @foreach($brand as $b)
                <div class="item">
                    <a href="{{ route('brands',$b->id) }}">
                        <figure>
                            <figcaption class="text-overlay">
                                <div class="info">
                                    <h4>{{ $b->name }}</h4>
                                </div><!-- /.info -->
                            </figcaption>

                            @if($b->brand_image)
                            <img src="{{ ($b->brand_image !=null) ? asset('assets/brand/small/'.$b->brand_image) : asset('assets/brand/small/small.png') }}" data-echo="{{ ($b->brand_image !=null) ? asset('assets/brand/small/'.$b->brand_image) : asset('assets/brand/small/small.png') }}" class="img-responsive" alt="">
                          @endif

                        </figure>
                    </a>
                </div><!-- /.item -->
                 @endforeach

            </div><!-- /.owl-carousel -->

        </div>
    </section>

    @include('layouts.e_commerce.footer')

</div><!-- #page -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/echo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/jquery.easing.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/assets/js/electro.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/sweet-alert.js') }}"></script>


 <script>
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 </script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

 @stack('js')
</body>
</html>
