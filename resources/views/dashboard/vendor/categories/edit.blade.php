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
                               
                                <h4 class="page-title">@lang('Category.edit')</h4>
                                <p class="text-muted page-title-alt">@lang('Category.Here_is')</p>

                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->

                        		<div class="col-lg-12">
                        		
											<form action="{{ url('vendor/category/'.$category->id.'/update') }}" method="post">
												{{ csrf_field() }}
												                                	@if(count( $store_languages ) == 0)
															<div class="col-lg-12">
																<div class="form-group">
																	<input value="{{ $category->name_en }}" required name="category_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
																</div>
															</div>
															@endif

															@foreach($store_languages as $lang) 
                    										@if($lang->lang == 'en')
                    										<div class="col-lg-12">
																<div class="form-group">
																	<input value="{{ $category->name_en }}" required name="category_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
																</div>
															</div>
                    										@elseif($lang->lang == 'ar')
                    										<div class="col-lg-12">
																<div class="form-group">
																	<input value="{{ $category->name_ar }}" required name="category_name_ar"  type="name" class="form-control"  placeholder="أسم القسم">
																</div>
															</div>
                    				@endif
                    				@endforeach

                    				<div class="col-lg-12">
																<div class="form-group">
																	<input value="Update Category" required type="submit" class="btn btn-block btn-success">
																</div>
															</div>
															

											</form>
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