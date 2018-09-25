@extends('layouts/dashboard/header')
@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">@lang('products.Products_Index')</h4>
                                <p class="text-muted page-title-alt">@lang('products.Here_is')</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">

                                    @if(Session::has('message-product-delete-rejacted'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-product-delete-rejacted') }}</p>
                                    @elseif(Session::has('message-product-delete-approved'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-product-delete-approved') }}</p>
                                    @elseif(Session::has('message-product-added'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-product-added') }}</p>
                                    @endif
                                   
                                    <h4 class="text-dark header-title m-t-0">@lang('products.Recent_Added')</h4>
                                    

                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>@lang('products.stock')</th>
                                                    <th>@lang('products.Product_Title')</th>
                                                    <th>@lang('products.image')</th>
                                                    <th>@lang('products.Price')</th>
                                                    <th>@lang('products.Category')</th>
                                                    <th>@lang('products.Status')</th>
                                                    <th style="min-width: 80px;">@lang('products.Create_At')</th>
                                                    <th style="min-width: 80px;">@lang('products.Action')</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                
                                                    <tr>
                                                        <!--#Check if both languages exist-->
                                                        @if($products_en->first() && $products_ar->first())

                                                            @foreach($products_en as $product)
                                                                
                                                                <tr>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->title }}</td>
                                                                <td><img style="width: 40px;" class="img-round" src="{{ asset('clients/vendors/products/'.$product->image->first()->image.'') }}" alt=""></td>
                                                                <td>{{ $product->price }}$</td>
                                                                <td><span class="text-custom">{{ $product->category->name_en }}</span></td>
                                                                
                                                                @if($product->status == 1)
                                                                <td><span class="text-custom"><span class="badge badge-success">@lang('products.active')</span></span></td>
                                                                @elseif($product->status == 0)
                                                                <td><span class="text-custom"><span class="badge badge-danger">@lang('products.disable')</span></span></td>
                                                                @endif
                                                                
                                                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                                                <td>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'') }}" class="table-action-btn"><i class="md md-close"></i></a>
                                                                </td>
                                                                </tr>


                                                            @endforeach

                                                        @elseif($products_en->first())
                                                            
                                                            @foreach($products_en as $product)
                                                                
                                                                <tr>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->title }}</td>
                                                                <td><img style="width: 40px;" class="img-round" src="{{ asset('clients/vendors/products/'.$product->image->first()->image.'') }}" alt=""></td>
                                                                <td>{{ $product->price }}$</td>

                                                                <td><span class="text-custom">{{ $product->category->name_en }}</span></td>
                                                                
                                                                @if($product->status == 1)
                                                                <td><span class="text-custom"><span class="badge badge-success">@lang('products.active')</span></span></td>
                                                                @elseif($product->status == 0)
                                                                <td><span class="text-custom"><span class="badge badge-danger">@lang('products.disable')</span></span></td>
                                                                @endif
                                                                
                                                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                                                <td>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'') }}" class="table-action-btn"><i class="md md-close"></i></a>
                                                                </td>
                                                                </tr>


                                                            @endforeach


                                                        @elseif($products_ar->first())
                                                            
                                                            @foreach($products_ar as $product)
                                                                <tr>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ $product->title }}</td>
                                                                <td><img style="width: 40px;" class="img-round" src="{{ asset('clients/vendors/products/'.$product->image->first()->image.'') }}" alt=""></td>
                                                                <td>{{ $product->price }}$</td>
                                                                <td><span class="text-custom">{{ $product->category->name_ar }}</span></td>
                                                                
                                                                @if($product->status == 1)
                                                                <td><span class="text-custom"><span class="badge badge-success">@lang('products.active')</span></span></td>
                                                                @elseif($product->status == 0)
                                                                <td><span class="text-custom"><span class="badge badge-danger">@lang('products.disable')</span></span></td>
                                                                @endif
                                                                
                                                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                                                <td>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                                    <a href="{{ url('vendor/store/'.$product->vendor_username.'/product/'.$product->key.'') }}" class="table-action-btn"><i class="md md-close"></i></a>
                                                                </td>
                                                                </tr>


                                                            @endforeach

                                                        @endif
                                                        
                                                    </tr>
                                                    
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


@endsection