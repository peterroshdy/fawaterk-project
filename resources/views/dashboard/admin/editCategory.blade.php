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
                            <div class="col-sm-12">
                                <h4 class="page-title">Edit Category</h4>
                               
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                               
         							<div class="container">
										<div class="row">
		                                	<div class="col-md-12">
		                                   
		                                    <!-- Tab panes -->
		                                    <div class="tab-content">
		                                        <div role="tabpanel" class="tab-pane active" id="profile">

		                                        	<form method="POST" action="{{ url('admin/category/'.$category->id.'/update') }}">
		                                        		{{ csrf_field() }}

		                                        		<div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>Category Name in English</label>
		                                                        <input value="{{ $category->name }}" required name="cate_en"  type="name" class="form-control">
		                                                    </div>
		                                                </div>

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>Category Name in Arabic</label>
		                                                        <input value="{{ $category->name_ar }}" required name="cate_ar" type="name" class="form-control">
		                                                    </div>
		                                                </div>

		                                              
		                                                <input type="submit" class="btn btn-primary btn-block" value="@lang('profile.Save_Changes')">

		                                        	</form>

		                                        </div>
		                                        
		                                    </div>
										</div>
                                	</div>
								</div>
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
        

@endsection