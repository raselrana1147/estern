@extends('layouts.admin.master')

@section('page')
    Order Invoice
@endsection

@push('css')

@endpush

@section('content')

  <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card" id="print_area">
         <div class="card-header p-4">
             <a class="pt-2 d-inline-block" href="" data-abc="true">
                 <img src="{{ asset('img/techn.png') }}" alt="">
             </a>
             <div class="float-right">
                 <h3 class="mb-0">Invoice #{{$order->order_number}}</h3>
                  Date {{date('d M, Y',strtotime($order->created_at))}}
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-4">
                 <div class="col-sm-6">
                     <h5 class="mb-3">From:</h5>
                     <h3 class="text-dark mb-1">Eastern Technologies</h3>
                     <div>5/78 & 87 Estern Plaza (4th Floor) Sonargaon Road</div>
                     <div>Hatirpool, Dhaka-1205</div>
                     <div>Email: externtechnologiesbd.com</div>
                     <div>Phone: +8801714215508</div>
                 </div>
                 <div class="col-sm-6 ">
                     <h5 class="mb-3">To:</h5>
                     @if (!is_null($billing))
                      <h3 class="text-dark mb-1">{{$billing->customer_name}}</h3>
                   
                     <div>{{$billing->customer_address}}</div>
                   
                     <div>{{$billing->customer_phone}}</div>
                     @endif
                     
                 </div>

                  <div class="col-sm-6 ">
                     <h3 class="text-dark mb-1">Payment Info</h3>
                      @if (!is_null($payment))
                     <div>Payment Type: {{$payment->payment_type}}</div>
                     <div>Payment Name: {{$payment->payment_name}}</div>
                     <div>Payable Amount: ৳ {{$payment->payable_amount}}</div>
                     @if ($payment->payment_name !="Cash On Delivery")
                      <div>Transaction ID: {{$payment->transaction_number}}</div>
                     <div>Paid From: {{$payment->customer_number}}</div>
                     @endif
                     @endif
                 </div>

             </div>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="center">#</th>
                             <th >Image</th>
                             <th>Name</th>
                             <th class="right">Price</th>
                             <th class="center">Qty</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($order_details as $detail)
                         <tr>
                             <td width="5%" class="center">{{$loop->index+1}}</td>
                             <td width="25%" class="left strong"><img src="{{asset('assets/uploads/small/'.$detail->product_image)}}"></td>
                             <td class="left" width="15%">{{$detail->product_name}}</td>
                             <td width="15%" class="right">৳ {{$detail->product_price}}</td>
                             <td width="20%" class="center">{{$detail->product_quantity}}</td>
                             <td width="20%" class="right">৳ {{$detail->product_price*$detail->product_quantity}}</td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Subtotal</strong>
                                 </td>
                                 <td class="right">৳ {{$order->sub_total}}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">৳ {{$order->grand_total}}</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="card-footer bg-white">
             <p class="mb-0">Eastern tech</p>
         </div>
     </div>
     <br><br>
     <span><button class="btn btn-info" id="make_invoice">Print</button>
      <a href="javascript:history.back();" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</a></span>
     
 </div>

   
@endsection

@push('js')
<script type="text/javascript"> 
    $(document).ready(function(){
         ////===========making printer ================
      $("#make_invoice").click(function(){
        
              var mode = 'iframe';
              var close = mode == "popup";
              var options = { mode : mode, popClose : close};
              $("#print_area").printArea( options );
          
      });
    });
</script>
@endpush