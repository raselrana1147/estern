@extends('layouts.admin.master')

@section('page')
    Add Payment Order
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
            <form class="kt-form" method="post" id="create_payment">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" name="payment_service_id" id="payment_service_id" value="{{ $service_payment->id }}">

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                    </div>

                    @if($service_payment->coupon_code != null)
                    <div class="form-group">
                        <label for="">Coupon Code</label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ $service_payment->coupon_code }}">
                        <input type="hidden" name="coupon_id" id="coupon_id" class="form-control" value="{{ $service_payment->coupon_id }}">
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" name="total" id="total" class="form-control" placeholder="Enter Total">
                    </div>

                    <div class="form-group">
                        <label>Sub Total</label>
                        <input type="text" name="sub_total" id="sub_total" class="form-control" placeholder="Enter Sub Total">
                    </div>


                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('orderPayment','') }}/<?= $service_payment->quote_id ?>" class="btn btn-secondary">Cancel</a>
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
        $("#create_payment").on("submit",function (e) {
            e.preventDefault();
            var formData = $("#create_payment").serializeArray();
            $.ajax({
                url : "{{ route('order_payment_store') }}",
                type: "post",
                data: $.param(formData),
                dataType: "json",
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

                    if (data.status_code === 500)
                    {
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

    $(document).ready(function () {
        $("#amount").on("change", function () {

            var coupon_id = $("#coupon_id").val();

            var amount = $(this).val();

            $.ajax({
                url: "{{ route('quote.get_coupons','') }}/"+coupon_id,
                type: "GET",
                data: {coupon_id:coupon_id},
                dataType: "json",
                success: function (data) {
                    let coupon_amount = data.coupon.coupon_amount;

                    let TodayDate = new Date();
                    let endDate= new Date(Date.parse(data.coupon.end_date));

                    if (endDate < TodayDate) {
                       $("#success_message").html('<div class="alert alert-secondary  fade show" role="alert">'+
                           '<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>'+
                           '<div class="alert-text">Coupon is Invalid Try New  !</div>'+
                           '<div class="alert-close">'+
                           '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                           '<span aria-hidden="true"><i class="la la-close"></i></span>'+
                           '</button>'+
                           '</div>'+
                           '</div>');
                    }else {
                        let result = parseFloat(amount) - parseFloat(coupon_amount);

                        $("#total").val(result);
                        $("#sub_total").val(result);
                    }
                }
            });
        })
    })
</script>
@endpush