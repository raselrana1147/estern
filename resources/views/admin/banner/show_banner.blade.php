@extends('layouts.admin.master')

@section('page')
    Show Banner
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

            <form class="kt-form" method="post" id="edit_banner" enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet__body">

                    <div class="form-group form-group-last" id="success_message"></div>

                    <div class="form-group form-group-last" id="error_message"></div>

                        <div class="current_image">
                            <img src="{{ asset('assets/banner/'.$banner->image) }}" alt="banner" width="80%">
                        </div>
                   
                    <div class="form-group">
                        <label>Banner Image</label>
                        
                        <input type="file" name="image" class="form-control" >
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
        $("#edit_banner").on("submit",function (e) {
            e.preventDefault();
            var formData = new FormData( $("#edit_banner").get(0));
            $.ajax({
                url : "{{ route('banner.update') }}",
                type: "post",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('.current_image').html("<img src='{{ asset('assets/banner/') }}/"+data.filename+"' alt='banner'  width='80%'>")   
                },   
            });
        })
    })
</script>

@endpush