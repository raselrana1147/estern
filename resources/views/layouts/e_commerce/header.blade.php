<header id="masthead" class="site-header header-v1">
    <div class="container hidden-md-down">
        <div class="row">

            <!-- ============================================================= Header Logo ============================================================= -->
            <div class="header-logo">
                <a href="{{ route('ecommerce') }}" class="header-logo-link">
                    @php
                        $logo=App\Logo::findOrFail(1);
                    @endphp
                    <img src="{{ asset('assets/logo/'.$logo->logo) }}" alt="" width="175.748px" height="42.52px" viewBox="0 0 175.748 42.52" enable-background="new 0 0 175.748 42.52">
                    {{--<h1 class="text-capitalize text-theme-12">Eastern Tech</h1>--}}
                </a>
            </div>
            <!-- ============================================================= Header Logo : End============================================================= -->

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
                <ul id="set_search_product">
                    
                </ul>
            </form>


            <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip" id="shoping_cart_header" data-action="{{ route('cart.item.load') }}">
                <li class="nav-item dropdown">
                   
                    <a href="" class="nav-link" data-toggle="dropdown">
                        <i class="ec ec-shopping-bag"></i>
                        <span class="cart-items-count count" id="setTotalItem">{{App\Cart::totalitem()}}</span>
                        <span class="cart-items-total-price total-price"><span class="amount" id="setTotalAmount">৳ {{App\Cart::totalprice()}}<span ></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-mini-cart" id="header_area_reload">
                        <li>
                            <div class="widget_shopping_cart_content">

                                <ul class="cart_list product_list_widget" id="loadAllCartItme">

                                   @if (!is_null(App\Cart::cart()))

                                    @foreach (App\Cart::cart() as $cart)
                                    <li class="mini_cart_item cart_row">

                                        <a title="Remove this item" class="remove delete_item_head" href="javascript:;" cart_id="{{$cart->id}}" data-action="{{route('cart.remove')}}">×</a>

                                        <a href="{{ route('details',$cart->product_id) }}">
                                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{ asset('assets/uploads/small/'.$cart->product->image) }}" alt=""> {{$cart->product_name}}
                                        </a>
                                        <span class="quantity">{{$cart->quantity}}× <span class="amount">৳ {{$cart->product_price}}</span></span>
                                    </li>
                                     @endforeach
                                     @else
                                        <h4>Empty Cart</h4>
                                    @endif
                                </ul>

                                </p>
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

        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12 col-lg-3">

                <nav>
                    <ul class="list-group vertical-menu yamm make-absolute">
                        <li class="list-group-item"><span><i class="fa fa-list-ul"></i> All Departments</span></li>

                        @foreach($category as  $cat)
                        <li id="menu-item-2695" class="menu-item menu-item-has-children animate-dropdown dropdown">
                            <a title="Accessories" data-hover="dropdown" href="{{ route('customrCategory','') }}/{{ $cat->id }}" data-toggle="" class="dropdown-toggle getCategory" aria-haspopup="true" catid="{{$cat->id}}">{{ $cat->name }}</a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach($sub_category as $sc)
                                    @if($cat->id == $sc->category_id)
                                <li class="menu-item animate-dropdown"><a title="Cases" href="{{ route('subcategory.front',$sc->id) }}">{{ $sc->name }}</a></li>
                                    @endif
                                    @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="col-xs-12 col-lg-9">
                <nav>
                    <ul id="menu-secondary-nav" class="secondary-nav">
                        <li class="highlight menu-item"><a href="#">Shop</a></li>
                        <li class="menu-item"><a href="#">Featured Brands</a></li>
                        <li class="menu-item"><a href="#">Contact Us</a></li>
                        <li class="menu-item"><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container hidden-lg-up">
        <div class="handheld-header">

            <!-- ============================================================= Header Logo ============================================================= -->
            <div class="header-logo">
                <a href="{{ route('ecommerce') }}" class="header-logo-link">
                    <img src="{{ asset('img/techn.png') }}" alt="" width="100px">
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
                            <a title="Accessories" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">{{ $cat->name }}</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown ">
                                    @foreach($sub_category as $sc)
                                        @if($cat->id == $sc->category_id)
                                    <a title="Cases" href="{{ route('subcategory.front',$sc->id) }}">{{ $sc->name }}</a>
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