<header id="masthead" class="site-header header-v2">
    <div class="container hidden-md-down">
        <div class="row">

            <!-- ============================================================= Header Logo ============================================================= -->
            <div class="header-logo">
                @php
                        $logo=App\Logo::findOrFail(1);
               @endphp
                <a href="{{ route('ecommerce') }}" class="header-logo-link">
                    <img src="{{ asset('assets/logo/'.$logo->logo) }}" alt="" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                </a>
            </div>
            <!-- ============================================================= Header Logo : End============================================================= -->

            <div class="primary-nav animate-dropdown">
                <div class="clearfix">
                    <button class="navbar-toggler hidden-sm-up pull-right flip" type="button" data-toggle="collapse" data-target="#default-header">
                        &#9776;
                    </button>
                </div>
                <div class="collapse navbar-toggleable-xs" id="default-header">
                    <nav>
                        <ul id="menu-main-menu" class="nav nav-inline yamm">

                            <li class="menu-item animate-dropdown"><a title="About Us" href="#">About Us</a></li>

                            <li class="menu-item"><a title="Features" href="#">Features</a></li>

                            <li class="menu-item"><a title="Contact Us" href="#">Contact Us</a></li>
                             <li class="menu-item"><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="header-support-info">
                <div class="">
                    <span class="media-left support-icon media-middle"><i class="ec ec-support"></i></span>
                    <div class="media-body">
                        <span class="support-number"><strong>Support</strong> 
                        (+800) 01842-950701</span><br/>
                        <span class="support-email">email:etechnologies247@gmail.com</span>
                    </div>
                </div>
            </div>

        </div><!-- /.row -->
    </div>

    <div class="container hidden-lg-up">
        <div class="handheld-header">

            <!-- ============================================================= Header Logo ============================================================= -->
            <div class="header-logo">
                <a href="{{ route('ecommerce') }}" class="header-logo-link">
                    <img src="{{ asset('img/techn.png') }}" alt="" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                </a>
            </div>
            <!-- ============================================================= Header Logo : End============================================================= -->

            <div class="handheld-navigation-wrapper">
                <div class="handheld-navbar-toggle-buttons clearfix">
                    <button class="navbar-toggler navbar-toggle-hamburger hidden-lg-up pull-right flip" type="button">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <button class="navbar-toggler navbar-toggle-close hidden-lg-up pull-right flip" type="button">
                        <i class="ec ec-close-remove"></i>
                    </button>
                </div>
                <div class="handheld-navigation hidden-lg-up" id="default-hh-header">
                    <span class="ehm-close">Close</span>
                    <ul id="menu-all-departments-menu-1" class="nav nav-inline yamm">
                        @foreach($category as  $cat)
                            <li class="menu-item menu-item-has-children animate-dropdown dropdown">
                                <a title="Accessories" href="{{ route('customrCategory','') }}/{{ $cat->id }}" class="dropdown-toggle" aria-haspopup="true">{{ $cat->name }}</a>
                                <ul role="menu" class=" dropdown-menu">
                                    <li class="menu-item animate-dropdown ">
                                        @foreach($sub_category as $sc)
                                            @if($cat->id == $sc->category_id)
                                                <a title="Cases" href="{{ route('subcategory.front','') }}/{{ $sc->id }}">{{ $sc->name }}</a>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</header><!-- #masthead -->

<nav class="navbar navbar-primary navbar-full hidden-md-down">
    <div class="container">
        <ul class="nav navbar-nav departments-menu animate-dropdown">
            <li class="nav-item dropdown ">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
                <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                    @foreach($category as  $cat)
                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2590 dropdown">
                            <a title="{{ $cat->name }}" href="{{ route('customrCategory','') }}/{{ $cat->id }}" class="dropdown-toggle" aria-haspopup="true">{{ $cat->name }}</a>

                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">

                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    @foreach($sub_category as $sc)
                                                                        @if($cat->id == $sc->category_id)
                                                                            <li><a href="{{ route('subcategory.front','') }}/{{ $sc->id }}">{{ $sc->name }}</a></li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endforeach

                </ul>
            </li>
        </ul>

        <form class="navbar-search" method="post" action="{{ route('product.search') }}">
            @csrf
            <label class="sr-only screen-reader-text" for="search">Search for:</label>
            <div class="input-group">
                <input type="text" name="search" class="form-control search-field" dir="ltr" value="" placeholder="Search for products" id="search_product"/>
                <div class="input-group-addon search-categories">
                    <select name='category_id' class='postform resizeselect' >
                        <option value='0' selected='selected'>All Categories</option>
                        @foreach($category as $cat)
                            <option class="level-0" value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                </div>
            </div>

        </form>


        <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip" id="shoping_cart_details_herader" data-action="{{ route('cart.item.load') }}">
            <li class="nav-item dropdown">
                <a href="cart.html" class="nav-link" data-toggle="dropdown">
                    <i class="ec ec-shopping-bag"></i>
                    <span class="cart-items-count count " id="setTotalItem2">{{App\Cart::totalitem()}}</span>
                    <span class="cart-items-total-price total-price"><span class="amount " id="setTotalAmount2">৳ {{App\Cart::totalprice()}}</span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-mini-cart">
                    <li>
                        <div class="widget_shopping_cart_content">
                            <ul class="cart_list product_list_widget " id="loadAllCartItme">
                                @if (!is_null(App\Cart::cart()))
                                    @foreach (App\Cart::cart() as $cart)
                                        {{-- expr --}}

                                        <li class="mini_cart_item cart_row">
                                            <a title="Remove this item" class="remove delete_item_head" href="javascript:;" cart_id="{{$cart->id}}" data-action="{{route("cart.remove")}}">×</a>
                                            <a href="{{ route('details',$cart->product_id) }}">
                                                <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{ asset('assets/uploads/small/'.$cart->product->image) }}" alt="">{{$cart->product_name}}
                                            </a>
                                            <span class="quantity">{{$cart->quantity}} x <span class="amount">{{$cart->product_price}}</span></span>
                                        </li>
                                    @endforeach
                                @else
                                    <h4>Empty Cart</h4>
                                @endif
                            </ul><!-- end product list -->
                        </div>
                        @if (Session::get('CustomerSession') !="")
                            <p class="buttons">
                                @if (!is_null(App\Cart::cart()))
                                    <a class="button wc-forward" href="{{ route('cart.item') }}">View Cart</a>
                                    <a class="button checkout wc-forward" href="{{ route('checkout') }}">Checkout</a>
                                @endif

                            </p>
        @endif

    </div>
    </li>
    </ul>
    </li>
    </ul>

    </div>
</nav>
<ul class="set_search_product_detail" id="set_search_product">

</ul>