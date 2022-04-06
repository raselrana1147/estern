@extends('layouts.admin.master')

@section('page')
    Create Rider
@endsection

@push('css')
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
            <form class="kt-form" method="post" id="update_rider">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" id="rider_id" value="{{ $rider->id }}">

                    <h5><strong>Rider Base Information</strong></h5><hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" value="{{ $rider->name }}" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Enter full name">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="text" value="{{ $rider->email }}" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" value="{{ $rider->phone }}" name="phone" class="form-control" aria-describedby="emailHelp" placeholder="Enter phone">
                        </div>

                        <div class="form-group col-md-6">
                            <label>NID</label>
                            <input type="text" value="{{ $rider->nid }}" name="nid" class="form-control" aria-describedby="emailHelp" placeholder="Enter nid">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Country</label>
                            <input type="text" value="{{ $rider->country }}" name="country" class="form-control" aria-describedby="emailHelp" placeholder="Enter country">
                        </div>

                        <div class="form-group col-md-6">
                            <label>City</label>
                            <input type="text" value="{{ $rider->city }}" name="city" class="form-control" aria-describedby="emailHelp" placeholder="Enter city">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Zip</label>
                            <input type="text" value="{{ $rider->zip }}" name="zip" class="form-control" aria-describedby="emailHelp" placeholder="Enter zip">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Postal Code</label>
                            <input type="text" value="{{ $rider->postal_code }}" name="postal_code" class="form-control" aria-describedby="emailHelp" placeholder="Enter postal code">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea name="address" id="" cols="30" rows="10" class="form-control">{{ $rider->address }}</textarea>
                        </div>
                    </div>

                    <h5><strong>Rider Image</strong></h5><hr>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">

                        <br>

                        @if (!empty($rider->image))
                            <div>
                                <img src="{{ asset('assets/rider/small/'.$rider->image) }}" alt="">
                                <a rel="{{ $rider->id }}" class="text-danger" id="image_delete" style="cursor: pointer;">Remove Image</a>
                            </div>
                        @else
                            <div id="image-holder"></div>
                        @endif
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('rider') }}" class="btn btn-secondary">Cancel</a>
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
        $("#image_delete").on("click",function (e) {
            e.preventDefault();
            var id = $(this).attr('rel');
            var _token = $('input[name="_token"]').val();
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
                        type: "POST",
                        url: "{{ route('rider.delete_image','') }}/"+id,
                        data: {_token:_token},
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
                            //editForm();
                        }
                    });
                });
        })
    });

    function editForm() {
        $('#edit_form_body').load(' #edit_form_body');
    }

    $(document).ready(function () {
        $("#update_rider").on("submit",function (e) {
            e.preventDefault();

            var id = $("#rider_id").val();

            var formData = new FormData( $("#update_rider").get(0));

            $.ajax({
                url : "{{ route('rider.update','') }}/"+id,
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
                            el.after($('<span class="valids" style="color:red;">'+error+'</span>'));
                        });
                    }
                }
            });
        })
    })
</script>
@endpush