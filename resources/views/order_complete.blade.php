@extends('layouts.e_commerce.master')
@section('page')
    Eastern Tech
@endsection

@push('css')
@endpush
@section('content')
    <div id="content" class="site-content" tabindex="-1">
                <div class="container">
                	<br><br><br>
                    @if (Session::has('success_message'))
	                  <div class="alert alert-success"> <i class="fas fa-check-circle"></i> {{Session::get('success_message')}}</div>
                    @endif
                    <div class="row">
                    	<div class="col-md-4"></div>
                    	<div class="col-md-4  text-center">
                    		 <a href="{{ route('ecommerce') }}" class="btn btn-danger btn-lg">Continue Shopping</a>
                    	</div>
                    	<div class="col-md-4"></div>
                    </div>
                   
                   
                </div>
            </div>
@endsection

@push('js')

@endpush


