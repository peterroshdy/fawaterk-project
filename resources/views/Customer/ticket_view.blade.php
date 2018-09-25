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
            <h4 class="m-t-0 m-b-20 header-title"><b>Ticket: Ticket Title here.</b></h4>
            
            <div class="chat-conversation">
                <ul class="conversation-list nicescroll" tabindex="5001" style="overflow: hidden; outline: none;">
                    <li class="clearfix">
                        <div class="chat-avatar">
                            <img src="assets/images/avatar-1.jpg" alt="male">
                            <i>10:00</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>John Deo</i>
                                <p>
                                    Hello!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix odd">
                        <div class="chat-avatar">
                            <img src="assets/images/users/avatar-5.jpg" alt="Female">
                            <i>10:01</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>Smith</i>
                                <p>
                                    Hi, How are you? What about our next meeting?
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="chat-avatar">
                            <img src="assets/images/avatar-1.jpg" alt="male">
                            <i>10:01</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>John Deo</i>
                                <p>
                                    Yeah everything is fine
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="clearfix odd">
                        <div class="chat-avatar">
                            <img src="assets/images/users/avatar-5.jpg" alt="male">
                            <i>10:02</i>
                        </div>
                        <div class="conversation-text">
                            <div class="ctext-wrap">
                                <i>Smith</i>
                                <p>
                                    Wow that's great
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-sm-9 chat-inputbar">
                        <input type="text" class="form-control chat-input" placeholder="Enter your text">
                    </div>
                    <div class="col-sm-3 chat-send">
                        <button type="submit" class="btn btn-md btn-info btn-block waves-effect waves-light">Send</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection