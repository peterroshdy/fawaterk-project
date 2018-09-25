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
                                
                                <h4 class="page-title">Roles</h4>
                                <p class="text-muted page-title-alt">Here is all your roles</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">Recent Added Roles</h4><a data-toggle="modal" data-target="#exampleModal" href="#">Add New</a>
                        			<div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                	<th>Role ID</th>
                                                    <th>Role Name En</th>
                                                    <th>Role Name Ar</th>                                  
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($roles as $role)
                                            	<tr>
                                                    <td><a href="##">{{ $role->id }}</a></td>
                                                    <td><span class="text-custom">{{ $role->name }}</span></td>
                                                    <td><span class="text-custom">{{ $role->name_ar }}</span></td>
                                                    <td>{{ $role->created_at }}</td>
                                                    <td>
                                                    	<a href="#" class="table-action-btn" data-toggle="modal" data-target="#editModal"><i class="md md-edit"></i></a>
                                                    	<a href="#" class="table-action-btn" data-toggle="modal" data-target="#deleteModal"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            	@endforeach

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add new role</h5>
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
                                                                        <label>Role Name En</label>
                                                                        <input required name="role_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
                                                                    </div>
                                                                </div>

                                                                 <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>أسم الدور</label>
                                                                        <input required name="role_name_ar"  type="name" class="form-control"  placeholder="أدخل اسم القسم">
                                                                    </div>
                                                                </div>
                                                        
                                                  </div>
                                                  <div class="modal-footer">

                                                    <button id="submit-btn" type="submit" class="btn btn-block btn-primary">Add Role</button>
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