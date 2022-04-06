@extends('layouts.admin.master')

@section('page')
    Create Pick Up Rider Assign
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
            <form class="kt-form" method="post" id="create_assign_rider">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <div class="form-group">
                        <label>Service Id</label>
                        <input type="text" name="service_id" id="service_id" value="{{ $pick_up->service_id }}" class="form-control" disabled>
                        <input type="hidden" name="pick_up_id" id="pick_up_id" value="{{ $pick_up->id }}" class="form-control">
                        <input type="hidden" name="pick_up_cost" id="pick_up_cost" value="{{ $pick_up->pick_up_cost }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Rider</label>
                        <select name="rider_id" id="rider_id" class="form-control">
                            <option value="">Select Rider</option>
                            @foreach($rider as $ri)
                                <option value="{{ $ri->id }}">{{ $ri->name }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('pick_up.assign_rider','') }}/<?= $pick_up->id ?>" class="btn btn-secondary">Cancel</a>
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
        $("#create_assign_rider").on("submit",function (e) {
            e.preventDefault();
            var formData = $("#create_assign_rider").serializeArray();
            $.ajax({
                url : "{{ route('pick_up.assign_rider_store') }}",
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

                    if(data.status_code === 500){
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