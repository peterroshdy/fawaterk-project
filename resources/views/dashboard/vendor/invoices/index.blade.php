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
                                <h4 class="page-title">@lang('invoices.Invoices')</h4>
                                <p class="text-muted page-title-alt">@lang('invoices.Here_Desc')</p>
                            </div>
                        </div>
                        

                                                
                        

<strong>Filter By</strong>
                        <div class="row">
                            <!-- col -->
                            
                             <div class="col-lg-3 ">
                                                <select onchange="location = this.value;" class="form-control">
                                                    @if($filter == 'paid_invoices')
                                                     <option value="{{ url('vendor/invoices/filterBy/paid_invoices') }}">Paid Invoices</option>
                                                     <option value="{{ url('vendor/invoices/filterBy/all') }}">All</option>
                                                     <option value="{{ url('vendor/invoices/filterBy/installment_invoices') }}">Installments Invoices</option>
                                                    @elseif($filter == 'installment_invoices')
                                                      <option value="{{ url('vendor/invoices/filterBy/installment_invoices') }}">Installments Invoices</option>
                                                      <option value="{{ url('vendor/invoices/filterBy/paid_invoices') }}">Paid Invoices</option>
                                                      <option value="{{ url('vendor/invoices/filterBy/all') }}">All</option>
                                                     
                                                    @elseif($filter == 'all')
                                                    <option value="{{ url('vendor/invoices/filterBy/all') }}">All</option>
                                                    <option value="{{ url('vendor/invoices/filterBy/installment_invoices') }}">Installments Invoices</option>
                                                      <option value="{{ url('vendor/invoices/filterBy/paid_invoices') }}">Paid Invoices</option>
                                                      
                                                    @else
                                                     <option value="{{ url('vendor/invoices/filterBy/all') }}">All</option>
                                                    <option value="{{ url('vendor/invoices/filterBy/installment_invoices') }}">Installments Invoices</option>
                                                      <option value="{{ url('vendor/invoices/filterBy/paid_invoices') }}">Paid Invoices</option>
                                                    @endif
                                                    
                                                    
                                                </select>
                                                <br>
                                                </div>

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('invoices.Recent_Added')</h4><a href="{{ url('vendor/invoice/create') }}"><strong>Create Invoice</strong></a>


                        			<div class="table-responsive">
                                    @if(Session::has('message-email-sent'))
                                    <p class="alert alert-success">{{ Session::get('message-email-sent') }}</p>
                                    @elseif(Session::has('message-delete'))
                                    <p class="alert alert-success">{{ Session::get('message-delete') }}</p>
                                    @elseif(Session::has('message-updated'))
                                    <p class="alert alert-success">{{ Session::get('message-updated') }}</p>
                                    @elseif(Session::has('message-invoice-removed'))
                                    <p class="alert alert-danger">{{ Session::get('message-invoice-removed') }}</p>
                                    @elseif(Session::has('message-delete-error'))
                                    <p class="alert alert-danger">{{ Session::get('message-delete-error') }}</p>
                                    @elseif(Session::has('message-email-error'))
                                    <p class="alert alert-danger">{{ Session::get('message-email-error') }}</p>
                                    @endif
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>

                                                    <th>@lang('invoices.Invoice')</th>
                                                    <th>@lang('invoices.Vendor')</th>
                                                    <th>@lang('invoices.Customer')</th>
                                                    <th>@lang('invoices.Total')</th>
                                                    <th>@lang('invoices.Type')</th>
                                                    <th style="min-width: 80px;">@lang('invoices.Create_At')</th>
                                                    <th style="min-width: 80px;">@lang('invoices.Due_date')</th>
                                                    <th style="min-width: 80px;">@lang('invoices.status')</th>
                                                    <th style="min-width: 80px;">@lang('invoices.Action')</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@foreach($invoices as $invoice)
                                            	<tr>
                                                    <td><a href="{{ url('invoice/'.$invoice->id.'/'.$invoice->invoice_key.'') }}">@lang('invoices.LINK')</a></td>
                                                    <td>{{ $invoice->vendor->name }}</td>
                                                    @if($invoice->user != '')
                                                    <td><span class="text-custom">{{ $invoice->user->name }}</span></td>
                                                    @else
                                                    <td><span class="text-custom">{{ $invoice->customer->name }}</span></td>
                                                    @endif
                                                    <td><span class="text-custom">{{ $invoice->total }} {{ $invoice->currency }}</span></td>
                                                    @if($invoice->type == 0)
                                                    <td><span class="text-custom">@lang('invoices.Paid_Invoice')</span></td>
                                                    @else
                                                    <td><span class="text-custom">@lang('invoices.Installment_Invoice')</span></td>
                                                    @endif                                      
                                                    
                                                    
                                                    <td><span class="text-custom">{{ $invoice->created_at->diffForHumans() }}</span></td>

                                                    <td><span class="text-custom">{{ $invoice->due_date }}</span></td>

                                                    @if($invoice->paid == 0)
                                                    <td><span class="badge badge-danger">@lang('invoices.Unpaid')</span></td>
                                                    @else
                                                    <td><span class="badge badge-success">@lang('invoices.Paid')</span></td>
                                                    @endif
                                                    <td>
                                                        @if($invoice->locked == 0)
                                                        <a href="{{ url('vendor/invoice/'.$invoice->invoice_key.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        @endif
                                                        <a href="{{ url('vendor/invoice/delete/'.$invoice->id.'/'.$invoice->invoice_key.'/'.$invoice->type.'') }}" class="table-action-btn" ><i class="md md-close"></i>
                                                        </a>
                                                        <a href="{{ url('vendor/invoice/'.$invoice->invoice_key.'/email') }}" class="table-action-btn"><i class="md md-email"></i>
                                                        </a>
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