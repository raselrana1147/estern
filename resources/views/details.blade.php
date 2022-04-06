@extends('layouts.e_commerce.master')

@section('page')
    Details
    @endsection

@push('css')
@endpush


@section('content')
    <nav class="woocommerce-breadcrumb">
        <a href="{{ route('ecommerce') }}">Home</a>
        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
        <a href="">{{ $product->category->name }}</a>
        <span class="delimiter"><i class="fa fa-angle-right"></i></span>
        <a href="">{{ $product->subcategory->name }}</a>
        <span class="delimiter"><i class="fa fa-angle-right"></i>
        </span>{{ $product->title }}
    </nav><!-- /.woocommerce-breadcrumb -->

    <div class="product">

        <div class="single-product-wrapper">
            <div class="product-images-wrapper">
                <span class="onsale">Sale!</span>
                <div class="images electro-gallery">
                    <div class="thumbnails-single owl-carousel" id="show_image">
                        <a href="{{ asset('assets/uploads/original/'.$product->image) }}"  class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
                            <img src="{{ asset('assets/uploads/original/'.$product->image) }}" width="180" height="180" data-echo="/assets/uploads/original/{{ $product->image }}" class="wp-post-image" alt="">
                        </a>
                    </div><!-- .thumbnails-single -->

                    <div class="thumbnails-all columns-5 owl-carousel">
                        <a href="{{ asset('assets/uploads/small/'.$product->image) }}"  class="zoom" title="" data-rel="prettyPhoto[product-gallery]">
                            <img src="{{ asset('assets/uploads/small/'.$product->image) }}" width="100" height="100" data-echo="/assets/uploads/small/{{ $product->image }}" class="wp-post-image baseImage" alt="">
                        </a>

                        @if(!empty($product_image))
                        @foreach($product_image as $pi)
                        <a href="{{ asset('assets/product/small/'.$pi->product_image) }}" class="first" title="">
                            <img src="{{ asset('assets/product/small/'.$pi->product_image) }}" data-src="{{ $pi->product_image }}" data-echo="/assets/product/small/{{ $pi->product_image }}" class="wp-post-image clickimage" alt="">
                        </a>

                        @endforeach
                        @else
                        <div>No Image Found</div>
                        @endif
                    </div><!-- .thumbnails-all -->
                </div><!-- .electro-gallery -->
            </div><!-- /.product-images-wrapper -->

                    <div class="summary entry-summary">

                        <span class="loop-product-categories">
                            <a href="" rel="tag">{{ $product->title }}</a>
                        </span><!-- /.loop-product-categories -->

                        <h1 itemprop="name" class="product_title entry-title">{{ $product->name }}</h1>

                        <div class="brand">
                            <div class="availability in-stock">Brand Name: <span>{{ $product->brand->name }}</span></div>
                        </div><!-- .brand -->
                        <br>

                        @if($product->quantity == 0)
                            <div class="availability in-stock">Availablity: <span class="text-danger">Out of stock</span></div><!-- .availability -->
                        @else
                            <div class="availability in-stock">Availablity: <span class="text-success">In stock</span></div><!-- .availability -->
                        @endif

                        <hr class="single-product-title-divider" />

                        <div itemprop="description">
                            <ul>
                                <li>Model : {{ $product->model }}</li>
                                <li>Warranty : {{ $product->warranty }}</li>
                                @if($product->new_arrival == 1)
                                <li>Arrival : New</li>
                                @else
                                <li>Arrival : Few Days Ago</li>
                                @endif
                                @if($product->status == 1)
                                    <li>Store : Yes</li>
                                @else
                                    <li>Store : No</li>
                                 @endif
                                 @if ($product->discount>0)
                                     <li>Discount : {{ $product->discount }}%</li>
                                 @endif
                            </ul>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                            <p><strong>Code</strong>: {{ $product->code }}</p>
                        </div><!-- .description -->

                        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

                            <p class="price"><span class="electro-price"><span class="amount"><h4>&#2547; {{ $product->price }}  @if ($product->previous_price>$product->price)
                                <small><del> &#2547;{{$product->previous_price}}</del></small>
                            @endif</h4>
                            
                        </span></span></p>


                        </div><!-- /itemprop -->

                        <form class="variations_form cart" method="post" id="add_to_cart_form" data-action="{{ route('add.to.cart') }}">
                            @csrf
                            <input type="hidden" name="add_type" value="2">
                            <table class="variations">
                                <tbody>
                                <tr>
                                    <td class="label"><label>Color</label></td>
                                    <td class="value">
                                        <select class="" name="color">
                                            <option value="">Choose an option</option>
                                            <?php
                                                $color = explode(',', $product->color);
                                                foreach ($color as $c){
                                            ?>
                                            <option value="{{ $c }}" >{{ $c }}</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @if($product->quantity > 0)
                            <div class="single_variation_wrap">
                                <div class="woocommerce-variation single_variation"></div>
                                <div class="woocommerce-variation-add-to-cart variations_button">
                                    <div class="quantity">
                                        <label>Quantity:</label>
                                        <input type="number" name="quantity"  value="1" class="input-text qty text" min="1" />
                                    </div>

                                    <input type="hidden" name="product_id" id="product_id" class="variation_id" value="{{ $product->id }}" />
                                    @if (Session::get('CustomerSession') !="")
                                       <button type="submit" class="single_add_to_cart_button button">Add to cart</button>
                                       @else
                                       <a href="{{ route('customer.login') }}" class="single_add_to_cart_button button">Add to cart</a>
                                    @endif
                                    
                                </div>
                            </div>

                            <div id="show"></div>
                                @endif
                        </form>

                    </div><!-- .summary -->
                </div><!-- /.single-product-wrapper -->

        <div class="woocommerce-tabs wc-tabs-wrapper">
            <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">

                <li class="nav-item description_tab">
                    <a href="#tab-description" class="active" data-toggle="tab">Description</a>
                </li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                    <div class="electro-description">
                        {!! $product->description !!}
                    </div><!-- /.electro-description -->
                </div>

            </div>
        </div><!-- /.woocommerce-tabs -->

        <div class="related products">
            <h2>Related Products</h2>

            <ul class="products columns-5">
                @if(!empty($related_product))
                @foreach($related_product as $rp)
                <li class="product">
                    <div class="product-outer">
                        <div class="product-inner">
                            <span class="loop-product-categories"><a href="" rel="tag">{{ $rp->cat_name }}</a></span>
                            <a href="{{ route('details',$rp->id)}}">
                                <h3>{{ $rp->name }}</h3>
                                <div class="product-thumbnail">
                                    @if($rp->image)
                                    <img data-echo="/assets/uploads/small/{{ $rp->image }}" src="{{ asset('assets/uploads/small/'.$rp->image) }}" alt="">
                                        @endif
                                </div>
                            </a>

                            <div class="price-add-to-cart">
                                                <span class="price">
                                                    <span class="electro-price">
                                                        <ins><span class="amount">&#2547; {{ $rp->price }}</span></ins>
                                                    </span>
                                                </span>
                                @if (Session::get('CustomerSession') !="")
                               
                                 <a rel="nofollow" href="javascript:;" class="button add_to_cart_button add_to_cart_product" product_id="{{$product->id}}" add_type="1" data-action="{{route('add.to.cart')}}">Add to cart </a>
                                                               
                                        @else
                                           <a rel="nofollow" href="{{ route('customer.login') }}" class="button add_to_cart_button">Add to cart</a>
                                        @endif
                            </div><!-- /.price-add-to-cart -->

                            <div class="hover-area">
                                <div class="action-buttons">
                                    <a href="#" rel="nofollow" class="add_to_wishlist"> Wishlist</a>
                                    <a href="#" class="add-to-compare-link">Compare</a>
                                </div>
                            </div>

                        </div><!-- /.product-inner -->
                    </div><!-- /.product-outer -->
                </li>
                @endforeach
                @else
                <div>No Related Found</div>
                @endif

            </ul><!-- /.products -->
        </div><!-- /.related -->
    </div><!-- /.product -->

@endsection

@push('js')
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#quantity").on("change", function (e) {
            e.preventDefault();

            var quantity_id = jQuery("#quantity").val();

            var product_qty = jQuery("#product_qty").val();

            if (product_qty < quantity_id){
                jQuery("#show").html('<span style="color: red;">This Product Stock is Limit</span>');
            }else if(product_qty === quantity_id) {
                jQuery("#show").html('<span style="color: green;">Product Last Stock</span>');
            }else {
                jQuery("#show").html('');
            }
        })
    });


    $(document).on("click",".clickimage", function (e) {
        e.preventDefault();

        var product_image = $(this).attr('src');
        var arr = product_image.split('/');
        var new_image = arr[4];

        //console.log(new_image);

        if (new_image){
            jQuery("#show_image").html('' +

                '<a href="/assets/product/original/'+new_image+'"  class="zoom" title="" data-rel="prettyPhoto[product-gallery]">'+
                '<img src="/assets/product/original/'+new_image+'" width="600" height="600" data-echo="/assets/product/original/'+new_image+'" class="wp-post-image" alt="">' +
                '</a>');
        }
    })

    $(document).on("click",".baseImage", function (e) {
        e.preventDefault();

        var product_image = $(this).attr('src');
        var arr = product_image.split('/');
        var new_image = arr[4];

        //console.log(new_image);

        if (new_image){
            jQuery("#show_image").html('' +

                '<a href="/assets/uploads/original/'+new_image+'"  class="zoom" title="" data-rel="prettyPhoto[product-gallery]">'+
                '<img src="/assets/uploads/original/'+new_image+'" width="600" height="600" data-echo="/assets/uploads/original/'+new_image+'" class="wp-post-image" alt="">' +
                '</a>');
        }
    })

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
                        if (data.status=='error') {
                               toastr.error(data.msg);
                            }else{
                                toastr.success(data.msg);
                            }
                        
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
                            setItem+='<li class="mini_cart_item"><a title="Remove this item" class="remove" href="">×</a>'+'<a href=""><img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="" alt="">'+item.product_name+'</a><span class="quantity">'+item.quantity+' × <span class="amount">'+'৳'+item.product_price+'</span></span></li>';
                            
                        });

                         $('#loadAllCartItme').html(setItem);

                         $("#shoping_cart_details_herader").load(" #shoping_cart_details_herader > *");


                    }

              });
            }
          
        });

     $(document).ready(function(){
          $('body').on('submit','#add_to_cart_form',function(e){
                e.preventDefault();
               
                alert("fdsfds")
                var formData=new FormData(this);
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        let data=JSON.parse(response);
                        toastr.success(data.msg);
                        loadCartDataForm();
                    },
                    error:function(response){
                        
                    }
            });
            });

           function loadCartDataForm(){

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
                            setItem+='<li class="mini_cart_item"><a title="Remove this item" class="remove" href="#">×</a>'+'<a href=""><img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="" alt="">'+item.product_name+'</a><span class="quantity">'+item.quantity+' × <span class="amount">'+'৳'+item.product_price+'</span></span></li>';
                                
                        });

                         $('#loadAllCartItme').html(setItem);
                         $("#shoping_cart_details_herader").load(" #shoping_cart_details_herader > *");
                    }

              });
            }

                                 

    });

</script>
@endpush