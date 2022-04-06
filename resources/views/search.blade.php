@extends('layouts.e_commerce.master')
@section('page')
    Eastern Tech
@endsection

@push('css')
@endpush
@section('content')
     <div class="container">

                    <nav class="woocommerce-breadcrumb" >
                        <a href="{{ route('ecommerce') }}">Home</a>
                        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                       Search
                    </nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                          
                            <section>
                                <header>
                                    <h2 class="h1">Your Searching product</h2>
                                </header>

                                
                                <div class="tab-content">
                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                <div class="woocommerce columns-12">

                                    <ul class="products columns-4">
                                       @if (count($products)>0)
                                           {{-- expr --}}
                                      
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
                                        @else
                                            <h2>No product found for this search</h2>

                                         @endif
                                    </ul>
                                </div>
                                {{--<span class="" style="margin-left: 100px;">{{ $products->links() }}</span>--}}
                            </div>
                        </div>
                                
                            </section>
                           
                            <div class="tab-content">

                                <div id="grid" class="tab-pane active" role="tabpanel">
                                    <ul class="products columns-3"></ul>
                                </div>

                                <div id="grid-extended" class="tab-pane " role="tabpanel">
                                    <ul class="products columns-3"></ul>
                                </div>

                                <div id="list-view" class="tab-pane " role="tabpanel">
                                    <ul class="products columns-3"></ul>
                                </div>

                                <div id="list-view-small" class="tab-pane " role="tabpanel">
                                    <ul class="products columns-3"></ul>
                                </div>

                            </div>

                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- .col-full -->
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
                          $("#loadAllCartItme").load(" #loadAllCartItme > *");

                    }

              });
            }
          
        });
           
    </script>
@endpush


