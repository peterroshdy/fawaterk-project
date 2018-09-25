@extends('layouts.store.header')
@section('content')

@if($product != '' && $store != '')
@section('title', $store->store_name)
<div class="">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('store/'.$store->vendor_username.'') }}">{{ $store->store_name }}</a>
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


        <div class="container">
            <div class="row page-content">
                <div class="col-md-9 row">
                    <div class="product-images col-md-6">
                        <div class="images-gallery">
                            <img class="main-pic col-md-12" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}">
                            <div class="thumbnails owl-carousel col-md-12">
                                

                                @if($product->image->count() > 1)
                                @foreach($product->image as $image)

                                <img class="gallery-img" src="{{ asset('market/images/products/'.$image->image.'') }}">

                                @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="product-info col-md-6">
                        
                        @if(Config::get('app.locale') == 'en')

                          @if($product->title_en != '')
                            <span class="btn btn-warning left bold">{{ $product->price }}$</span>
                            <h1 class="title-30">{{ $product->title_en }}</h1>
                            <p>{{ $product->body_en }}</p>
                          
                          @else
                            <span class="btn btn-warning left bold">{{ $product->price }}$</span>
                            <h1 class="title-30">{{ $product->title_ar }}</h1>
                            <p>{{ $product->body_ar }}</p>
                          @endif
                        
                        @elseif(Config::get('app.locale') == 'ar')

                            @if($product->title_ar != '')
                            <span class="btn btn-warning left bold">{{ $product->price }}$</span>
                            <h1 class="title-30">{{ $product->title_ar }}</h1>
                            <p>{{ $product->body_ar }}</p>
                          
                            @else
                            <span class="btn btn-warning left bold">{{ $product->price }}$</span>
                            <h1 class="title-30">{{ $product->title_en }}</h1>
                            <p>{{ $product->body_en }}</p>
                            @endif
                       
                        @endif
                        
                        @if(Auth::check())
                        <form action="{{ url('store/'.$store->vendor_username.'') }}" method="post">

                        @if($colors->count() > 0)
                        <select name="product_color" class="custom-select col-md-6">
                            
                            @if(Config::get('app.locale') == 'en')
                            @foreach($colors as $color)

                                @if($color->color->color_en != '')
                                <option value="{{ $color->color->id }}">{{ $color->color->color_en }}</option>
                                @else
                                <option value="{{ $color->color->id }}">{{ $color->color->color_ar }}</option>
                                @endif
                                
                            @endforeach
                            @elseif(Config::get('app.locale') == 'ar')
                            @foreach($colors as $color)

                                @if($color->color->color_ar != '')
                                <option value="{{ $color->color->id }}">{{ $color->color->color_ar }}</option>
                                @else
                                <option value="{{ $color->color->id }}">{{ $color->color->color_en }}</option>
                                @endif

                            @endforeach
                            @endif

                        </select>
                        @endif

                        @if($sizes->count() > 0)
                        <br><br>
                        <select name="product_size" class="custom-select col-md-6">
                            
                            @if(Config::get('app.locale') == 'en')
                            @foreach($sizes as $size)
                                <option value="{{ $size->size->id }}">{{ $size->size->size_en }}</option>
                            @endforeach
                            @elseif(Config::get('app.locale') == 'ar')
                            @foreach($sizes as $size)
                                <option value="{{ $size->size->id }}">{{ $size->size->size_ar }}</option>
                            @endforeach
                            @endif

                        </select>
                        @endif
                       
                        <br><br>

                            {{ csrf_field() }}
                            
                            <input value="1" class="form-control" required type="number" name="product_quantity">
                            <input hidden value="{{ $product->price }}" required type="number" name="product_price">
                            <input hidden value="{{ $product->id }}" required type="number" name="product_id">
                            <input hidden value="{{ $product->key }}" required type="text" name="product_key">
                            <input hidden value="{{ $store->id }}" required type="number" name="store_id">
                            <input hidden value="{{ $store->vendor_id }}" required type="number" name="vendor_id">
                            <input hidden value="{{ $store->vendor_username }}" required type="name" name="vendor_username">
                            <br>
                            <input type="submit" class="btn btn-block btn-info" value="اضف للسلة">
                            

                            </form>
                        @else

                            <a class="btn btn-block btn-warning left bold" href="{{ url('/register') }}">Register to continue</a>
                            <br><br>
                            <a class="btn btn-block btn-danger left bold" href="{{ url('/login') }}">Login to continue</a>
                            <br><br>
                            

                        @endif
                        
                        
                    </div>
                </div>

                <div class="col-md-3">
                    
                    <ul class="list-group widget">

                        <li class="list-group-item active">@lang('store.store_categories')</li>

                        @foreach($categories as $category)    
                            @if($category->product->count() > 0)

                                @if(Config::get('app.locale') == 'en')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <a href="##">{{ $category->name }}</a>
                                 <span class="badge badge-dark badge-pill">{{ $category->product->count() }}</span>
                                 </li>
                                @elseif(Config::get('app.locale') == 'ar')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <a href="##">{{ $category->name_ar }}</a>
                                 <span class="badge badge-dark badge-pill">{{ $category->product->count() }}</span>
                                 </li>
                                @endif
                                 
                            @endif  
                        @endforeach

                       
                    </ul>

                    <ul class="list-group widget">

                        <li class="list-group-item active">@lang('store.store_latest')</li>

                        @foreach($products as $product)

                        @if(count( $store_languages ) == 0)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="media align-items-center">
                                <img width="50px" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}" alt="Generic placeholder image">
                                <div class="media-body widget-product">
                                    <h1 class="mt-0"><a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">{{ $product->title_en }}</a></h1>
                                    <span class="badge badge-warning">{{ $product->price }}$</span>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if(Config::get('app.locale') == 'en')
                            @if($product->title_en != '')
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="media align-items-center">
                                    <img width="50px" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}" alt="Generic placeholder image">
                                    <div class="media-body widget-product">
                                        <h1 class="mt-0"><a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">{{ $product->title_en }}</a></h1>
                                        <span class="badge badge-warning">{{ $product->price }}$</span>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="media align-items-center">
                                    <img width="50px" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}" alt="Generic placeholder image">
                                    <div class="media-body widget-product">
                                        <h1 class="mt-0"><a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">{{ $product->title_ar }}</a></h1>
                                        <span class="badge badge-warning">{{ $product->price }}$</span>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @elseif(Config::get('app.locale') == 'ar')
                            @if($product->title_ar != '')
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="media align-items-center">
                                    <img width="50px" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}" alt="Generic placeholder image">
                                    <div class="media-body widget-product">
                                        <h1 class="mt-0"><a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">{{ $product->title_ar }}</a></h1>
                                        <span class="badge badge-warning">{{ $product->price }}$</span>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="media align-items-center">
                                    <img width="50px" src="{{ asset('market/images/products/'.$product->image->first()->image.'') }}" alt="Generic placeholder image">
                                    <div class="media-body widget-product">
                                        <h1 class="mt-0"><a href="{{ url('store/'.$store->vendor_username.'/product/'.$product->id.'') }}">{{ $product->title_en }}</a></h1>
                                        <span class="badge badge-warning">{{ $product->price }}$</span>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @endif


                        @endforeach

                        

                    </ul>

                </div>
            </div>
        </div>
        <br><br><br><br>

@endif
@endsection