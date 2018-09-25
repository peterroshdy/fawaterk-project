@extends('layouts.store.header')
@section('content')

@if($store != '')
@section('title', $store->store_name . ' | ' . 'Categories')
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
                                           
                                              <a href="{{ url('/store/'.$store->vendor_username.'/ar') }}" class="list-group-item">
                                                  <div class="media">
                                                     <div class="pull-left p-r-10">
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 style="color: #333a40;" class="media-heading p-t-10">@lang('header.Arabic')</h5>
                                                     </div>
                                                  </div>
                                               </a>

                                               <!-- list item-->
                                               <a href="{{ url('/store/'.$store->vendor_username.'/en') }}" class="list-group-item">
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
                                @if($store_lang == 'en')
                                <li class="nav-item"><a class="nav-link" href="{{ url('store/'.$store->vendor_username.'/'.$store_lang.'/category/'.$category->id.'') }}">{{ $category->name_en }} </a></li>
                                @elseif($store_lang == 'ar')
                                <li class="nav-item"><a class="nav-link" href="{{ url('store/'.$store->vendor_username.'/'.$store_lang.'/category/'.$category->id.'') }}">{{ $category->name_ar }} </a></li>
                                @endif
                                @endif
                            

                       @endforeach
                    </ul>
                </div>
            </nav>

            <br>
@if($products->first())
            <div class="all-products">
                <br>
                    
                    <div class="row">
                        @foreach($products as $product)

                        <div class="col-lg-3">
                             <div class="card">
                                <a href="{{ url('store/'.$store->vendor_username.'/'.$store_lang.'/product/'.$product->key.'') }}">
                                    <img class="card-img-top" src="{{  asset('clients/vendors/products/'.$product->image->first()->image.'') }}" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <a href="{{ url('store/'.$store->vendor_username.'/'.$store_lang.'/product/'.$product->key.'') }}">
                                        <h3 class="card-title title-18 bold">{{$product->title}}</h3>
                                        <small>{{ str_limit($product->body, $limit = 50, $end = '...') }}</small>
                                    </a>
                                    <br><br>
                                    <a href="{{ url('store/'.$store->vendor_username.'/'.$store_lang.'/product/'.$product->key.'') }}" class="btn btn-info btn-sm">اضف للسلة</a>
                                    <span class="btn btn-warning btn-sm left bold">{{$product->price}} $</span>
                                </div>
                              </div>
                        </div>

                        @endforeach
                    </div>
                   
            
                </div>
            </div><br>
            
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
@else


<strong><p class="text-center">We didn't find what you looking for , try new word <i class="fa fa-frown-o"></i></p></strong><br>

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
@endif
@endsection