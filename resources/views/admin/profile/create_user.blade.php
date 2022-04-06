@extends('layouts.admin.master')

@section('page')
    Create User
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
            <form class="kt-form" method="post" id="create_user">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <h5><strong>User Base Information</strong></h5><hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Enter full name">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" aria-describedby="emailHelp" placeholder="Enter phone">
                        </div>

                    </div>

                    <h5><strong>User Image</strong></h5><hr>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <h5><strong>User Password</strong></h5><hr>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Enter password confirmation">
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="javascript:history.back();" class="btn btn-secondary">Cancel</a>
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
        $("#create_user").on("submit",function (e) {
            e.preventDefault();
            var formData = new FormData( $("#create_user").get(0));
            $.ajax({
                url : "{{ route('user.store') }}",
                type: "post",
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