@extends('layouts.store.header')
@section('content')
@if($store != '')
@section('title', $store->store_name . ' | ' . 'Cart')
<link rel="stylesheet" type="text/css" href="{{ asset('market/css/checkout-styles.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('market/css/cart-styles.css') }}" />
<div class="">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/store/'.$store->vendor_username.'/'.$store_lang.'') }}">{{ $store->store_name }}</a>
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
          <li class="nav-item"><a href="{{ url('/register') }}">Register</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
          @endif
          
          @if(count($store_languages) > 1)
          <li class="dropdown">
            <a href="#" data-target="#" class="waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-flag"></i></a>
            <ul class="dropdown-menu dropdown-menu-lg">
              <li class="list-group slimscroll-noti notification-list">
                <!-- list item-->
                <a href="{{ url('/store/'.$store->vendor_username.'/ar/cart') }}" class="list-group-item">
                  <div class="media">
                    <div class="pull-left p-r-10">
                    </div>
                    <div class="media-body">
                      <h5 style="color: #333a40;" class="media-heading p-t-10">@lang('header.Arabic')</h5>
                    </div>
                  </div>
                </a>
                <!-- list item-->
                <a href="{{ url('/store/'.$store->vendor_username.'/en/cart') }}" class="list-group-item">
                  <div class="media">
                    <div class="pull-left p-r-10">
                    </div>
                    <div class="media-body p-t-10">
                      <h5 style="color: #333a40;" class="media-heading">@lang('header.English')</h5>
                    </div>
                  </div>
                </a>
                
                
              </li>
            </ul>
          </li>&nbsp;&nbsp;&nbsp;&nbsp;
          @endif
          <li class="nav-item"><a href="{{ url('/store/'.$store->vendor_username.'/'.$store_lang.'/cart') }}"><i class="fas fa-shopping-cart"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
          <li class="nav-item"><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-search"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
          @if(Auth::check())
          @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 0 || Auth::user()->role_id == 3)
          <li class="nav-item"><a href="{{ url('/') }}">@lang('store.store_go_to_dashboard')</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
          @endif
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- Start :: Page Content -->
  <div class="container">
    <!-- Start :: Checkout Content -->
    <div class="checkout-panel">
      <div class="panel-body">
        @if($cart_products->first() != '')
        @foreach($cart_products as $c)
        <h2 class="title">@lang('cart.your_shopping_cart')</h2>
        <div class="product">
          <div class="product-image">
            <img src="{{ asset('clients/vendors/products/'.$c->product->image->first()->image.'') }}">
          </div>
          <div class="product-details">
            
            
            <strong><div class="product-title"><strong><p>{{ $c->product->title }}</p></strong></div></strong>
            <p class="product-description">{{ str_limit($c->product->body, $limit = 50, $end = '...') }}</p>
            <br>
            @if($c->color_id)
            <p class="product-description"><strong>اللون : {{ $c->color->first()->color }}</strong></p>
            @endif
            @if($c->size_id)
            <p class="product-description"><strong>الحجم : {{ $c->size->first()->size }}</strong></p>
            @endif
          </div>
          <div class="product-price">{{ $c->product->price }}</div>
          
          <form method="post" action="{{ url('cart/'.$c->id.'') }}">
            {{ csrf_field() }}
            <div class="product-quantity">
              <input hidden name="store_lang" value="{{ $store_lang }}" type="name">
              <input name="product_quantity" value="{{ $c->quantity }}" type="number" min="1">
              <input hidden name="vendor_username" value="{{ $store->vendor_username }}" type="name">
            </div>
            <button class="update-quantity">@lang('cart.update_cart_item')</button>
          </form>
          
          
          <form method="post" action="{{ url('cart/'.$c->id.'') }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input hidden name="store_lang" value="{{ $store_lang }}" type="name">
            <input hidden name="vendor_username" value="{{ $store->vendor_username }}" type="name">
            <button class="remove-product">@lang('cart.delete_cart_item')</button>
          </form>
          
        </div>
        @endforeach
        
        <div class="totals">
          <div class="totals-item">
            <label>@lang('cart.total_items')</label>
            <div class="totals-value" id="cart-subtotal">{{ $cart_products->sum('total') }}</div>
          </div>
          <div class="totals-item">
            <label>@lang('cart.shipping_fees')</label>
            <div class="totals-value" id="cart-shipping">{{ $store->shipping_fees }}</div>
          </div>
          <!--#Check if this store has taxes , if yes add them-->
          @if($store->tax_name_1 && $store->tax_amount_1)
          <div class="totals-item">
            <label>ضريبة : {{ $store->tax_name_1 }}</label>
            <div id="cart-shipping">{{ $store->tax_amount_1 }}%</div>
          </div>
          @endif
          <div class="totals-item totals-item-total">
            <label>@lang('cart.total')</label>
            <div class="totals-value" id="cart-total">{{ $store->tax_amount_1 * $cart_products->sum('total') / 100 + $cart_products->sum('total') + $store->shipping_fees}}</div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <a href="{{ url('/store/'.$store->vendor_username.'/'.$store_lang.'') }}"><button class="btn back-btn">@lang('cart.back')</button></a>
        <form method="post" action="{{ url('store/'.$store->vendor_username.'/checkout') }}">
          {{ csrf_field() }}
          <input value="{{ $store->tax_amount_1 * $cart_products->sum('total') / 100 + $cart_products->sum('total') + $store->shipping_fees }}" required hidden step="0.1" type="number" name="cart_total">
          <button class="btn next-btn">@lang('cart.next')</button>
        </form>
        
      </div>
      @else
      <h2 class="title">سلة المشتريات الخاصة بك فارغة حاليا</h2>
      <a href="{{ url('/store/'.$store->vendor_username.'/'.$store_lang.'') }}"><button class="btn back-btn">العودة</button></a>
      @endif
      @endif
    </div>

     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            
                            <form method="POST" action="{{ url('/store/'.$store->vendor_username.'/'.$store_lang.'/search') }}">
                              {{ csrf_field() }}
                              <input value="{{ $store->id }}" required name="store_id" type="hidden" class="form-control">
                              
                              
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <input required name="search_word" type="name" class="form-control"  placeholder="Enter search word">
                                </div>
                              </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning"><strong>Search</strong></button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
    <!-- End :: Page Content -->
    @endsection