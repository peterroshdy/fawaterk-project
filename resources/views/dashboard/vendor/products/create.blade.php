@extends('layouts/dashboard/header')

@section('Styles')
    <style>
        .bootstrap-tagsinput input{
            border: 0;
        }
    </style>
@endsection

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
                @if(Session::has('message-image-big'))
                                <p class="alert alert-danger">{{ Session::get('message-image-big') }}</p>
                            @endif
                <br>
                
                <form enctype="multipart/form-data" method="POST" action="{{ route('product.store', $storeInfo->id) }}">
                    {{ csrf_field() }}
                <input value="{{ $storeInfo->id }}" required name="store_id" type="hidden" class="form-control">
                @if($categories->first())
                <div class="col-sm-12">
                    <h4 class="page-title">@lang('products.Add_Products')</h4>
                    <p class="text-muted page-title-alt">@lang('products.You_can')</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @foreach($store_languages as $lang) 
                    @if($lang->lang == 'en')
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
                                                <input value="{{ old('product_title_en') }}" required name="product_title_en" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Description')</label>
                                                <textarea rows="9" required name="product_body_en" class="form-control" placeholder="@lang('products.Product_Description')">{{ old('product_body_en') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label >Product Colors in English</label><br>
                                                    <div class="tags-default">
                                                        <input type="text" name="product_colors_en" value="{{ old('product_colors_en') }}" data-role="tagsinput" placeholder="Enter Colors"/>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label >Product Sizes in English</label><br>
                                                    <div class="tags-default">
                                                        <input type="text" name="product_sizes_en" value="{{ old('product_sizes_en') }}" data-role="tagsinput" placeholder="Enter Sizes"/>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($lang->lang == 'ar')
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
                                                <input value="{{ old('product_title_ar') }}" required name="product_title_ar" type="name" class="form-control" placeholder="@lang('products.Product_Name')">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>@lang('products.Product_Description')</label>
                                                <textarea rows="9" required name="product_body_ar" class="form-control" placeholder="@lang('products.Product_Description')">{{ old('product_body_ar') }}</textarea>
                                            </div>
                                        </div>

                                         <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label >Product Colors in Arabic</label><br>
                                                    <div class="tags-default">
                                                        <input type="text" value="{{ old('product_colors_ar') }}" name="product_colors_ar" value="" data-role="tagsinput" placeholder="Enter Colors"/>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label >Product Sizes in Arabic</label><br>
                                                    <div class="tags-default">
                                                        <input type="text" name="product_sizes_ar" value="{{ old('product_sizes_ar') }}" data-role="tagsinput" placeholder="Enter Sizes"/>
                                                    </div>
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
                                                    <input value="{{ old('product_price') }}" required name="product_price" type="number" step="0.01" class="form-control" placeholder="@lang('products.Enter_Product')">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Category')</label>
                                                    <select required name="product_category" class="form-control">
                                                        @if($categories->first())
                                                            @foreach($categories as $category)
                                                            @if($category->name_en && $category->name_ar)
                                                                @if(Config::get('app.locale') == 'en')
                                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                                                @elseif(Config::get('app.locale') == 'ar')
                                                                <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                                                @endif
                                                            @elseif($category->name_en)
                                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                                            @elseif($category->name_ar)
                                                                <option value="{{ $category->id }}">{{ $category->name_ar }}</option>
                                                            @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>@lang('products.Product_Stock')</label>
                                                     <input value="{{ old('product_stock') }}" required name="product_stock" type="number" class="form-control" placeholder="@lang('products.Product_Stock')">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <br>
                                                        <label>@lang('products.Product_Image')</label>
														<input value="{{ old('product_main_image') }}"  type="file" name="product_main_image" class="filestyle" data-buttonname="btn-white" required>
                                                    </div>
                                                </div>
                
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('products.Product_Image_des')</label>
                                                        <input type="file" name="product_image_2" class="filestyle" data-buttonname="btn-white">
                                                    </div>
                                                </div>
                
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('products.Product_Image_desc')</label>
                                                        <input type="file" name="product_image_3" class="filestyle" data-buttonname="btn-white">
                                                    </div>
                                                </div>
                
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('products.Product_Image_4')</label>
                                                        <input type="file" name="product_image_4" class="filestyle" data-buttonname="btn-white">
                                                    </div>
                                                </div>
                
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>@lang('products.Product_Image_5')</label>
                                                        <input type="file" name="product_image_5" class="filestyle" data-buttonname="btn-white">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <button onclick="check_before_add_product()" id="submit-btn" type="submit" class="btn btn-block btn-primary">@lang('products.Add_Product')</button>
                                                </div>
                                        
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            @else
            <h3 class="text-center">Your store don't have any categories yet <i class="fa fa-frown-o"></i></h3>
            <div class="text-center"><a class="btn btn-success" href="{{ url('vendor/store/settings') }}">Store Settings</a></div>

            @endif



            



        </div>
        <!-- container -->

    </div>
    <!-- content -->

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

@section('Scripts')
<script src="{{ asset('main/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>

        <script src="{{ asset('main/plugins/switchery/js/switchery.min.js') }}"></script>
        <script src="{{ asset('main/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
@endsection