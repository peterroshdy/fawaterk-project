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
                                <h4 class="page-title">@lang('tickets.Send_a')</h4>
                                <p class="text-muted page-title-alt">@lang('tickets.You_can')</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->
                            
                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('tickets.Create_Ticket')</h4>
                        			<div class="table-responsive">
                                   
                                        
                                        <form method="POST" action="{{ url('vendor/ticket/store') }}">
					                    {{ csrf_field() }}
					                    
					                       <div class="col-lg-12">
                                                <label>@lang('tickets.Ticket_Title')</label>
                                                <input placeholder="@lang('tickets.Add_Title')" required name="title" type="text" class="form-control"><br>
                                            </div>

                                            <div class="col-lg-12">
                                                <label>@lang('tickets.Ticket_Message')</label>
                                                <textarea placeholder="@lang('tickets.Add_Message')" rows="4" required name="message" class="form-control"></textarea>
                                            </div>

                                            <div class="col-lg-12">
                                                <br>
                                                <button type="submit" class="btn btn-primary">@lang('tickets.Send_Ticket')</button>
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

          
@endsection

