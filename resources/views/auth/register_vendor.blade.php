@extends('layouts.main.header')
@section('title', 'Sign Up Vendor')

@section('content')

    
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-heading">
                    <h3 class="text-center"><strong class="text-custom">@lang('Common.Fawaterk')</strong></h3>
                    <h4 class="text-center">@lang('Common.Vendor_SignUp')</h4>
                </div>

                <div class="panel-body">
                    @if(Session::has('message-success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-success') }}</p>       
                    @elseif(Session::has('message-email-exist'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-email-exist') }}</p>  
                    @elseif(Session::has('message-phone-exist'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-phone-exist') }}</p>  
                    @endif
                    <form method="post" class="form-horizontal m-t-20" action="{{ route('register_vendor') }}">
                        {{ csrf_field() }}

                        <div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" id="vendor_name" name="vendor_name" type="name" required placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" id="vendor_email" name="vendor_email" type="email" required placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" id="vendor_password" name="vendor_password" type="password" required placeholder="Password">
                            </div>
                        </div>

                        </div>
                        <div>
                            
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea rows="4" class="form-control" id="vendor_address" name="vendor_address" required placeholder="Address"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" id="vendor_phone" name="vendor_phone" type="number" required placeholder="Phone Number">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" name="agree_to_terms_conditions" type="checkbox" checked="checked">
                                    <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">
                                    Register
                                </button>
                            </div>
                        </div>
                        </div>

                        </div>
                    </form>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>
                        Already have account?<a href="{{ url('login') }}" class="text-primary m-l-5"><b>Sign In</b></a>
                    </p>
                </div>
            </div>

        </div>
@endsection
