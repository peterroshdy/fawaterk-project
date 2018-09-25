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
                               

                                <h4 class="page-title">@lang('customers.Customers')</h4>
                                <p class="text-muted page-title-alt">@lang('customers.Here_is')</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('customers.Recent_Added')</h4>
                                    @if(Session::has('message-update'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-update') }}</p>
                                    @elseif(Session::has('message-delete'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-delete') }}</p>
                                    @endif
                        			

                        			<div class="table-responsive">
                                    @if(Session::has('message-email-exist'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message-email-exist') }}</p>
                                    @endif
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>@lang('customers.Name')</th>
                                                    <th>@lang('customers.Email')</th>
                                                    <th>@lang('customers.Phone')</th>

                                                    <th style="min-width: 80px;">@lang('customers.Create_At')</th>
                                                    <th style="min-width: 80px;">@lang('customers.Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($customers as $customer)
                                            	<tr>
                                                    <td>{{ $customer->name }}</td>
                                                    <td><span class="text-custom">{{ $customer->email }}</span></td>
                                                    <td><span class="text-custom">{{ $customer->phone }}</span></td> 
                                                    <td>{{ $customer->created_at->diffForHumans() }}</td>
                                                    <td>
                                                    	<a href="#" class="table-action-btn" data-toggle="modal" data-target="#editModal"><i class="md md-edit"></i></a>
                                                    	<a href="#" class="table-action-btn" data-toggle="modal" data-target="#deleteModal"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            	@endforeach

                                            </tbody>
                                        </table>
                                    </div>

                        		</div>
                        	</div>
                        	<!-- end col -->

                            @if($customers->first() != '')

                            <!-- Edit Customer Popup -->
                            <!-- Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('customers.Edit_Customers') {{ $customer->name }}</h5>
                                    
                                  </div>
                                  <div class="modal-body">
                                    
                                    <form method="POST" action="{{ url('vendor/customer/update/') }}">
                                        {{ csrf_field() }}
                                        
                                            <input value="{{ $customer->id }}" required name="customer_id"  type="hidden" class="form-control">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="customer_name">@lang('customers.Full_Name')</label>
                                                        <input value="{{ $customer->name }}" required name="customer_name"  type="name" class="form-control" id="customer_name"  placeholder="@lang('customers.Enter_Name')">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="customer_email">@lang('customers.Email')</label>
                                                        <input value="{{ $customer->email }}" required name="customer_email"  type="email" class="form-control" id="customer_email" placeholder="@lang('customers.Enter_Email')">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">

                                                        <label for="customer_phone">@lang('customers.Phone')</label>
                                                        <input value="{{ $customer->phone }}" required name="customer_phone"  type="number" class="form-control" id="customer_phone" placeholder="@lang('customers.Enter_Phone')">

                                                    </div>
                                                </div>

                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="customer_address">@lang('customers.Address')</label>
                                                <textarea required name="customer_address" class="form-control" id="customer_address">{{ $customer->address }}</textarea>
                                                
                                            </div>

                                            
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('customers.Close')</button>
                                    <button type="submit" class="btn btn-primary">@lang('customers.Edit_Customer')</button>
                                    </form>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Edit Customer Popup End -->

                            @endif
                            

                            @if($customers->first() != '')
                            <!-- Remove Customer Popup -->
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('customers.Remove_Customer') {{ $customer->name }}</h5>
                                    
                                  </div>
                                  <div class="modal-body">

                                    <p>@lang('customers.If_your') {{ $customer->name }} ?</p>
                                    <form action="{{ url('vendor/customer/delete/'.$customer->id.'') }}" method="post">

                                      {{ method_field('DELETE') }}
                                      {{ csrf_field() }}


                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('customers.Close')</button>
                                      <button type="submit" class="btn btn-danger">@lang('customers.Remove_Customer')</button>
                                    </div>

                                    </form>
                                    
                                  </div>
                                   
                                </div>
                              </div>
                            </div>

                            <!-- Edit Customer Popup End -->
                            @endif



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