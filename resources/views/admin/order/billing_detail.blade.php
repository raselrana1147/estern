@extends('layouts.admin.master')

@section('page')
    Order Billing Details
@endsection

@push('css')

@endpush

@section('content')
    <div class="col-xl-12">
    	<a href="javascript:history.back();" class="btn btn-info pull-right"><i class="fas fa-arrow-right"></i> Back</a><br><br><br>
        <div class="card" style="width: 500px;">
          <div class="card-header">
            Biilng Details
          </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong><span>Customer Name:    {{$billing->customer_name}}</span></strong></li>
            <li class="list-group-item"><strong><span>Customer Phone:    {{$billing->customer_phone}}</span></strong></li>
              <li class="list-group-item"><strong><span>Payable Address:   {{$billing->customer_address}}</span></strong></li>

          </ul>
       </div>
        
    </div>
    </div>
@endsection

@push('js')
@endpush