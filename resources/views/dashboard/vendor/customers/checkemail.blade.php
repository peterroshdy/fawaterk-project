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
                                <h4 class="page-title">@lang('customers.Add_Customer')</h4>
                                <p class="text-muted page-title-alt">@lang('customers.You_can')</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			
                        			<div class="table-responsive">
                        			
                                        
                                    @if(Session::has('message-customer-exists-in-customers-table'))
                                    <p class="alert alert-warning">{{ Session::get('message-customer-exists-in-customers-table') }}</p>
                                    @elseif(Session::has('add-customer-first'))
                                    <p class="alert alert-warning">{{ Session::get('add-customer-first') }}</p>
                                    @endif

                                    <form method="POST" action="{{ url('vendor/customer/emailcheck') }}">
                                        {{ csrf_field() }}
                                         
                                            <div class="col-lg-12">
                                                 <div class="form-group">
                                                    <label>@lang('customers.Enter_Customer')</label>
                                                    <input required name="customer_email"  type="email" class="form-control" id="customer_email" placeholder="@lang('customers.Enter_Email')">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                 <div class="form-group">

                                                    <button type="submit" class="btn btn-block btn-primary">@lang('customers.Search_for')</button>

                                                </div>
                                            </div>
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

        </div>
        <!-- END wrapper -->


@endsection