@extends('layouts.admin.master')

@section('page')
    Order
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

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="order_tabel">
                        <thead>
                        <tr>
                            <th>Record ID</th>
                            <th>Sub Total</th>
                            <th>Grand Total</th>
                            <th>Total Product</th>
                            <th>Ordered At</th>
                            <th>Payment Name</th>
                            <th>Payment Type</th>
                            <th>Transaction ID</th>
                            <th>Paid Number</th>
                            <th>Order Status</th>
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
        $('#order_tabel').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
            ajax: {
                url: '{!!  route('order.getData') !!}',
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'subtotal', name: 'subtotal'},
                {data: 'grandtotal', name: 'grandtotal'},
                {data: 'totalproduct', name: 'totalproduct'},
                {data: 'orderedat', name: 'orderedat'},
                {data: 'paymentname', name: 'paymentname'},
                {data: 'paymenttype', name: 'paymenttype'},
                {data: 'transactionid', name: 'transactionid'},
                {data: 'paidfrom', name: 'paidfrom'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('body').on('change','#order_status',function(e){
            e.preventDefault();
                var order_id=$(this).attr('order_id');
                 var status=$(this).val();
            $.ajax({
                method:'post',
                url:$(this).attr('data-action'),
                 headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{
                    order_id:order_id,
                    status:status
                },
                success:function(response){
                    var data=JSON.parse(response);
                    console.log(data);
                    toastr.success(data.msg);
                    swal(data.msg)
                },
                error:function(){
                }
            });
        });
    });
</script>
@endpush