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
                        {{$single_scat->name}}
                    </nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <section>
                                <header>
                                    <h2 class="h1">{{$single_scat->name}} Sub Category</h2>
                                </header>

                            <div class="tab-content">
                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                <div class="woocommerce columns-12">

                                    <ul class="products columns-4" id="see_by_sub_cat" pageNameSubCat="3" SubCatid="{{$single_scat->id}}">
                                       
                                    </ul>
                                </div>
                                {{--<span class="" style="margin-left: 100px;">{{ $products->links() }}</span>--}}
                            </div>
                        </div>
                                
                            </section>

                            <div class="load_more_section">
                                     <p class="load_no_more_sub_cat" style="display: none"></p>
                                     <button id="loadmore" class="button" style="background: yellow">Lode More...</button>
                                </div>
                           

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
                    url: $('#shoping_cart_details_herader').attr('data-action'),
                    method: "GET",
                    success:function (response) {
                        var data = JSON.parse(response);
                        $('#setTotalItem2').text(data.totalitem);
                        $('#setTotalAmount2').html(data.totalprice);
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

