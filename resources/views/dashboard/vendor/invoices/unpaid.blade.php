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
                                <h4 class="page-title">@lang('invoices.Unpaid_Invoices')</h4>
                                <p class="text-muted page-title-alt">@lang('invoices.Here_is_unpaid')</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                        	<div class="col-lg-12">
                        		<div class="card-box">
                                   
                        			<h4 class="text-dark header-title m-t-0">@lang('invoices.Recent_Unpaid')</h4>
                        			

                        			<div class="table-responsive">
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
                                                
                                                @foreach($unpaid_invoices as $invoice)
                                                <tr>
                                                    <td><a href="{{ url('invoice/'.$invoice->invoice_key.'') }}">@lang('invoices.LINK')</a></td>
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
                                                        <a href="{{ url('vendor/invoice/'.$invoice->id.'/edit') }}" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        @endif
                                                        <a href="#" class="table-action-btn" data-toggle="modal" data-target="#deleteModal"><i class="md md-close"></i>
                                                        </a>
                                                        <a href="#" class="table-action-btn" data-toggle="modal" data-target="#emailModal"><i class="md md-email"></i>
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