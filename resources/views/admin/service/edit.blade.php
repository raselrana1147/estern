@extends('layouts.admin.master')

@section('page')
    Edit Service
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
            <form class="kt-form" method="post" id="update_service">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" id="service_id" value="{{ $service->id }}">

                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($stock_brand as $sb)
                                <option value="{{ $sb->id }}" @if($service->brand_id == $sb->id) selected @endif>{{ $sb->stock_brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label>Model</label>
                        <select name="model_id" id="model_id" class="form-control">
                            <option value="">Model</option>
                            @foreach($stock_model as $sm)
                                <option value="{{ $sm->id }}" @if($service->model_id == $sm->id) selected @endif>{{ $sm->model_name }}</option>
                                @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label>Service Type</label>
                        <select name="service_type_id" id="service_type_id" class="form-control">
                            <option value="">Select Service Type</option>
                            @foreach($service_type as $st)
                                <option value="{{ $st->id }}" @if($service->service_type_id == $st->id) selected @endif>{{ $st->service_type_name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Service Name</label>
                        <input type="text" value="{{ $service->service_name }}" name="service_name" id="service_name" class="form-control" placeholder="Enter service name">
                    </div>

                    <div class="form-group">
                        <label>Service Charge</label>
                        <input type="text" value="{{ $service->charge }}" name="charge" id="charge" class="form-control" placeholder="Enter charge">
                    </div>


                    <div class="form-group">
                        <label>Service Total Duration</label>
                        <input type="text" value="{{ $service->total_duration }}" name="total_duration" id="total_duration" class="form-control" placeholder="Enter total duration">
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('service') }}" class="btn btn-secondary">Cancel</a>
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
        $("#brand_id").on("change",function () {
            var stock_brand_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('stock.get_model') }}",
                type: "post",
                data: {stock_brand_id:stock_brand_id, _token:_token},
                dataType: "html",
                success: function (html) {
                    $("#model_id").html(html);
                }
            });
        })
    })

    $(document).ready(function () {
        $("#update_service").on("submit",function (e) {
            e.preventDefault();

            var id = $("#service_id").val();

            var formData = $("#update_service").serializeArray();

            $.ajax({
                url : "{{ route('service.update','') }}/"+id,
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