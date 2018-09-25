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
                <b>@lang('Customer.All_Stores')</b><br>
                <small>@lang('Customer.All_Stores_desc')</small>
            </h4>

            <div class="inbox-widget nicescroll" tabindex="5000" style="overflow: hidden; outline: none;">
                @if ( count( $stores ) > 0 )
                    @foreach( $stores as $store )
                        
                            <div class="inbox-item">
                                <p class="inbox-item-author">@lang('Customer.Store') : <strong><a href="{{ url('store/'.$store->store->vendor_username.'') }}">#{{ $store->store->store_name }}</a></strong></p>
                            </div>

                            
                    @endforeach
                @else
                    <h1 class="text-center">@lang('Customer.no_stores')</h1>
                @endif
            </div>
        </div>


    </div>

</div>

@endsection
