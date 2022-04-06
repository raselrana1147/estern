@extends('layouts.admin.master')

@section('page')
    Service Payment Invoice
@endsection

@push('css')
<style>
    #invoice{
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,.invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>
@endpush

@section('content')
    <div class="col-lg-12">
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
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div id="invoice">

                    <div class="toolbar hidden-print">
                        <div class="text-right">
                            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a target="_blank" href="">
                                            <img src="{{ asset('img/techn.png') }}" data-holder-rendered="true" />
                                        </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="https://lobianijs.com">
                                                Eastern Technology
                                            </a>
                                        </h2>
                                        <div>5/78 & 87, Eastern Plaza (4th Floor) Sonargaon Road, Hatirpool, Dhaka-1205</div>
                                        <div>01714215508, 01737209003, 016872323914</div>
                                        <div>eastern@example.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">{{ $payment_service->customer_name }}</h2>
                                        <div class="address">{{ $payment_service->customer_phone }}</div>
                                        <div class="email"><a href="">{{ $payment_service->customer_email }}</a></div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE {{ $payment_service->id }}</h1>
                                        <div class="date">Date of Invoice: {{ $payment_service->payment_date }}</div>
                                        <div class="date">Due Date: {{ date('Y-m-d') }}</div>
                                    </div>
                                </div>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="no">{{ $payment_service->id }}</td>
                                        <td class="text-left"><h3>
                                                <a target="_blank" href="">
                                                    {{ $payment_service->service_id }}
                                                </a>
                                            </h3>
                                            {{ $payment_service->problem_details }}
                                        </td>
                                        <td class="total">&#2547; {{ $payment_service->amount }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="1">Coupon Amount</td>
                                        <td>&#2547; {{ $payment_service->coupon_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="1">SUBTOTAL</td>
                                        @php $total = $payment_service->amount - $payment_service->coupon_amount @endphp
                                        <td>&#2547; {{ $total }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="1">Pick up cost</td>
                                        @if($payment_service->pick_up_cost != null)
                                        <td>&#2547; {{ $payment_service->pick_up_cost }}</td>
                                        @else
                                        <td>&#2547; 0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="1">Drop up cost</td>
                                        @if($payment_service->drop_up_cost != null)
                                            <td>&#2547; {{ $payment_service->drop_up_cost }}</td>
                                        @else
                                            <td>&#2547; 0</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="1">GRAND TOTAL</td>
                                        @php $grand_total = $total + $payment_service->pick_up_cost + $payment_service->drop_up_cost @endphp
                                        <td>&#2547; {{ $grand_total }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="thanks" style="margin-top: 5px">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">Company will grateful to you connect with us as value able customer .</div>
                                </div>
                            </main>
                            <footer>
                                Invoice was created on a computer and is valid without the signature and seal.
                            </footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $('#printInvoice').click(function(){
        Popup($('.invoice')[0].outerHTML);
        function Popup(data)
        {
            window.print();
            return true;
        }
    });
</script>
@endpush