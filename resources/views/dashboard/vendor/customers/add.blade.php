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
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('customers.Add_Customer')</h4>
                        			<div class="table-responsive">

                        			
                        			<div class="table-responsive">
                                    @if($customer_email)
                                    customer email is passed : {{ $customer_email }}

                                    @elseif($doesCustomerExistInUsersTable)
                                    this is the email info : {{ $doesCustomerExistInUsersTable }}

                                    @endif
                                    <!--
                                        <form method="POST" action="#">
					                    {{ csrf_field() }}
					                    

					                        <div class="col-lg-4">
                                                <div class="form-group">
                                                <label for="customer_name">@lang('customers.Full_Name')</label>
                                                <input required name="customer_name"  type="name" class="form-control" id="customer_name"  placeholder="@lang('customers.Enter_Name')">
                                                </div>
                                            </div>
					                        
                                            <div class="col-lg-4">
    					                         <div class="form-group">
    					                            <label for="customer_email">@lang('customers.Email')</label>
    					                            <input required name="customer_email"  type="email" class="form-control" id="customer_email" placeholder="@lang('customers.Enter_Email')">
    					                        </div>
                                            </div>

                                            <div class="col-lg-4">
    					                        <div class="form-group">
    					                            <label for="customer_phone">@lang('customers.Phone')</label>
    					                            <input required name="customer_phone"  type="number" class="form-control" id="customer_phone" placeholder="@lang('customers.Enter_Phone')">
    					                        </div>
                                            </div>

                                            <div class="col-lg-12">
    					                        <div class="form-group">
    					                            <label for="customer_address">@lang('customers.Address')</label>
    					                            <textarea required name="customer_address" class="form-control" placeholder="@lang('customers.Enter_Address')"></textarea>
    					                        </div>
                                            </div>

					                        <button type="submit" class="btn btn-block btn-primary">@lang('customers.Add_Customer')</button>
					                    </form>
                                        -->

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