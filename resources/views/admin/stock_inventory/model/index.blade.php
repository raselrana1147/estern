@extends('layouts.admin.master')

@section('page')
    Stock Model
@endsection

@push('css')
@endpush

@section('content')
    <div class="col-xl-12">

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
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ route('stock_model.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="fa fa-plus"></i>
                                    New Record
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <div id="success_message"></div>

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Brand</th>
                            <th>Model</th>
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
        $('#kt_table_1').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
            ajax: {
                url: '{!!  route('stock_model.getData') !!}',
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'brand_name', name: 'brand_name'},
                {data: 'model_name', name: 'model_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });

    $(document).on('click','.deleteRecord', function(e){
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
                    type: "GET",
                    url: deleteFunction+'/'+id,
                    data: {id:id},
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