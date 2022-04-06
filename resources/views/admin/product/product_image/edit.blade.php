@extends('layouts.admin.master')

@section('page')
    Edit Product Image
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
            <form class="kt-form" method="post" id="edit_product_image">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" id="product_image_id" value="{{ $product_image->id }}">

                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" name="product_image" class="form-control">

                        <br><br>

                        @if (!empty($product_image->product_image))
                            <div>
                                <img src="{{ asset('assets/product/small/'.$product_image->product_image) }}" alt="">
                                <a rel="{{ $product_image->id }}" rel1="product/edit_delete_image" class="text-danger" id="image_delete" style="cursor: pointer;">Remove Image</a>
                            </div>
                        @else
                            <div id="image-holder"></div>
                        @endif
                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('image','') }}/<?= $product_image->product_id ?>" class="btn btn-secondary">Cancel</a>
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
                        url: "{{ route('edit_delete_image','') }}/"+id,
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

                                editForm();
                            }
                        }
                    });
                });
        })
    });

    function editForm() {
        $('#edit_form_body').load(' #edit_form_body');
    }

    $(document).ready(function () {
        $("#edit_product_image").on("submit",function (e) {
            e.preventDefault();

            var id = $("#product_image_id").val();

            var formData = new FormData( $("#edit_product_image").get(0));

            $.ajax({
                url : "{{ route('image_update','') }}/"+id,
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