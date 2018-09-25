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
                                
                                <h4 class="page-title">Categories</h4>
                                <p class="text-muted page-title-alt">Here is all your categories</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">Recent Added Categories <a data-toggle="modal" data-target="#exampleModal" href="#">Add New</a></h4>
                        			<div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                	<th>Category ID</th>
                                                    <th>Category Name En</th>
                                                    <th>Category Name Ar</th>
                                      
                                                    
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($categories as $category)
                                            	<tr>
                                                    <td><a href="##">{{ $category->id }}</a></td>
                                                    <td><span class="text-custom">{{ $category->name }}</span></td>
                                                    <td><span class="text-custom">{{ $category->name_ar }}</span></td>
                                                    <td><span class="text-custom">{{ $category->created_at->diffForHumans() }}</span></td>                                     
                                                    <td>
                                                    	<a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="table-action-btn" ><i class="md md-edit"></i></a>
                                                    	<a href="{{ url('admin/category/'.$category->id.'/delete') }}" class="table-action-btn" ><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            	@endforeach



                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        

                                                        <form method="POST" action="{{ url('admin/categories/create') }}">
                                                         {{ csrf_field() }}
                                        
                                                
                                                                <input value="" required name="store_id" type="hidden" class="form-control">

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Category Name En</label>
                                                                        <input required name="category_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>أسم القسم</label>
                                                                        <input required name="category_name_ar"  type="name" class="form-control"  placeholder="أدخل اسم القسم">
                                                                    </div>
                                                                </div>
                                                        
                                                  </div>
                                                  <div class="modal-footer">

                                                    <button id="submit-btn" type="submit" class="btn btn-block btn-primary">Add Product</button>
                                                            </form>


                                                      </div>
                                                     
                                                    </div>
                                                  </div>
                                                </div>

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