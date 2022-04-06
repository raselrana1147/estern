@extends('layouts.admin.master')

@section('page')
    Member Role Update
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
            <form class="kt-form" method="post" id="update_member_role">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" id="member_id" value="{{ $member->id }}">

                    <div class="form-group">
                        <label>User Role</label>
                        <select name="user_role_id" id="user_role_id" class="form-control">
                            <option value="">Select User Role</option>
                            <option value="2" @if($member->user_role_id == 2) selected @endif>Executive</option>
                            <option value="3" @if($member->user_role_id == 3) selected @endif>Customer</option>
                            <option value="4" @if($member->user_role_id == 4) selected @endif>Member</option>
                            <option value="5" @if($member->user_role_id == 5) selected @endif>Rider</option>
                        </select>
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('member') }}" class="btn btn-secondary">Cancel</a>
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
        $("#update_member_role").on("submit",function (e) {
            e.preventDefault();

            var id = $("#member_id").val();

            var formData = $("#update_member_role").serializeArray();

            $.ajax({
                url : "{{ route('member.update','') }}/"+id,
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