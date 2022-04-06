@extends('layouts.admin.master')

@section('page')
    Create Product Image
@endsection

@push('css')
<link href="{{ asset('assets/new_admin/assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
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

            <div class="col-md-12" style="margin-top: 10px">
                <form class="kt-form dropzone" action="{{ route('image_upload','') }}/<?= $product->id ?>" id="dropzone" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <a href="{{ route('image','') }}/<?= request()->id ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->

    </div>
@endsection

@push('js')
<script src="{{ asset('assets/new_admin/assets/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>

<script>
    Dropzone.options.dropzone =
        {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            uploadMultiple: true,
            timeout: 5000,
            removedfile: function(file)
            {
                var _token = $('input[name = "_token"]').val();
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('image_delete') }}',
                    data: {filename: name, _token:_token},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
                return false;
            }
        };
</script>
@endpush