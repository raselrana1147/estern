@extends('layouts.admin.master')

@section('page')
    DashBoard
@endsection

@push('css')
@endpush

@section('content')
<div class="col-xl-12">

    <!--begin:: Widgets/Activity-->
    <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Activity
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-widget17">
                <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                    <div class="kt-widget17__chart" style="height:320px;">
                        <canvas id="kt_chart_activities"></canvas>
                    </div>
                </div>
                <div class="kt-widget17__stats">
                    <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fas fa-money-check" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total E-commerce Product</span>
                            <span class="kt-widget17__desc" style="font-size: 25px;">{{App\Product::count()}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fas fa-money-check" style="color: #f35287"></i> </span> </span>
                            <span class="kt-widget17__subtitle">Total E-Eommerce Orders</span>
                            <span class="kt-widget17__desc" style="font-size: 25px;">{{App\Order::count()}}</span>
                        </div>

                    </div>

                     <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fab fa-first-order"  style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Service Order's</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{App\Quote::count()}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fas fa-sticky-note" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Stock</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{App\Stock::count()}}</span>
                        </div>

                    </div>

                    <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                              <i class="fas fa-people-carry" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Riders</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{DB::table('rider_info')->count()}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                               <i class="fas fa-people-carry" style="color: #f35287"></i></span>
                            <span class="kt-widget17__subtitle">Total Customers</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{App\User::where('user_role_id',3)->count()}}</span>
                        </div>
                    </div>

                      <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                               <i class="fas fa-user-friends" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Members</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{App\User::where('user_role_id',4)->count()}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                 <i class="fas fa-user-friends" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Executive</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{App\User::where('user_role_id',2)->count()}}</span>
                        </div>

                    </div>

                       <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fas fa-truck-pickup" style="color: #f35287"></i> </span>
                            <span class="kt-widget17__subtitle">Total Pick Up Requests</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{DB::table('pick_up')->count()}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                               <i class="fab fa-dropbox" style="color: #f35287"></i>  </span>
                            <span class="kt-widget17__subtitle">Total Drop Request</span>
                            <span class="kt-widget17__desc" style="font-size:25px">{{DB::table('drop_up')->count()}}</span>
                        </div>

                    </div>

                      <div class="kt-widget17__items">

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                 <i class="fas fa-money-check" style="color: #f35287"></i> </span>  </span>
                            <span class="kt-widget17__subtitle">Total E-Commerce's Amount</span>
                            <span class="kt-widget17__desc" style="font-size:25px">৳ {{DB::table('orders')->sum('grand_total')}}</span>
                        </div>

                        <div class="kt-widget17__item">
                            <span class="kt-widget17__icon">
                                <i class="fas fa-money-check" style="color: #f35287"></i> </span> </span>
                            <span class="kt-widget17__subtitle">Total Service Amount</span>
                            <span class="kt-widget17__desc" style="font-size:25px">৳ {{DB::table('customer_services')->sum('amount')}}</span>
                        </div>

                    </div>

<div class="kt-widget17__items">
    <div class="kt-widget17__item">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--mobile">
                
                <span class="kt-widget17__subtitle">Latest Customers</span>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $customers=App\User::where('user_role_id',3)->orderBy('id','DESC')->take('5')->get();
                        @endphp
                        @foreach ($customers as $customer)
                        {{-- expr --}}
                        
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{($customer->phone !=null) ? $customer->phone : 'N\A'}}</td>
                            <td><a href="{{ route('customers') }}"><img src="{{asset('img/default.jpg')}}" style="width: 20px"
                            ></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <div class="kt-widget17__item">
        <span class="kt-widget17__subtitle">Latest Riders</span>
        <table class="table">
            <thead>
                <tr>
                    <th>NID</th>
                    <th>Country</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                @php
                $riders=DB::table('rider_info')->orderBy('id','DESC')->take('5')->get();
                @endphp
                @foreach ($riders as $rider)
                {{-- expr --}}
                
                <tr>
                    <td>{{$rider->nid}}</td>
                    <td>{{$rider->country}}</td>
                    <td>{{$rider->city}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>



<div class="kt-widget17__items">
    <div class="kt-widget17__item">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--mobile">
                
                <span class="kt-widget17__subtitle">Latest Brands</span>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $brands=App\Brand::orderBy('id','DESC')->take('5')->get();
                        @endphp
                        @foreach ($brands as $brand)
                        {{-- expr --}}
                        
                        <tr>
                            <td>{{$brand->name}}</td>
                            <td><img src="{{asset('assets/brand/small/'.$brand->brand_image)}}" style="width:50px"></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <div class="kt-widget17__item">
        <span class="kt-widget17__subtitle">Latest Coupon</span>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Amount</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @php
                $coupons=DB::table('cupons')->orderBy('id','DESC')->take('5')->get();

                @endphp
                @foreach ($coupons as $coupon)
                {{-- expr --}}
                @php
                    $start_date = strtotime($coupon->start_date);
                    $end_date = strtotime($coupon->end_date);

                    //$total_date = $end_date - $start_date;

                    $timeDiff = abs($end_date - $start_date);

                    $numberDays = $timeDiff/86400;  // 86400 seconds in one day

                    // and you might want to convert to integer
                    $numberDays = intval($numberDays);
                @endphp
                <tr>
                    <td>{{$coupon->coupon_code}}</td>
                    <td>{{$coupon->coupon_amount}}</td>
                    <td>{{ $numberDays }} days</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>




        <div class="kt-widget17__items">

                <div class="kt-widget17__item">
                <div class="col-md-12">

            <div class="kt-portlet kt-portlet--mobile">
                    
                 <span class="kt-widget17__subtitle">Latest Products</span>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $products=App\Product::orderBy('id','DESC')->take('5')->get();
                                @endphp
                                @foreach ($products as $product)
                                    {{-- expr --}}
                              
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>৳ {{$product->price}}</td>
                                    <td>
                                     <a href="{{ route('product.view',$product->id) }}">
                                      <img src="{{asset('assets/uploads/small/'.$product->image)}}" style="width: 20px">
                                </td>
                                     </a>
                                </tr>
                               
                              @endforeach
                            </tbody>
                        </table>
                     
                   
                </div>

                 </div>
            </div>
        <div class="kt-widget17__item">
            <span class="kt-widget17__subtitle">Latest Stocks</span>
            <table class="table">
                <thead>
                    <tr>
                        <th>Purchase Price</th>
                        <th>Retail Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stocks=App\Stock::orderBy('id','DESC')->take('5')->get();
                    
                    @endphp
                    @foreach ($stocks as $stock)
                    {{-- expr --}}
                    
                    <tr>
                        <td>৳ {{$stock->purchase_price}}</td>
                        <td>৳ {{$stock->retail_price}}</td>
                        <td>{{$stock->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>


                    </div>

                </div>

                
            </div>
        </div>
    </div>





    <!--end:: Widgets/Activity-->


</div>
@endsection

@push('js')
@endpush