@extends('layouts.e_commerce.master')
@section('page')
    Eastern Tech
@endsection

@push('css')
@endpush
@section('content')
     <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb"><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Cart</nav>
                      @if (count($cartItem)>0)
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="page type-page status-publish hentry">
                                <header class="entry-header"><h1 itemprop="name" class="entry-title">Cart</h1></header><!-- .entry-header -->
                                <form>

                                    <table class="shop_table shop_table_responsive cart">
                                        <thead>
                                            <tr>
                                                <th class="product-remove">&nbsp;</th>
                                                <th class="product-thumbnail">&nbsp;</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                               @foreach ($cartItem as $cItem)

                                            <tr class="cart_item cart_row{{$cItem->id}}">

                                                <td class="product-remove">
                                                    <a class="remove deleteitem" href="javascript:;" cart_id="{{$cItem->id}}" data-action="{{route("cart.remove")}}">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="{{ route('details',$cItem->product_id) }}"><img width="180" height="180" src="{{asset('assets/uploads/small/'.$cItem->product->image)}}" alt="">
                                                    </a>
                                                </td>

                                                <td data-title="Product" class="product-name">
                                                    <a href="single-product.html">{{$cItem->product_name}}</a>
                                                </td>

                                                <td data-title="Price" class="product-price">
                                                    <span class="amount">৳ {{$cItem->product_price}}</span>
                                                </td>

                                                <td data-title="Quantity" class="product-quantity">
                                                    <div class="quantity">
                                                        {{-- <input type="button" class="minus" value="-"> --}}

                                                        <label>Quantity:</label>
                                                        <input type="number" size="4" class="input-text qty text update_cart_item" title="Qty" value="{{$cItem->quantity}}" name="quantity" min="1" step="1" data-action="{{ route('cart.update') }}" cart_id="{{$cItem->id}}">

                                                        {{-- <input type="button" class="plus" value="+"> --}}
                                                    </div>
                                                </td>

                                                <td data-title="Total" class="product-subtotal">
                                                    <span class="amount set_item_sub_price{{$cItem->id}}">৳ {{$cItem->product_price*$cItem->quantity}}</span>
                                                </td>
                                            </tr>
                                             @endforeach
                                            
                                            <tr>
                                                <td class="actions" colspan="6">

                                                    <div class="coupon">

                                                        <label for="coupon_code">Coupon:</label> <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code"> <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">

                                                    </div>

                                                    <div class="wc-proceed-to-checkout">

                                                        <a class="checkout-button button alt wc-forward" href="{{ route('checkout') }}">Proceed to Checkout</a>
                                                    </div>

                                                    <input type="hidden" value="1eafc42c5e" name="_wpnonce"><input type="hidden" value="/electro/cart/" name="_wp_http_referer">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <div class="cart-collaterals">

                                    <div class="cart_totals ">

                                        <h2>Cart Totals</h2>

                                        <table class="shop_table shop_table_responsive">

                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td data-title="Subtotal"><span class="amount" id="subtotal_amount_cart">৳ {{App\Cart::totalprice()}}</span></td>
                                                </tr>

                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td data-title="Total"><strong><span class="amount" id="total_amount_cart">৳ {{App\Cart::totalprice()}}</span></strong> </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="wc-proceed-to-checkout">

                                            <a class="checkout-button button alt wc-forward" href="">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                    @else
                    <h4 class="text-danger" style="margin-left: 300px">No product added inside the cart</h4>
                    @endif
                </div><!-- .container -->
            </div><!-- #content -->
@endsection

@push('js')

<script>

      $(document).ready(function(){


        $('body').on('click','.deleteitem',function(e){
         e.preventDefault();
            swal({
              title: "Do you want delete this item ?",
              text: "Once Delete, This will be Permanently Delete!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
               var cart_id=$(this).attr('cart_id');
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: {cart_id:cart_id},
                    success:function(response){
                        let data=JSON.parse(response);
                        toastr.success(data.msg);
                        loadCartData();
                        $('.cart_row'+cart_id).hide();
                    },
                    error:function(response){
                    }
                });
              }
            });
        });

        $('body').on('change','.update_cart_item',function(e){
                e.preventDefault();
                var cart_id=$(this).attr('cart_id');
                var quantity=$(this).val();
                $.ajax({
                    url: $(this).attr('data-action'),
                    method: "POST",
                    data: {cart_id:cart_id,quantity:quantity},
                    success:function(response){
                        let data=JSON.parse(response);
                        toastr.success(data.msg);
                        loadCartData();
                        $('.set_item_sub_price'+cart_id).text("৳ "+data.sub_price)
                        
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
                        $('#setTotalAmount2').html('৳ '+data.totalprice);
                        $('#total_amount_cart').html('৳ '+data.totalprice);
                        $('#subtotal_amount_cart').html('৳ '+data.totalprice);
                        console.log(data.carts);
                        var setItem='';
                        data.carts.forEach(function(item,index){
                            setItem+='<li class="mini_cart_item"><a title="Remove this item" class="remove" href="'+route('details'+item.id)+'">×</a>'+'<a href=""><img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="" alt="">'+item.product_name+'</a><span class="quantity">'+item.quantity+' × <span class="amount">'+'৳'+item.product_price+'</span></span></li>'
                        });
                         $("#loadAllCartItme").show();
                         $('#loadAllCartItme').html(setItem);
                         $("#loadAllCartItme").load(" #loadAllCartItme > *");


                    }

              });
            }
        });

      
           
    </script>
@endpush


