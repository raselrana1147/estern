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
            <form class="kt-form" method="post" id="update_slider">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                    <input type="hidden" name="slider_id" id="slider_id" value="{{ $slider->id }}">

                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <input type="hidden" name="current_image" id="current_image" value="{{ $slider->image }}">
                            <br>

                            @if (!empty($slider->image))
                                <div>
                                    <img src="{{ asset('assets/slider/'.$slider->image) }}" alt="" style="width: 300px;height:  180px">
                                    <a rel="{{ $slider->id }}" rel1="slider/delete_image" class="text-danger" id="image_delete_slider" style="cursor: pointer;">Remove Image</a>
                                </div>
                            @else
                                <div id="image-holder"></div>
                            @endif

                        </div>

                    </div>

                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('sliders') }}" class="btn btn-secondary">Cancel</a>
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

     

        $("#image_delete_slider").on("click",function (e) {
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
                        url: "{{ route('slider.delete_image','') }}/"+id,
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
        $("#update_slider").on("submit",function (e) {
            e.preventDefault();

            var id = $("#slider_id").val();

            var formData = new FormData( $("#update_slider").get(0));
            console.log(id);

            $.ajax({
                url : "{{ route('sliders.update','') }}/"+id,
                type : "POST",
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