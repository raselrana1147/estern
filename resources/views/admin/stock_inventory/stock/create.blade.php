@extends('layouts.admin.master')

@section('page')
    Create Stock
@endsection

@push('css')
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
            <form class="kt-form" method="post" id="create_stock" enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                     <div class="form-group col-md-12">
                            <label>Upload CSV (If You select any csv file you don't need fill bellow feilds)</label>
                           <input type="file" name="upload_csv" class="form-control" accept=".csv">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="stock_category_id" id="stock_category_id" class="form-control">
                                <option value="">Select Stock Category</option>
                                @foreach($stock_category as $sc)
                                    <option value="{{ $sc->id }}">{{ $sc->stock_category_name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Brand</label>
                            <select name="stock_brand_id" id="stock_brand_id" class="form-control">
                                <option value="">Select Stock Brand</option>
                                @foreach($stock_brand as $sb)
                                    <option value="{{ $sb->id }}">{{ $sb->stock_brand_name }}</option>
                                    @endforeach
                            </select>
                        </div>

                         <div class="form-group col-md-6">
                            <label>Select Branch</label>
                            <select name="branch_office_id" id="branch_office_id" class="form-control">
                                <option value="">Select Branch</option>
                                @foreach($branch_offices as $branch_office)
                                    <option value="{{ $branch_office->id }}">{{ $branch_office->address }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Model</label>
                            <select name="stock_model_id" id="stock_model_id" class="form-control">
                                <option value="">Select Stock Model</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Quality</label>
                            <input type="text" name="quality" id="quality" class="form-control" placeholder="Enter quality">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Color</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="example green, white">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Variation</label>
                            <input type="text" name="variation" id="variation" class="form-control" placeholder="Enter variation">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Purchase Price</label>
                            <input type="text" name="purchase_price" id="purchase_price" class="form-control" placeholder="Enter purchase Price">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Retail Price</label>
                            <input type="text" name="retail_price" id="retail_price" class="form-control" placeholder="Enter retail Price">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Whole Sale Price</label>
                            <input type="text" name="whole_sale_price" id="whole_sale_price" class="form-control" placeholder="Enter whole sale Price">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Available</label>
                           <select class="form-control" name="available">
                               <option value="0">Available</option>
                               <option value="1">Unavailable</option>
                           </select>
                        </div>


                       


                    </div>


                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('stock') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@endsection

@push('js')


<script>


    $(document).ready(function () {
        $("#stock_brand_id").on("change",function () {
            var stock_brand_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('stock.get_model') }}",
                type: "post",
                data: {stock_brand_id:stock_brand_id, _token:_token},
                dataType: "html",
                success: function (html) {
                    $("#stock_model_id").html(html);
                }
            });
        })
    })


    $(document).ready(function () {
        $("#create_stock").on("submit",function (e) {
            e.preventDefault();
           var formData =  new FormData($(this)[0]);
            $.ajax({
                url : "{{ route('stock.store') }}",
                type: "post",
                data: formData,
                dataType: "json",
                async:true,
                cache: false,
                contentType: false,
                processData: false,
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
        })
    })
</script>
@endpush