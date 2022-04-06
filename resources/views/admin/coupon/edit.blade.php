@extends('layouts.admin.master')

@section('page')
    Create Coupon
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
            <form class="kt-form" method="post" id="update_coupon" enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" name="coupon_id" id="coupon_id" value="{{ $coupon->id }}">

                    <div class="form-group">
                        <label>Coupon Code</label>
                        <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control" placeholder="Enter Coupon Code">
                    </div>

                    <div class="form-group">
                        <label>Coupon Amount</label>
                        <input type="text" name="coupon_amount" value="{{ $coupon->coupon_amount }}" class="form-control" placeholder="Enter Coupon Code">
                    </div>

                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date" name="start_date" value="{{ $coupon->start_date }}" class="form-control" placeholder="Enter Start Date">
                    </div>

                    <div class="form-group">
                        <label for="">End Date</label>
                        <input type="date" name="end_date" value="{{ $coupon->end_date }}" class="form-control" placeholder="Enter End Date">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <img src="{{ asset('assets/coupon/small/'.$coupon->image) }}" style="width: 50px;height: 50px">

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('coupon') }}" class="btn btn-secondary">Cancel</a>
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
        $("#update_coupon").on("submit",function (e) {
            e.preventDefault();

            var id = $("#coupon_id").val();

            var formData = new FormData( $("#update_coupon").get(0));

            $.ajax({
              url : "{{ route('coupon.update','') }}/"+id,
              method: "post",
              data: formData,
              dataType: "json",
              contentType: false,
              cache: false,
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
                    }

                    if (data.status_code === 500){
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