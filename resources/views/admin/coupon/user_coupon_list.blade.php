@extends('layouts.admin.master')

@section('page')
    Users Coupons List
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
                </div>
            </div>
            <div class="kt-portlet__body">

                <div id="success_message"></div>

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Role</th>
                        <th>Coupon Code</th>
                        <th>Coupon Image</th>
                        <th>Coupon Amount</th>
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
                url: '{!!  route('user_coupon_getData') !!}',
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'customer_phone', name: 'customer_phone'},
                {data: 'customer_role', name: 'customer_role'},
                {data: 'coupon_code', name: 'coupon_code'},
                {data: 'coupon_image', name: 'coupon_image'},
                {data: 'coupon_amount', name: 'coupon_amount'}
            ]
        });
    });
</script>
@endpush