@extends('layouts.e_commerce.master')
@section('page')
    Eastern Teach
@endsection

@push('css')
@endpush
@section('content')
    <div id="content" class="site-content" tabindex="-1">
                <div class="container">

                    <nav class="woocommerce-breadcrumb"><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Checkout</nav>

                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="page type-page status-publish hentry">
                                <header class="entry-header"><h1 itemprop="name" class="entry-title">Checkout</h1></header><!-- .entry-header -->
                                <form action="{{ route('checkout.store') }}" class="checkout woocommerce-checkout" method="post">
                                    @csrf
                                    <div id="customer_details" class="col2-set">
                                        <div class="col-1">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Billing Details</h3>
                                                <p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name">Name <abbr title="required" class="required">*</abbr></label><input type="text" value="" name="customer_name" class="input-text " required=""></p>

                                                <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr></label><input type="tel" value="" name="customer_phone" class="input-text " required=""></p>

                                                <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="">Address <abbr title="required" class="required">*</abbr></label><input type="text" value="" name="customer_address" class="input-text " required=""></p>

                                                <div class="clear"></div>                                      
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <h3>Shipping Details</h3>
                                            <div class="woocommerce-shipping-fields">
                                         
                                                <p id="order_comments_field" class="form-row form-row notes"><label class="" for="order_comments">Order Notes (optional)</label>
                                                    <textarea cols="5" rows="2" id="order_note" class="input-text " name="order_note"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 id="order_review_heading">Your order</h3>

                                    <div class="woocommerce-checkout-review-order" id="order_review">
                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (count($cartItem)>0)
                                                
                                              @foreach ($cartItem as $cart)
                                            
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{$cart->product_name}}
                                                        <strong class="product-quantity">× {{$cart->quantity}}</strong>
                                                    </td>
                                                <td class="product-total">
                                                    <span class="amount">৳ {{$cart->quantity*$cart->product_price}}</span>
                                               </td>
                                                </tr>
                                                  @endforeach
                                                  @endif
                                            </tbody>

                                            <tfoot>

                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="amount">৳ {{App\Cart::totalprice()}}</span></td>
                                                </tr>

                                                <tr class="shipping">
                                                    <th>Shipping</th>
                                                    <td data-title="Shipping">Flat Rate: <span class="amount">৳ 0.00</span>
                                                </tr>

                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="amount">৳ {{App\Cart::totalprice()}}</span></strong> </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="woocommerce-checkout-payment" id="payment">
                                            <ul class="wc_payment_methods payment_methods methods">
                                              
                                                <li class="wc_payment_method payment_method_cod">
                                                    <input type="radio"  name="payment_method" class="input-radio getpayment" id="" pay_name="cash" value="Cash On Delivery">
                                                    <label for="payment_method_cod">Cash on Delivery</label>
                                        
                                                </li>

                                                 <li class="wc_payment_method payment_method_cod">
                                                    <input type="radio" value="Bkash" name="payment_method" class="input-radio getpayment" id="" pay_name="bkash">
                                                    <label for="payment_method_cod">Bkash</label>
                                                    
                                                </li>

                                                 <li class="wc_payment_method payment_method_cod">
                                                    <input type="radio" value="Rocket" name="payment_method" class="input-radio getpayment" pay_name="rocket">
                                                    <label for="payment_method_cod">Rocket</label>
                                                    
                                                </li>

                                            </ul>

                                            <div class="form-row place-order" id="payment_area" style="display: none">
                                                <p style="display: none" id="bkask_area"><strong> BKash Number: 014575225541</strong></p>
                                                <p style="display: none" id="rocket_area"><strong> Rocket Number: 56415745487</strong></p>

                                                 <p  class="form-row-last validate-required validate-phone"><label class="" for="billing_phone">Customer's Number</label>
                                                    <input type="tel" value="" id="customer_account_number" name="customer_account_number" class="input-text ">
                                                </p>


                                                <p  class="form-row-last validate-required validate-phone"><label class="" for="billing_phone">Transaction Number</label>
                                                    <input type="tel" value="" id="transaction_number" name="transaction_number" class="input-text ">
                                                </p>
                                               
                                            </div>
                                        </div>
                                        <br>
                                            <div class="form-row place-order">
                                                <input type="submit" data-value="Place order" value="Place order" class="button alt">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </article>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .container -->
            </div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('body').on('click','.getpayment',function(){
            let payment_type=$(this).val();
            let paynumber=$(this).attr('pay_name');
        
            if (paynumber==='cash') {
                $('#payment_area').hide();
                $('#transaction_number').removeAttr('required');
                $('#customer_account_number').removeAttr('required');
            }else{
                if (paynumber==='bkash') {
                      $('#bkask_area').show();
                      $('#rocket_area').hide();
                    }
                    if (paynumber==='rocket') {
                       $('#bkask_area').hide();
                      $('#rocket_area').show();
                    }
                $('#payment_area').show();
                $('#transaction_number').attr('required', 'true');
                $('#customer_account_number').attr('required', 'true');
            }
        });

      
    });
</script>

@endpush


