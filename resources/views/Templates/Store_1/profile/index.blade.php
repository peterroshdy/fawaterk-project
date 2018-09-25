@extends('layouts.store.header')
@section('content')

@if($store != '')
@section('title', $store->store_name)
<div class="">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/store/'.$store->vendor_username.'') }}">{{ $store->store_name }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsItems" aria-controls="navbarsItems" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarsItems">
                    <ul class="navbar-nav mr-auto white">
                        <li class="nav-item"><a href="{{ url('store/'.$store->vendor_username.'/account/'.Auth::user()->username.'') }}"><i class="far fa-user"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item"><a href="{{ url('/store/'.$store->vendor_username.'/cart') }}"><i class="fas fa-shopping-cart"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item"><a href="#"><i class="fas fa-star"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        <li class="nav-item"><a href="#"><i class="fas fa-search"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                    </ul>
                </div>
            </div>
        </nav>
        
        <main role="main" class="seller-info">
            <div class="jumbotron">
              <div class="container">
                <h1 class="text-center title-26 bold mr-top-10">{{ $profile->name }}</h1>
                
                <span class="center text-center mr-top-30">
                    <a class="btn btn-dark white">العمليات <span class="badge badge-light">0</span></a>
                    
                    <a class="btn btn-success white">الأعدادات</a>
                    

                    <a class="btn btn-danger white" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            تسجيل خروج
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                   
                </span>
            
                <br>
                <!--
                <div class="collapse col-md-6" id="Shipping-Cost">
                    <div class="card card-body">
                            {{ $store->shipping_fees }} ج.م
                    </div>
                </div>
                -->
            </div>
            </div>
          </main>   

@else
There is nothing for you here
@endif

@endsection