@extends('Customer.Base')

{{-- Document Title --}}
@section('Title')
    @lang('Common.Tickets')
@endsection

{{-- Page Content --}}
@section('MainContent')

<div class="container-alt">
    <div class="col-md-12">

        <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title">
                    <b>All Tickets</b>
                </h4>
    
                <div class="inbox-widget nicescroll mx-box" tabindex="5000" style="overflow: hidden; outline: none;">
                    <a href="#">
                        <div class="inbox-item">
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">
                                <span class="label label-success">Open</span> Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">
                                <span class="label label-danger">Closed</span> Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
    
                    <a href="#">
                        <div class="inbox-item">
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">
                                <span class="label label-danger">Closed</span> Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
    
                    <a href="#">
                        <div class="inbox-item">
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">
                                <span class="label label-danger">Closed</span> Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
    
                    <a href="#">
                        <div class="inbox-item">
                            <p class="inbox-item-author">Chadengle</p>
                            <p class="inbox-item-text">
                                <span class="label label-danger">Closed</span> Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                    </a>
    

                </div>
            </div>

    </div>


</div>

@endsection