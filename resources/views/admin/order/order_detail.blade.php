@extends('layouts.admin.master')

@section('page')
    Order Details
@endsection

@push('css')

@endpush

@section('content')
    <div class="col-xl-12">
    	<a href="javascript:history.back();" class="btn btn-info pull-right"><i class="fas fa-arrow-left"></i> Back</a><br><br><br>
        <div class="kt-portlet kt-portlet--mobile">
        		<table class="table">
        			<thead>
        				<tr>
        					<th>Index</th>
        					<td>Image</td>
        					<th>Product Name</th>
        					<th>Price</th>
        					<th>Quantity</th>
        				</tr>
        				<tbody>
        					@foreach ($order_details as $detail)
        						{{-- expr --}}
        					
        					<tr>
        						<td>{{$loop->index+1}}</td>
        						<td><img src="{{asset('assets/uploads/small/'.$detail->product_image)}}"></td>
        						<td>{{$detail->product_name}}</td>
        						<td>৳ {{$detail->product_price}}</td>
        						<td>{{$detail->product_quantity}}</td>
        					</tr>
        				@endforeach
        				</tbody>
        			</thead>
        		</table>
               
          </div>

    </div>
@endsection

@push('js')
@endpush