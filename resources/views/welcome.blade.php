@extends('layouts.e_commerce.master')

@section('page')
    Eastern Technologies
@endsection

@push('css')
@endpush

@section('content')
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="home-v1-slider" >
                <!-- ========================================== SECTION – HERO : END========================================= -->

                <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                    @foreach($sliders as $slider)
                        <div class="item" style="background-image: url(assets/slider/{{ $slider->image }});">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-5">
                                        <div class="caption vertical-center text-left">
                                        </div><!-- /.caption -->
                                    </div>
                                </div>
                            </div><!-- /.container -->
                        </div><!-- /.item -->
                    @endforeach

                </div><!-- /.owl-carousel -->

                <!-- ========================================= SECTION – HERO : END ========================================= -->

            </div><!-- /.home-v1-slider -->

            <div class="home-v1-deals-and-tabs deals-and-tabs row animate-in-view fadeIn animated" data-animation="fadeIn">

                <div class="tabs-block col-lg-12">
                    <div class="products-carousel-tabs">
                        <ul class="nav nav-inline">
                            <li class="nav-item"><a class="nav-link active" href="#tab-products-1" data-toggle="tab">Featured</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                <div class="woocommerce columns-12">

                                    <ul class="products columns-4">

                                        @foreach($products as $product)

                                            <li class="product">
                                                
                                                <div class="product-outer">
                                                    <div class="product-inner">
                                                        <span class="loop-product-categories"><a href="{{ route('customrCategory','') }}/{{ $product->category_id }}" rel="tag">{{ $product->category->name }}</a></span>
                                                        <a href="{{ route('details','') }}/{{ $product->id }}">
                                                            <h3>{{ $product->title }}</h3>
                                                            <div class="product-thumbnail">
                                                                @if($product->image)
                                                                <img src="{{ asset('assets/uploads/small/'.$product->image) }}" class="img-responsive" alt="" width="250px" height="232px">
                                                                    @endif
                                                            </div>
                                                        </a>

                                                        <div class="price-add-to-cart">
                                                <span class="price">
                                                    <span class="electro-price">
                                                        <ins><span class="amount"> &#2547; {{ $product->price }}</span></ins>
                                                        <span class="amount"> </span>
                                                    </span>
                                                </span>
                                    @if (Session::get('CustomerSession') !="")
                               
                                 <a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="{{$product->id}}" add_type="1" data-action="{{route('add.to.cart')}}">Add to cart</a>
                                                               
                                                            @else
                                                               <a rel="nofollow" href="{{ route('customer.login') }}" class="button add_to_cart_button">Add to cart</a>
                                                            @endif
                                                           
                                                        </div><!-- /.price-add-to-cart -->

                                                        <div class="hover-area">
                                                            <div class="action-buttons">
                                                                <a href="{{ route('details','') }}/{{ $product->id }}"><i class="fa fa-sign-in" style="color: red;"></i> Details</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.product-inner -->
                                                </div><!-- /.product-outer -->

                                            </li><!-- /.products -->

                                        @endforeach
                                    </ul>
                                </div>
                                {{--<span class="" style="margin-left: 100px;">{{ $products->links() }}</span>--}}
                            </div>
                        </div>
                    </div>
                </div><!-- /.tabs-block -->

            </div><!-- /.deals-and-tabs -->
            @php
                $banner=DB::table('banners')->whereStatus(0)->first();
            @endphp
            @if (!is_null($banner))
              
            <div class="home-v1-banner-block animate-in-view fadeIn animated" data-animation="fadeIn" style="margin-top: 20px">
                <div class="home-v1-fullbanner-ad fullbanner-ad" style="margin-bottom: 70px">
                    <a href="#"><img src="{{ asset('assets/banner/'.$banner->image) }}" class="img-responsive" alt=""></a>
                </div>
            </div><!-- /.home-v1-banner-block -->
             @endif

            <section class="home-v1-recently-viewed-products-carousel section-products-carousel animate-in-view fadeIn animated" data-animation="fadeIn">
                <header>
                    <h2 class="h1">New Arrival</h2>
                    <div class="owl-nav">
                        <a href="#products-carousel-prev" data-target="#recently-added-products-carousel" class="slider-prev"><i class="fa fa-angle-left"></i></a>
                        <a href="#products-carousel-next" data-target="#recently-added-products-carousel" class="slider-next"><i class="fa fa-angle-right"></i></a>
                    </div>
                </header>

                <div id="recently-added-products-carousel">
                    <div class="woocommerce columns-6">
                        <div class="products owl-carousel recently-added-products products-carousel columns-6">

                            @foreach($all_products as $ap)
                                <div class="product">
                                    <div class="product-outer">
                                        <div class="product-inner">
                                            <span class="loop-product-categories"><a href="{{ route('details',$ap->category->id) }}" rel="tag">{{ $ap->category->name }}</a></span>
                                            <a href="">
                                                <h3>{{ $ap->name }}</h3>
                                                <div class="product-thumbnail">
                                                    @if($ap->image)
                                                    <img src="{{asset('assets/uploads/small/'.$ap->image) }}" data-echo="/assets/uploads/small/{{ $ap->image }}" class="img-responsive" alt="">
                                                        @endif
                                                </div>
                                            </a>

                                            <div class="price-add-to-cart">
                                                            <span class="price">
                                                                <span class="electro-price">
                                                                    <ins><span class="amount">  &#2547; {{ $ap->price }}</span></ins>
                                                                    {{--<del><span class="amount">$2,299.00</span></del>--}}
                                                                    <span class="amount"> </span>
                                                                </span>
                                                            </span>
                                                  @if (Session::get('CustomerSession') !="")
                               
                                                    <a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="{{$product->id}}" add_type="1" data-action="{{route('add.to.cart')}}">Add to cart</a>
                                                               
                                                    @else
                                                       <a rel="nofollow" href="{{ route('customer.login') }}" class="button add_to_cart_button">Add to cart</a>
                                                    @endif
                                            </div><!-- /.price-add-to-cart -->

                                            <div class="hover-area">
                                                <div class="action-buttons">
                                                    <a href="{{ route('details',$ap->id) }}"><i class="fa fa-sign-in" style="color: red;"></i> Details</a>
                                                    <a href="#"> <i class="ec ec-shopping-bag"></i> Buy Now</a>
                                                </div>
                                            </div>
                                        </div><!-- /.product-inner -->
                                    </div><!-- /.product-outer -->
                                </div><!-- /.products -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

    @endsection

@push('js')
<script>
        $(document).ready(function(){
            //add to cart by one product;
            $('body').on('click','.add_to_cart_product',function(){

               var product_id=$(this).attr('product_id');
               var add_type=$(this).attr('add_type');
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: {product_id:product_id,add_type:add_type},
                    success:function(response){
                        let data=JSON.parse(response);
                        toastr.success(data.msg);
                        loadCartData();
                    },
                    error:function(response){
                    }
                });
            });

            function loadCartData(){

             $.ajax({
                    url: $('#shoping_cart_header').attr('data-action'),
                    method: "GET",
                    success:function (response) {
                        var data = JSON.parse(response);
                        $('#setTotalItem').text(data.totalitem);
                        $('#setTotalAmount').text(data.totalprice);
                        console.log(data.carts);
                        var setItem='';
                        data.carts.forEach(function(item,index){
                            setItem+='<li class="mini_cart_item"><a title="Remove this item" class="remove" href="">×</a>'+'<a href=""><img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="" alt="">'+item.product_name+'</a><span class="quantity">'+item.quantity+' × <span class="amount">'+'৳'+item.product_price+'</span></span></li>'
                        });

                         $('#loadAllCartItme').html(setItem);
                         $("#header_area_reload").load(" #header_area_reload > *");                  

                     }

              });
            }
          
        });
           
    </script>
    
@endpush