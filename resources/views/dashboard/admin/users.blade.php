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
                                
                                <h4 class="page-title">Users</h4>
                                <p class="text-muted page-title-alt">Here is all your users</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">Recent Added Users</h4>
                        			<div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                	<th>ID</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                               
                                                    <th>Last Login</th>
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($profiles as $profile)
                                            	<tr>
                                                    <td>{{ $profile->id }}</td>
                                                    <td><span class="text-custom">{{ $profile->name }}</span></td>
                                                    <td><span class="text-custom">{{ $profile->username }}</span></td>
                                                   
                                                    <td>{{ $profile->updated_at->diffForHumans() }}</td>
                                                    <td>{{ $profile->created_at->diffForHumans() }}</td>
                                                    <td>
                                                    	<a href="{{ url('admin/user/'.$profile->id.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                    	<a href="{{ url('admin/user/'.$profile->id.'/delete') }}" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            	@endforeach

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