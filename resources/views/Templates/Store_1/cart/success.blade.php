@extends('layouts.store.header')
@section('content')

@if($store != '')
@section('title', $store->store_name . ' | ' . 'Purchased Successfully')
	<link rel="stylesheet" type="text/css" href="{{ asset('market/css/checkout-styles.css') }}" />
    <div class="">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('store/'.$store->vendor_username.'') }}"><img class="img-round" style="max-width: 30px;" src="images/pp.jpg" alt="">{{ $store->store_name }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsItems" aria-controls="navbarsItems" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarsItems">
                    <ul class="navbar-nav mr-auto white">

                        @if(Auth::check())
                            @if(Auth::user()->role_id == 2)
                            <li class="nav-item"><a href="{{ url('store/'.$store->vendor_username.'/account') }}"><i class="far fa-user"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        @else
                            <li class="nav-item"><a href="{{ url('store/'.$store->vendor_username.'/customer/register') }}">Register</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        @endif
                        

                        <li class="nav-item"><a href="{{ url('/store/'.$store->vendor_username.'/cart') }}"><i class="fas fa-shopping-cart"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item"><a href="#"><i class="fas fa-star"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item"><a href="#"><i class="fas fa-search"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::check())
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 0|| Auth::user()->role_id == 3)
                            <li class="nav-item"><a href="{{ url('/') }}">Go to dashboard</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
@endif

        <!-- Start :: Page Content -->
        <div class="container">
            <!-- Start :: Checkout Content -->
            <div class="checkout-panel">
                <div class="panel-body">
                    
                    <h1 class="text-center texr-primary">Your Items got Purchased Successfully</h1>
                    <a href="{{ url('store/'.$store->vendor_username.'') }}"><button class="btn btn-primary text-center">العودة للرئيسة</button></a> 
                   
                </div>
            </div>
        </div>
</html>

@endsection