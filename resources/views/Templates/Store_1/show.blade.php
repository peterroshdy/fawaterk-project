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

                        @if(Auth::check())
                            @if(Auth::user()->role_id == 2)
                            <li class="nav-item"><a href="{{ url('store/'.$store->vendor_username.'/account') }}"><i class="far fa-user"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        @else
                            <li class="nav-item"><a href="{{ url('/register') }}">Register</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        @endif
                        

                        <li class="dropdown">
                                    <a href="#" data-target="#" class="waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-flag"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="list-group slimscroll-noti notification-list">
                                           <!-- list item-->
                                           <a href="{{ url('/lang/ar') }}" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 style="color: #333a40;" class="media-heading p-t-10">@lang('header.Arabic')</h5>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="{{ url('/lang/en') }}" class="list-group-item">
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

                        <li class="nav-item"><a href="{{ url('/store/'.$store->vendor_username.'/cart') }}"><i class="fas fa-shopping-cart"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;

                        <li class="nav-item"><a href="#"><i class="fas fa-search"></i></a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(Auth::check())
                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 0 || Auth::user()->role_id == 3)
                            <li class="nav-item"><a href="{{ url('/') }}">@lang('store.store_go_to_dashboard')</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
        
        <main role="main" class="seller-info">
            <div class="jumbotron">
              <div class="container">
               @if($store->logo != '')
                    <img class="img-fluid center img-round" src="{{ asset('market/images/store/logos/'.$store->logo.'') }}" alt="">
                @else
                    <img class="img-fluid center img-round" src="{{ asset('market/images/pp.jpg') }}" alt="">
                @endif
                <h1 class="text-center title-26 bold mr-top-10">{{ $store->store_name }}</h1>
                <p class="text-center mr-top-10">{{ $store->store_desc }}</p>
                
                <span class="center text-center mr-top-30">
                    <a class="btn btn-dark white">@lang('store.store_products') <span class="badge badge-light">{{ $products->count() }}</span></a>
                    @if($store->status == 1)
                    <a class="btn btn-success white">@lang('store.store_available')</a>
                    @else
                    <a class="btn btn-danger white">@lang('store.store_unavailable')</a>
                    @endif
                    <a class="btn btn-secondary white">@lang('store.store_shipping_fees') {{ $store->shipping_fees }} @lang('store.store_currency')</a>
                </span>
            
                <br>
              
            </div>
            </div>
          </main>   

        <div class="container">

            <nav class="navbar navbar-expand-md navbar-light bg-light rounded">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                    <ul class="navbar-nav">
                    
                       @foreach($categories as $category)    
                            @if($category->product->count() > 0)

                            @if(Config::get('app.locale') == 'en')
                                <li class="nav-item"><a class="nav-link" href="{{ url('store/'.$store->vendor_username.'/category/'.$category->id.'') }}">{{ $category->name }} </a></li>
                            @elseif(Config::get('app.locale') == 'ar')
                            <li class="nav-item"><a class="nav-link" href="{{ url('store/'.$store->vendor_username.'/category/'.$category->id.'') }}">{{ $category->name_ar }} </a></li>
                            @endif

                            @endif  
                       @endforeach
                    </ul>
                </div>
            </nav>

            <br>

            <div class="all-products">
                <br>
                    
                    <div class="row">
                        @foreach($products as $product)

                        @if(count( $store_languages ) == 0)
                        <div class="col-lg-3">
                             <div class="card">
                                <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                    <img class="card-img-top" src="{{asset('market/images/products/'.$product->image->first()->image.'')}}" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                        <h3 class="card-title title-18 bold">{{$product->title_en}}</h3>
                                        <small>{{ substr($product->body_en, 0, 100) }} ...</small>
                                    </a>
                                    <br><br>
                                   
                                    <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">@lang('store.store_add_to_cart')</a>
                                     
                                    <span class="btn btn-warning btn-sm left bold">{{$product->price}}$</span>
                                  
                                </div>
                              </div>
                        </div>
                        @endif

                        @if(Config::get('app.locale') == 'en')
                          @if($product->title_en != '')

                          <div class="col-lg-3">
                               <div class="card">
                                  <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                      <img class="card-img-top" src="{{asset('market/images/products/'.$product->image->first()->image.'')}}" alt="Card image cap">
                                  </a>
                                  <div class="card-body">
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                          <h3 class="card-title title-18 bold">{{$product->title_en}}</h3>
                                          <small>{{ substr($product->body_en, 0, 100) }} ...</small>
                                      </a>
                                      <br><br>
                                     
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">@lang('store.store_add_to_cart')</a>
                                       
                                      <span class="btn btn-warning btn-sm left bold">{{$product->price}}$</span>
                                    
                                  </div>
                                </div>
                          </div>
                          @else
                          <div class="col-lg-3">
                               <div class="card">
                                  <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                      <img class="card-img-top" src="{{asset('market/images/products/'.$product->image->first()->image.'')}}" alt="Card image cap">
                                  </a>
                                  <div class="card-body">
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                          <h3 class="card-title title-18 bold">{{$product->title_ar}}</h3>
                                          <small>{{ substr($product->body_ar, 0, 100) }} ...</small>
                                      </a>
                                      <br><br>
                                     
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">@lang('store.store_add_to_cart')</a>
                                       
                                      <span class="btn btn-warning btn-sm left bold">{{$product->price}}$</span>
                                    
                                  </div>
                                </div>
                          </div>
                          @endif
                        @elseif(Config::get('app.locale') == 'ar')
                          @if($product->title_ar != '')
                          <div class="col-lg-3">
                               <div class="card">
                                  <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                      <img class="card-img-top" src="{{asset('market/images/products/'.$product->image->first()->image.'')}}" alt="Card image cap">
                                  </a>
                                  <div class="card-body">
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                          <h3 class="card-title title-18 bold">{{$product->title_ar}}</h3>
                                          <small>{{ substr($product->body_ar, 0, 100) }} ...</small>
                                      </a>
                                      <br><br>
                                     
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">@lang('store.store_add_to_cart')</a>
                                       
                                      <span class="btn btn-warning btn-sm left bold">{{$product->price}}$</span>
                                    
                                  </div>
                                </div>
                          </div>
                        @else
                        <div class="col-lg-3">
                               <div class="card">
                                  <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                      <img class="card-img-top" src="{{asset('market/images/products/'.$product->image->first()->image.'')}}" alt="Card image cap">
                                  </a>
                                  <div class="card-body">
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}">
                                          <h3 class="card-title title-18 bold">{{$product->title_en}}</h3>
                                          <small>{{ substr($product->body_en, 0, 100) }} ...</small>
                                      </a>
                                      <br><br>
                                     
                                      <a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">@lang('store.store_add_to_cart')</a>
                                       
                                      <span class="btn btn-warning btn-sm left bold">{{$product->price}}$</span>
                                    
                                  </div>
                                </div>
                          </div>
                        @endif
                        @endif

                        @endforeach
                    </div>
                    @else
                    <h1>No Products Added Yet</h1>
                    @endif
                   
            
                </div>
            </div><br>

            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                         <nav class="text-center">
                            {{ $products->links() }}
                         </nav>
                    </div>
                </div>
            </div>
        </div>

       <script type="text/javascript"> var map = [ "&\#1632;","&\#1633;","&\#1634;","&\#1635;","&\#1636;", "&\#1637;","&\#1638;","&\#1639;","&\#1640;","&\#1641;" ]; function getArabicNumbers(str) { var newStr = ""; str = String(str); for(i=0; i<str.length; i++) { newStr += map[parseInt(str.charAt(i))]; } return newStr; } $(document).ready(function(){ $(".arabic-num td").each(function(){ $(this).html(getArabicNumbers($(this).html())); }); }); </script>


@endsection