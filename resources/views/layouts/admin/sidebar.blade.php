<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__section kt-menu__section--first">
                    <h4 class="kt-menu__section-text">E-commerce</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item {{ Request::routeIs('home') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('home') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dashboard</span></a></li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ Request::routeIs('category','category.create','category.edit','subCategory','subCategory.create','subCategory.edit') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">

                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Category</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>

                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            <li class="kt-menu__item  kt-menu__item--parent {{ Request::routeIs('category','category.create','category.edit','subCategory','subCategory.create','subCategory.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Service</span></span></li>

                            <li class="kt-menu__item {{ Request::routeIs('category','category.create','category.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('category') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Category</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('subCategory','subCategory.create','subCategory.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('subCategory') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Sub Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="kt-menu__item {{ Request::routeIs('brand','brand.create','brand.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('brand') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Brand</span></a></li>

                   <li class="kt-menu__item {{ Request::routeIs('sliders','sliders.create','sliders.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">

                    <a href="{{ route('sliders') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Slider</span></a>
                   </li>

                <li class="kt-menu__item {{ Request::routeIs('product','product.create','product.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('product') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Product</span></a></li>

                 <li class="kt-menu__item {{ Request::routeIs('order.show','order.details','order.invoice') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('order.show') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Orders</span></a></li>


                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Services</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ Request::routeIs('service_type','service_type.create','service_type.edit','service','service.create','service.edit') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">

                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Service</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>

                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            <li class="kt-menu__item  kt-menu__item--parent {{ Request::routeIs('service_type','service_type.create','service_type.edit','service','service.create','service.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Service</span></span></li>

                            <li class="kt-menu__item {{ Request::routeIs('service_type','service_type.create','service_type.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('service_type') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Service Type</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('service','service.create','service.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('service') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Service</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Stock & Inventory</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ Request::routeIs('stock_category','stock_category.create','stock_category.edit', 'stock_brand','stock_brand.create','stock_brand.edit','stock_model','stock_model.create','stock_model.edit','stock','stock.create','stock.edit') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Stock Inventory</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent {{ Request::routeIs('stock_category','stock_category.create','stock_category.edit', 'stock_brand','stock_brand.create','stock_brand.edit','stock_model','stock_model.create','stock_model.edit','stock','stock.create','stock.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Stock Inventory</span></span></li>


                            <li class="kt-menu__item {{ Request::routeIs('stock_category','stock_category.create','stock_category.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('stock_category') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Category</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('stock_brand','stock_brand.create','stock_brand.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('stock_brand') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Brand</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('stock_model','stock_model.create','stock_model.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('stock_model') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Model</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('stock','stock.create','stock.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('stock') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">All Stock & Inventory</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Customer Message</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item {{ Request::routeIs('admin.get_user_message') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.get_user_message') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Message <span class="badge badge-success">
                            {{App\Message::whereNUll('parent_id')->where('is_seen',0)->count()}}
                        </span></span></a>
                </li>

               <li class="kt-menu__item {{ Request::routeIs('logo.show_logo') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('logo.show_logo') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Logo</span></a></li>


               <li class="kt-menu__item {{ Request::routeIs('banner.show_banner') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('banner.show_banner') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Banner</span></a></li>


               <li class="kt-menu__item {{ Request::routeIs('branch_office','branch_office.create','branch_office.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('branch_office') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Branch Office</span></a></li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Coupons</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ Request::routeIs('coupon','coupon.create','coupon.edit','user_coupon_list') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">

                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                        <span class="kt-menu__link-text">Coupons</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>

                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">

                            <li class="kt-menu__item  kt-menu__item--parent {{ Request::routeIs('coupon','coupon.create','coupon.edit','user_coupon_list') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Service</span></span></li>

                            <li class="kt-menu__item {{ Request::routeIs('coupon','coupon.create','coupon.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('coupon') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Coupon</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('user_coupon_list') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('user_coupon_list') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">User Coupon List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Others</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu {{ Request::routeIs('rider','rider.create','rider.edit','executive','executive.create','executive.edit','member','member.create','member.edit','customers','customers.create','customers.edit','quote','orderPayment','AddPayment','complain','pick_up','pick_up.assign_rider','assign_rider_create','pick_up.assign_rider_edit','drop_up','drop_up.drop_assign_rider','drop_up.drop_assign_rider_create','drop_up.drop_assign_rider_edit','payment','payment.invoice','user.show','create.user') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Customer Section</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent {{ Request::routeIs('rider','rider.create','rider.edit','executive','executive.create','executive.edit','member','member.create','member.edit','customers','customers.create','customers.edit','quote','orderPayment','AddPayment','complain','pick_up','pick_up.assign_rider','assign_rider_create','pick_up.assign_rider_edit','drop_up','drop_up.drop_assign_rider','drop_up.drop_assign_rider_create','drop_up.drop_assign_rider_edit','payment','payment.invoice','user.show','create.user') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Customer Request</span></span></li>

                            <li class="kt-menu__item {{ Request::routeIs('quote','orderPayment','AddPayment') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('quote') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Orders</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('complain') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('complain') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Complain</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('pick_up','pick_up.assign_rider','assign_rider_create','pick_up.assign_rider_edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('pick_up') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pickup Request</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('drop_up','drop_up.drop_assign_rider','drop_up.drop_assign_rider_create','drop_up.drop_assign_rider_edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('drop_up') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Drop-up Request</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('payment','payment.invoice') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('payment') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Payment</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('rider','rider.create','rider.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('rider') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Riders</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('user.show','create.user','user.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('user.show') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Users</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('executive','executive.create','executive.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('executive') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Executive</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('member','member.create','member.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('member') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Member</span>
                                </a>
                            </li>

                            <li class="kt-menu__item {{ Request::routeIs('customers','customers.create','customers.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                <a href="{{ route('customers') }}" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Customer</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>