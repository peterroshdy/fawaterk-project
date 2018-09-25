@extends('layouts.store.header')
@section('content')

@if($store != '')
@section('title', $store->store_name . ' | ' . 'Payment Checkout')
	<link rel="stylesheet" type="text/css" href="{{ asset('market/css/checkout-styles.css') }}" />
    <div class="">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img class="img-round" style="max-width: 30px;" src="images/pp.jpg" alt="">{{ $store->store_name }}</a>
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
                    
                <form method="POST" action="{{ url('/store/'.$store->vendor_username.'/done') }}">

                        {{ csrf_field() }}
                                                         
                        <input value="{{ $store->vendor_id }}" required name="vendor_id" type="hidden" class="form-control">
                        <input required name="total" value="{{ $total }}" type="hidden" class="form-control">
                       
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>أجمال المشتروات</label>
                                <input disabled required name="total" value="{{ $total }}" type="number" class="form-control"  >
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <input required name="phone_number" value="{{ Auth::user()->mobile }}" type="number" class="form-control"  placeholder="أدخل رقم الهاتف">
                            </div>
                        </div>

                                            
                        <!--
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>أختر طريقه الدفع</label>
                                <select required name="payment_method" class="form-control">
                                                            
                                    <option value="Card">بطاقة ائتمان</option>
                                    <option value="onDelivery">الدفع عند الأستلام</option>
                                                            
                                </select>
                            </div>
                        </div>
                        -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>عنوان الشحن</label>
                                <textarea required name="shipping_address" class="form-control"  placeholder="أدخل عنوان الشحن">{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                        <button id="submit-btn" type="submit" class="btn btn-block btn-primary text-center">التالي</button>

                    </div>
                </form>
                    
                </div>

            </div>
        </div>
        <!-- End :: Page Content -->
</html>

@endsection