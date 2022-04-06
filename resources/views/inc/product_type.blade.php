<div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">Featured Products</h4>
                            <ul class="product_list_widget">
                                @foreach($feature_product as $fp)
                                <li>
                                    <a href="{{ route('details',$fp->id) }}" title="Tablet Thin EliteBook  Revolve 810 G6">
                                        @if($fp->image)
                                        <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $fp->image }}" src="{{ asset('assets/uploads/small/'.$fp->image) }}" alt="">
                                        @endif
                                        <span class="product-title">{{ $fp->name }}</span>
                                    </a>
                                    <span class="electro-price"><span class="amount">&#2547;{{ $fp->price }}</span></span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body"><h4 class="widget-title">Onsale Products</h4>
                            <ul class="product_list_widget">
                                @foreach($sale_product as $sp)
                                <li>
                                    <a href="{{ route('details',$fp->id) }}" title="Notebook Black Spire V Nitro  VN7-591G">
                                        @if($sp->image)
                                        <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $sp->image }}" src="{{ asset('assets/uploads/small/'.$sp->image) }}" alt="">
                                        @endif
                                        <span class="product-title">{{ $sp->title }}</span>
                                    </a>
                                    <span class="electro-price"><ins><span class="amount">&#2547;{{ $sp->price }}</span></ins>
                                        {{--<del><span class="amount">&#36;2,299.00</span></del>--}}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <aside class="widget clearfix">
                        <div class="body">
                            <h4 class="widget-title">Top Rated Products</h4>
                            <ul class="product_list_widget">
                                @foreach($top_product as $tp)
                                    <li>
                                        <a href="{{ route('details',$fp->id) }}" title="Notebook Black Spire V Nitro  VN7-591G">
                                            @if($tp->image)
                                            <img class="wp-post-image" data-echo="/assets/uploads/small/{{ $tp->image }}" src="{{ asset('assets/uploads/small/'.$tp->image) }}" alt="">
                                            @endif
                                            <span class="product-title">{{ $tp->title }}</span>
                                        </a>
                                        <span class="electro-price"><ins><span class="amount">&#2547;{{ $tp->price }}</span></ins>
                                            {{--<del><span class="amount">&#36;2,299.00</span></del>--}}
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>