@extends('Customer.Base')

{{-- Document Title --}}
@section('Title')
    @lang('Common.Home')
@endsection

{{-- Page Content --}}
@section('MainContent')

<div class="container-alt">
    <div class="col-md-6">
        <div class="profile-detail card-box">
            <div>
                @if($customer->image)
                <img src="{{ asset('market/images/customers/' . $customer->image) }}" class="img-circle" alt="profile-image">
                @else
                <img src="{{ asset('static/pp.jpg') }}" class="img-circle" alt="profile-image">
                @endif

                <br>


                <h4 class="text-uppercase font-600">{{ $customer->username }}</h4>
                <h1 class="text-muted font-13">{{ $customer->email }} - {{ $customer->mobile }}</h1>
                <a href="{{ url('/customer/edit') }}" type="button" class="btn btn-success btn-custom btn-rounded waves-effect waves-light">@lang('Customer.edit_profile')</a>

                <hr>

                <ul class="list-inline status-list m-t-20">
                    <li>
                        <h3 class="text-primary m-b-5">{{ count( $customer->invoices) }}</h3>
                        <p class="text-muted">@lang('Customer.All_Invoices')</p>
                    </li>

                    <li>
                        <h3 class="text-success m-b-5">{{ count($customer->unpaidInvoices()) }}</h3>
                        <p class="text-muted">@lang('Customer.Unpaid_Invoices')</p>
                    </li>

                    <li>
                        <h3 class="text-warning m-b-5">{{ count($customer->tickets) }}</h3>
                        <p class="text-muted">@lang('Customer.All_Tickets')</p>
                    </li>

                </ul>


            </div>

        </div>

        <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title">
                    <b>@lang('Customer.All_Tickets')</b>
                </h4>

                @if ( count($customer->tickets) )
                    @foreach( $customer->tickets as $ticket )
                        <div class="inbox-widget nicescroll mx-box" tabindex="5000" style="overflow: hidden; outline: none;">
                            <a href="#">
                                <div class="inbox-item">
                                    <p class="inbox-item-author">{{ $ticket->title }}</p>
                                    <p class="inbox-item-text">
                                        <span class="label label-success">{{ $ticket->status }}</span> </p>
                                    <p class="inbox-item-date">{{ $ticket->updated_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center">@lang('Customer.no_tickets')</h3>
                @endif
            </div>

    </div>

    <div class="col-lg-6">

        <div class="blog-box-one">

            <div class="cover-wrapper bg-danger text-white p-20">@lang('Customer.upcoming_invoices')</div>
            @if ( count($upcoming_invoices) )
                @foreach( $upcoming_invoices as $invoice )
                    <div class="post-info">
                        <div class="date">
                            <span class="day"> {{ $invoice->day }} </span>
                            <br>
                            <span class="month"> {{ $invoice->month }} </span>
                        </div>

                        <div class="meta-container">
                            <a href="#">
                                <h5 class="text-overflow m-t-0"> @lang('Customer.invoice_no') : #<strong>{{ $invoice->id }}</strong></h5>
                                <h5 class="text-overflow m-t-0"> @lang('Customer.invoice_total'): <strong>{{ $invoice->total }}$</strong></h5>

                            </a>
                            <a href="{{ url( $invoice->link ) }}" class="btn btn-sm waves-effect btn-warning">@lang('Customer.pay_now')</a>
                            
                        </div>


               

                <div class="row m-t-10">
                   
                @endforeach
            @endif

        </div>
        <!-- end blog -->

        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">

                <b>@lang('Customer.All_Invoices')</b>
            </h4>

            <div class="inbox-widget nicescroll" tabindex="5000" style="overflow: hidden; outline: none;">
                @if ( count( $invoices ) > 0 )
                    @foreach( $invoices as $invoice )
                        <a href="{{ url('invoice/'.$invoice->id.'/'.$invoice->invoice_key.'') }}">
                            <div class="inbox-item">
                                <p class="inbox-item-author">@lang('Customer.invoice_no') : <strong>#{{ $invoice->id }}</strong></p>
                                <p class="inbox-item-author">@lang('Customer.created_by') : <strong>{{ $invoice->vendor_username }} </strong></p>
                                <p class="inbox-item-author">@lang('invoices.Due_date') : <strong>{{ $invoice->due_date }} </strong></p>
                                 <p class="inbox-item-author">@lang('Customer.invoice_total') : <strong>{{ $invoice->total }}$</strong></p>
                                 
                                @if($invoice->paid == 0)
                                <p class="inbox-item-author">@lang('Customer.status') : <span class="badge badge-danger">@lang('Customer.invoice_unpaid')</span></p>
                                @else
                                <p class="inbox-item-author">@lang('Customer.status') : <span class="badge badge-success">@lang('Customer.invoice_paid')</span></p>
                                @endif

                                <p class="inbox-item-date"> {{ $invoice->created_at->diffForHumans() }} </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h1 class="text-center">@lang('Customer.no_invoices')</h1>
                @endif

            </div>
        </div>
        </div>


    </div>
</div>

@endsection
