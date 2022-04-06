@extends('layouts.admin.master')

@section('page')
    Order Payment Details
@endsection

@push('css')
  <style type="text/css">
    .set-span-style{
          float: right;
      }
  </style>

@endpush

@section('content')
    <div class="col-xl-12">
    	<a href="javascript:history.back();" class="btn btn-info pull-right"><i class="fas fa-arrow-right"></i> Back</a><br><br><br>
        <div class="card" style="width: 500px;">
          <div class="card-header">
            Payment Details
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong><span>Payment Type:    <span class="set-span-style">{{$payment->payment_type}}</span></span></strong></li>
            <li class="list-group-item"><strong><span>Payment Name:     <span class="set-span-style">{{$payment->payment_name}}</span></span></strong></li>
            @if ($payment->payment_name !='Cash On Delivery')
            <li class="list-group-item"><strong><span>Transaction Number:     <span class="set-span-style">{{$payment->transaction_number}}</span></span></strong></li>
               <li class="list-group-item"><strong><span>Customer Banking Number:     <span class="set-span-style">{{$payment->customer_number}}</span></span></strong></li>
            @endif
              <li class="list-group-item"><strong><span>Payable Amount:   ৳  <span class="set-span-style">{{$payment->payable_amount}}</span></span></strong></li>

          </ul>
       </div>
        
    </div>
    </div>
@endsection

@push('js')
@endpush