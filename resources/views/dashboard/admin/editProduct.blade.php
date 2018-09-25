@extends('layouts/dashboard/admin/header')
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
                    <h4 class="text-dark header-title m-t-0">Edit Product</h4><br>
                      
                    <form method="POST" action="{{ url('admin/vendor/'.$product->vendor_username.'/product/'.$product->key.'/update') }}">
                        {{ csrf_field() }}
                        
                    @if(count( $store_languages ) == 0)

                        <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('products.Basic_Information_En')</h3>
                            </div>

                            <div class="panel-body">
                                <div class="tab-content">
                                
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Name')</label>
                                                    <input value="{{ $product->title_en }}" required name="product_title_en" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Description')</label>
                                                    <textarea rows="9" required name="product_body_en" class="form-control" placeholder="@lang('products.Product_Description')">{{ $product->body_en }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                    @foreach($store_languages as $lang) 
                    @if($lang->language->code == 'EN')

                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('products.Basic_Information_En')</h3>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                            
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Name')</label>
                                                <input value="{{ $product->title_en }}" required name="product_title_en" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Description')</label>
                                                <textarea rows="9" required name="product_body_en" class="form-control" placeholder="@lang('products.Product_Description')">{{ $product->body_en }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($lang->language->code == 'AR')
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('products.Basic_Information_Ar')</h3>
                        </div>

                        <div class="panel-body">
                            <div class="tab-content">
                            
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Name')</label>
                                                <input value="{{ $product->title_ar }}" required name="product_title_ar" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Description')</label>
                                                <textarea rows="9" required name="product_body_ar" class="form-control" placeholder="@lang('products.Product_Description')">{{ $product->body_ar }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('products.Common_Informations')</h3>
                            </div>
    
                            <div class="panel-body">
                                <div class="row">

                                        <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Price')</label>
                                                    <input value="{{ $product->price }}" required name="product_price" type="number" step="0.01" class="form-control" placeholder="@lang('products.Enter_Product')">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Category')</label>
                                                    <select required name="product_category" class="form-control">
                                                        <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="customer_national_id">@lang('products.Product_Stock')</label>
                                                     <input  value="{{ $product->stock }}" required name="product_stock" type="number" class="form-control" placeholder="@lang('products.Product_Stock')">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="customer_national_id">Choose Product Colors</label><br>
                                                    @foreach($product_colors as $color)
                                                    <div class="col-lg-3">
                                                        @if(Config::get('app.locale') == 'en')
                                                            
                                                            @if($color->color->color_en != '')
                                                            <input checked type="checkbox" value="{{ $color->color->id }}" name="colors[{{ $color->color->id }}]">  {{ $color->color->color_en}}
                                                            @else
                                                            <input checked type="checkbox" value="{{ $color->color->id }}" name="colors[{{ $color->color->id }}]">  {{ $color->color->color_ar}}
                                                            @endif

                                                        @elseif(Config::get('app.locale') == 'ar')
                                                              
                                                            @if($color->color->color_ar != '')
                                                            <input checked type="checkbox" value="{{ $color->color->id }}" name="colors[{{ $color->color->id }}]">  {{ $color->color->color_ar}}
                                                            @else
                                                            <input checked type="checkbox" value="{{ $color->color->id }}" name="colors[{{ $color->color->id }}]">  {{ $color->color->color_en}}
                                                            @endif

                                                        @endif
                                                    </div>
                                                    @endforeach

                                                    @foreach($other_colors as $color)
                                                    <div class="col-lg-3">
                                                        @if(Config::get('app.locale') == 'en')
                                                            
                                                            <input type="checkbox" value="{{ $color->id }}" name="colors[{{ $color->id }}]">  {{ $color->color_en}}

                                                        @elseif(Config::get('app.locale') == 'ar')
                                                              
                                                            <input type="checkbox" value="{{ $color->id }}" name="colors[{{ $color->id }}]">  {{ $color->color_ar}}
                                                              
                                                    
                                                        @endif
                                                    </div>
                                                    @endforeach

                                                </div>
                                               
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="customer_national_id">Choose Product Size</label><br>
                                                    @foreach($product_sizes as $size)
                                                    <div class="col-lg-3">
                                                        @if(Config::get('app.locale') == 'en')
                                                            
                                                            @if($size->size->size_en != '')
                                                            <input checked type="checkbox" value="{{ $size->size->id }}" name="sizes[{{ $size->size->id }}]">  {{ $size->size->size_en}}
                                                            @else
                                                            <input checked type="checkbox" value="{{ $size->size->id }}" name="sizes[{{ $size->size->id }}]">  {{ $size->size->size_ar}}
                                                            @endif

                                                        @elseif(Config::get('app.locale') == 'ar')
                                                              
                                                            @if($size->size->size_ar != '')
                                                            <input checked type="checkbox" value="{{ $size->size->id }}" name="sizes[{{ $size->size->id }}]">  {{ $size->size->size_ar}}
                                                            @else
                                                            <input checked type="checkbox" value="{{ $size->size->id }}" name="sizes[{{ $size->size->id }}]">  {{ $size->size->size_en}}
                                                            @endif

                                                        @endif
                                                    </div>
                                                    @endforeach

                                                    @foreach($other_sizes as $size)
                                                    <div class="col-lg-3">
                                                        @if(Config::get('app.locale') == 'en')
                                                            
                                                            <input type="checkbox" value="{{ $size->id }}" name="sizes[{{ $size->id }}]">  {{ $size->size_en}}

                                                        @elseif(Config::get('app.locale') == 'ar')
                                                              
                                                            <input type="checkbox" value="{{ $size->id }}" name="sizes[{{ $size->id }}]">  {{ $size->size_ar}}
                                                              
                                                    
                                                        @endif
                                                    </div>
                                                    @endforeach

                                                </div>
                                               
                                            </div>


                                            <div class="col-lg-12">
                                                <br>
                                                <button id="submit-btn" type="submit" class="btn btn-block btn-primary">@lang('products.Update_Product')</button>
                                            </div>
                                               
                                </div>
                             
                            </form>
                        </div>
                    </div>
                </div>


                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

@endsection