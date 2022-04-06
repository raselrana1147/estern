@extends('layouts.admin.master')

@section('page')
    View Product
@endsection

@push('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endpush

@section('content')
    <div class="col-md-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @yield('page')
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form class="kt-form">
                @csrf
                <div class="kt-portlet__body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <input type="text" value="{{ $product->cat_name }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Brand</label>
                            <input type="text" value="{{ $product->brand_name }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Model</label>
                            <input type="text" value="{{ $product->model }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Code</label>
                            <input type="text"  value="{{ $product->code }}"  class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" value="{{ $product->name }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" value="{{ $product->title }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea disabled class="form-control summernote">{{ $product->description }}</textarea>
                        </div>


                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <img src="{{ asset('assets/uploads/small/'.$product->image) }}" alt="">
                        </div>

                    
                        <div class="form-group col-md-6">
                            <label>Previous Price</label>
                            <input type="text" name="previous_price" value="{{ $product->previous_price }}"  id="previous_price" class="form-control" placeholder="Enter previous price" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Price</label>
                            <input type="text" value="{{ $product->price }}" name="price" id="price" class="form-control" placeholder="Enter price" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Discount (%)</label>
                            <input type="text" name="discount" id="discount" value="{{ $product->discount }}"  class="form-control" placeholder="Enter discount" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" value="{{ $product->quantity }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Color</label>
                            <input type="text" value="{{ $product->color }}" class="form-control" disabled>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Warranty</label>
                            <input type="text" value="{{ $product->warranty }}" class="form-control" disabled>
                        </div>

                         <div class="form-group col-md-4">
                            <label>Product type</label>
                            <input type="text" value="{{ $product->pro_type }}" class="form-control" disabled>
                        </div>


                        <div class="form-group col-md-4">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" @if($product->status == 1) checked @endif> Status
                                <span></span>
                            </label>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" @if($product->feature == 1) checked @endif> Feature
                                <span></span>
                            </label>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" @if($product->publish == 1) checked @endif> Publish
                                <span></span>
                            </label>
                        </div>

                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <a href="{{ route('product.edit','') }}/<?= $product->id ?>" class="btn btn-primary">Edit</a>
                        <a href="{{ route('product') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@endsection

@push('js')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            dialogsInBody: true,
            callbacks:{
                onInit:function(){
                    $('body > .note-popover').hide();
                }
            },
        });
    });
</script>
@endpush