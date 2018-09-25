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
                                <h4 class="page-title">@lang('store.lets_setup_first_store')</h4>
                                <p class="text-muted page-title-alt">@lang('store.add_products_later')</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->
                            @if(Session::has('message-image-big'))
                                <p class="alert alert-danger">{{ Session::get('message-image-big') }}</p>
                            @endif

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('store.Store_Info')</h4>
                        			<div class="table-responsive">
                                                             
                                        <form enctype="multipart/form-data" method="POST" action="{{ route('store.store') }}">
					                    {{ csrf_field() }}
					                    
					                        
					                        <div class="form-group">
					                            <label>@lang('store.Store_Name')</label>
					                            <input required name="store_name" value="{{ old('store_name') }}"   type="name" class="form-control" placeholder="@lang('store.Store_Name')">
					                        </div>

                                            <div class="form-group">
                                                <label>@lang('store.Store_Description')</label>
                                                <textarea required name="store_desc" value="{{ old('store_desc') }}"  class="form-control"placeholder="@lang('store.Store_Description')" rows="5" ></textarea>
                                                
                                            </div>

                                             <div class="form-group">
                                                <label>@lang('store.Your_Shipping')</label>
                                                <input required name="store_shipping_fees" value="{{ old('store_shipping_fees') }}"   type="number" step="0.01" class="form-control" placeholder="@lang('store.Your_Shipping')">                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>@lang('store.store_logo')</label>
                                                <input class="form-control" name="store_logo" type="file">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('store.store_available_languages') <small> For Now, You won't be able to change that in the future</small></label><br>
                                                <input name="languages[1]" type="checkbox" value="en"> English<br>
                                                <input name="languages[2]" type="checkbox" value="ar"> Arabic<br>
                                            </div>
                                            

					                        <button type="submit" class="btn btn-primary">@lang('store.create_store')</button>
					                    </form>

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