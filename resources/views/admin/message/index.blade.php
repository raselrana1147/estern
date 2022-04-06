@extends('layouts.admin.master')

@section('page')
    Messages
@endsection
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
                </div>
                <div class="kt-portlet__body">

                    <div id="success_message"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Sender</th>
                            <th>content</th>
                            <th>type</th>
                            <th>Date</th>
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
                url: '{!!  route('admin.load_user_message') !!}',
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'sender', name: 'sender'},
                {data: 'content', name: 'content'},
                {data: 'type', name: 'type'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endpush