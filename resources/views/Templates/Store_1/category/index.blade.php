@extends('layouts.store.header')
@section('content')

@if($store != '')
@section('title', $store->store_name . ' | ' . 'Categories')
	<div class="">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/store/'.$store->vendor_username.'') }}">{{ $store->store_name }}</a>
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
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 0 || Auth::user()->role_id == 3)
                            <li class="nav-item"><a href="{{ url('/') }}">Go to dashboard</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        @endif


                    </ul>
                </div>
            </div>
        </nav>
@endif
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                    <ul class="navbar-nav">
                        
                       @foreach($categories as $category)    
                            @if($category->product->count() > 0)
                                <li class="nav-item"><a class="nav-link" href="{{ url('store/'.$store->vendor_username.'/category/'.$category->id.'') }}">{{ $category->name_ar }} </a></li>
                            @endif  
                       @endforeach
                    </ul>
                </div>
            </nav>

            <br>

            <div class="all-products">
                <br>
                    
                    <div class="row">
                        @foreach($category_products as $product)

                        <div class="col-lg-3">
                             <div class="card">
                                <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">
                                    <img class="card-img-top" src="{{asset('market/images/products/'.$product->image.'')}}" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">
                                        <h3 class="card-title title-18 bold">{{$product->title}}</h3>
                                        <small>{{ substr($product->body, 0, 90) }} ...</small>
                                    </a>
                                    <br><br>
                                    <a href="" class="btn btn-info btn-sm">اضف للسلة</a>
                                    <a href="" class="btn btn-secondary btn-sm"><i class="fas fa-star"></i></a>
                                    <span class="btn btn-warning btn-sm left bold">{{$product->price}} جنية</span>
                                </div>
                              </div>
                        </div>

                        @endforeach
                    </div>
                   
            
                </div>
            </div><br>
            
        </div>

@endsection