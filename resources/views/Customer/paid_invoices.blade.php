@extends('Customer.Base')

{{-- Document Title --}}
@section('Title')
    @lang('Common.Invoices')
@endsection

{{-- Page Content --}}
@section('MainContent')

<div class="container-alt">

    <div class="col-lg-12">
       
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">
                <b>@lang('Customer.All_Invoices')</b>
            </h4>

            <div class="inbox-widget nicescroll" tabindex="5000" style="overflow: hidden; outline: none;">
                @if ( count($invoices ) > 0 )
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

@endsection
