@extends('layouts/dashboard/header')
@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                        <h4 class="text-dark header-title m-t-0">Edit Product</h4><br>

                        <form method="POST" action="{{ url('vendor/store/'.$common_product_info->vendor_username.'/product/'.$common_product_info->key.'') }}">
                        {{ csrf_field() }}
                        <input name = "_method" type = "hidden" value = "PUT">

                        @foreach($store_languages as $language)
                            
                                @if($language->lang == 'en')
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
                                                            <input value="{{ $product_en->title }}" required name="product_title_en" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>@lang('products.Product_Description')</label>
                                                            <textarea rows="5" required name="product_body_en" class="form-control" placeholder="@lang('products.Product_Description')">{{ $product_en->body }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label >Product Colors in English</label><br>
                                                            <input value="{{ $colors_en }}" placeholder="Enter Colors" class="form-control" type="text" name="product_colors_en">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($language->lang == 'ar')

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
                                                            <input value="{{ $product_ar->title }}" required name="product_title_ar" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>@lang('products.Product_Description')</label>
                                                            <textarea rows="5" required name="product_body_ar" class="form-control" placeholder="@lang('products.Product_Description')">{{ $product_ar->body }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label >Product Colors in Arabic</label><br>
                                                            <input value="{{ $colors_ar }}" placeholder="Enter Colors" class="form-control" type="text" name="product_colors_ar">
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
                                                    <input value="{{ $common_product_info->price }}" required name="product_price" type="number" step="0.01" class="form-control" placeholder="@lang('products.Enter_Product')">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Category')</label>
                                                    <select required name="product_category" class="form-control">

                                                        @if($common_product_info->category->name_en && $common_product_info->category->name_ar)
                                                            <option value="{{ $common_product_info->category->id }}">{{ $common_product_info->category->name_en }} (Current)</option>
                                                        @elseif($common_product_info->category->name_en)
                                                            <option value="{{ $common_product_info->category->id }}">{{ $common_product_info->category->name_en }} (Current)</option>
                                                        @elseif($common_product_info->category->name_ar)
                                                            <option value="{{ $common_product_info->category->id }}">{{ $common_product_info->category->name_ar }} (Current)</option>
                                                        @endif
                                                        
                                                        @foreach($categories as $category)
                                                            
                                                                @if($category->name_en && $category->name_ar)
                                                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                                                @elseif($category->name_en)
                                                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                                                @elseif($category->name_ar)
                                                                    <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                                                @endif
                                                             
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Stock')</label>
                                                     <input value="{{ $common_product_info->stock }}" required name="product_stock" type="number" class="form-control" placeholder="@lang('products.Product_Stock')">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button onclick="check_before_add_product()" id="submit-btn" type="submit" class="btn btn-block btn-primary">@lang('products.Update_Product')</button>
                                            </div>
                                            
                                    </div>
                                </div>
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