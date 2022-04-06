@extends('layouts.admin.master')

@section('page')
    Drop Up Assign Rider
@endsection

@push('css')
<style type="text/css">
    /* Basic Rules */
    .switch input {
        display:none;
    }
    .switch {
        display:inline-block;
        width:55px;
        height:25px;
        margin:8px;
        transform:translateY(50%);
        position:relative;
    }
    /* Style Wired */
    .slider {
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        right:0;
        border-radius:30px;
        box-shadow:0 0 0 2px #777, 0 0 4px #777;
        cursor:pointer;
        border:4px solid transparent;
        overflow:hidden;
        transition:.4s;
    }
    .slider:before {
        position:absolute;
        content:"";
        width:100%;
        height:100%;
        background:#777;
        border-radius:30px;
        transform:translateX(-30px);
        transition:.4s;
    }

    input:checked + .slider:before {
        transform:translateX(30px);
        background:limeGreen;
    }
    input:checked + .slider {
        box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
    }

    /* Style Flat */
    .switch.flat .slider {
        box-shadow:none;
    }
    .switch.flat .slider:before {
        background:#FFF;
    }
    .switch.flat input:checked + .slider:before {
        background:white;
    }
    .switch.flat input:checked + .slider {
        background:limeGreen;
    }
    .patch{
        margin-top: -25px;
    }
</style>
@endpush

@section('content')
    <div class="col-xl-12">
        <input type="hidden" name="drop_up_id" id="drop_up_id" value="{{ $drop_up->id }}">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                        @yield('page')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('drop_up') }}" class="btn btn-secondary btn-elevate btn-icon-sm">
                        <i class="fa fa-arrow-left"></i>
                        Back
                    </a>

                    <a href="{{ route('drop_up.drop_assign_rider_create','') }}/<?= $drop_up->id ?>" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="fa fa-plus"></i>
                        New Record
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div id="success_message"></div>

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Service Id</th>
                        <th>Address</th>
                        <th>Rider Name</th>
                        <th>Rider Phone</th>
                        <th>Drop Up Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

@endsection

@push('js')

<script>
    $(document).ready(function(){
        var id = $("#drop_up_id").val();

        $('#kt_table_1').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
            ajax: {
                url: '{!!  route('drop_up.drop_assign_rider_getData') !!}',
                type: "GET",
                data: {id:id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'service_id', name: 'service_id'},
                {data: 'address', name: 'address'},
                {data: 'rider_name', name: 'rider_name'},
                {data: 'rider_phone', name: 'rider_phone'},
                {data: 'drop_up_cost', name: 'drop_up_cost'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });

    $(document).on('click','.deleteRecord', function(e){
        e.preventDefault();

        var delete_id = $(this).attr('rel');

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
                    type: "GET",
                    url: "{{ route('drop_up.drop_assign_rider_destroy','') }}/"+delete_id,
                    data: {delete_id:delete_id},
                    success: function (data) {

                        $('#kt_table_1').DataTable().ajax.reload();

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
                    }
                });
            });
    });
</script>
@endpush