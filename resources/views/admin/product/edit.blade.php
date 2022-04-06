@extends('layouts.admin.master')

@section('page')
    Edit Product
@endsection

@push('css')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
@endpush

@section('content')
    <div class="col-md-12">

        <!--begin::Portlet-->
        <div class="kt-portlet" id="edit_form_body">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @yield('page')
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form class="kt-form" method="post" id="update_product">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="current_image" id="current_image" value="{{ $product->image }}">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}" @if($product->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Sub Category</label>
                            <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                                <option value="">Select Sub-Category</option>
                                @foreach($sub_category as $sc)
                                    <option value="{{ $sc->id }}" @if($product->sub_cat_id == $sc->id) selected @endif>{{ $sc->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach($brand as $b)
                                    <option value="{{ $b->id }}" @if($product->category_id == $b->id) selected @endif>{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Product Type</label>
                            <select name="pro_type" id="pro_type" class="form-control">
                                <option value="">Select Product Type</option>
                                <option value="Original" {{($product->pro_type=='Original')? "selected" : ""}}>Original</option>
                                <option value="Market original" {{($product->pro_type=='Market original')? "selected" : ""}}>Market Origin</option>
                                <option value="Copy" {{($product->pro_type=='Copy')? "selected" : ""}}>Copy</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Model</label>
                            <input type="text" value="{{ $product->model }}" name="model" id="model" class="form-control" placeholder="Enter model">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Code</label>
                            <input type="text" value="{{ $product->code }}" name="code" id="code" class="form-control" placeholder="Enter code">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" value="{{ $product->name }}" name="name" id="name" class="form-control" placeholder="Enter name">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input type="text" value="{{ $product->title }}" name="title" id="title" class="form-control" placeholder="Enter title">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote">{{ $product->description }}</textarea>
                        </div>


                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <br>

                            @if (!empty($product->image))
                                <div>
                                    <img src="{{ asset('assets/uploads/small/'.$product->image) }}" alt="">
                                    <a rel="{{ $product->id }}" rel1="product/delete_image" class="text-danger" id="image_delete" style="cursor: pointer;">Remove Image</a>
                                </div>
                            @else
                                <div id="image-holder"></div>
                            @endif

                        </div>

                       

                        <div class="form-group col-md-6">
                            <label>Previous Price</label>
                            <input type="text" name="previous_price" value="{{ $product->previous_price }}"  id="previous_price" class="form-control" placeholder="Enter previous price">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Price</label>
                            <input type="text" value="{{ $product->price }}" name="price" id="price" class="form-control" placeholder="Enter price">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Discount (%)</label>
                            <input type="text" name="discount" id="discount" value="{{ $product->discount }}"  class="form-control" placeholder="Enter discount">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Quantity </label>
                            <input type="text" value="{{ $product->quantity }}" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Color</label>
                            <input type="text" value="{{ $product->color }}" name="color" id="color" class="form-control" placeholder="Enter color">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Warranty</label>
                            <input type="text" value="{{ $product->warranty }}" name="warranty" id="warranty" class="form-control" placeholder="Enter warranty">
                        </div>

                        <div class="form-group col-md-3">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" name="status" id="status" @if($product->status == 1) checked @endif> Status
                                <span></span>
                            </label>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" name="feature" id="feature" @if($product->feature == 1) checked @endif> Feature
                                <span></span>
                            </label>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" name="publish" id="publish" @if($product->publish == 1) checked @endif> Publish
                                <span></span>
                            </label>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                <input type="checkbox" name="new_arrival" id="new_arrival" @if($product->new_arrival == 1) checked @endif> New Arrival
                                <span></span>
                            </label>
                        </div>

                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
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

<script>
    $(document).ready(function () {
        $("#category_id").on("change", function (e) {
            e.preventDefault();

            var category_id = $("#category_id").val();

            //alert(category_id)

            $.ajax({
                url: "{{ route('product.get_sub_category') }}",
                method : "get",
                data : {category_id:category_id},
                dataType: "html",
                success: function (data) {
                    $("#sub_cat_id").html(data);
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function () {
        $("#image_delete").on("click",function (e) {
            e.preventDefault();
            var id = $(this).attr('rel');
            var deleteFunction = $(this).attr('rel1');
            swal({
                    title: "Are You Sure?",
                    text: "You will not be able to recover this record again",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete It"
                },
                function(){
                    $.ajax({
                        type: "get",
                        url: "{{ route('product.delete_image','') }}/"+id,
                        data: {id:id},
                        success: function (data) {

                            if(data.status_code === 200) {
                                $('#success_message').html('<div class="alert alert-secondary  fade show" role="alert">'+
                                    '<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>'+
                                    '<div class="alert-text">'+data.message+' !</div>'+
                                    '<div class="alert-close">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                    '<span aria-hidden="true"><i class="la la-close"></i></span>'+
                                    '</button>'+
                                    '</div>'+
                                    '</div>');
                            }
                            editForm();
                        }
                    });
                });
        })
    });

    function editForm() {
        $('#edit_form_body').load(' #edit_form_body');
    }

    $(document).ready(function () {
        $("#update_product").on("submit",function (e) {
            e.preventDefault();

            var id = $("#product_id").val();

            var formData = new FormData( $("#update_product").get(0));

            $.ajax({
                url : "{{ route('product.update','') }}/"+id,
                method : "post",
                data :  formData,
                dataType : "json",
                contentType: false,
                cache: false,
                processData: false,
                success : function (data) {
                    console.log(data);
                    if(data.status_code === 200) {
                        $('#success_message').html('<div class="alert alert-secondary  fade show" role="alert">'+
                            '<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>'+
                            '<div class="alert-text">'+data.message+' !</div>'+
                            '<div class="alert-close">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true"><i class="la la-close"></i></span>'+
                            '</button>'+
                            '</div>'+
                            '</div>');
                    }else {
                        $('#error_message').html('<div class="alert alert-danger fade show" role="alert">'+
                            '<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>'+
                            '<div class="alert-text">'+data.error+' !</div>'+
                            '<div class="alert-close">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true"><i class="la la-close"></i></span>'+
                            '</button>'+
                            '</div>'+
                            '</div>');
                    }
                    $("form").trigger("reset");
                    $('.form-group').find('.valids').hide();
                    editForm();
                },
                error : function (err) {
                    if (err.status === 422) {
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="'+i+'"]');
                            el.after($('<span class="valids" style="color: red;">'+error+'</span>'));
                        });
                    }
                }
            });
        });
    });
</script>
@endpush