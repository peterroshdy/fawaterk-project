@extends('layouts.main.header')
@section('title', 'Sign In')

@section('content')

<div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Sign In to <strong class="text-custom">@lang('Common.Fawaterk')</strong> </h3>
            </div> 


            <div class="panel-body">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>  

            @elseif(Session::has('message-customer-email-sent'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-customer-email-sent') }}</p>  
                   
            @elseif(Session::has('message-account-activated'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-account-activated') }}</p>   

            @elseif(Session::has('message-account-not-activated'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-account-not-activated') }}</p>   

            @endif
            <form  class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input required class="form-control" name="email" value="{{ old('email') }}" type="email" placeholder="Email">
                        @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">

                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;Remember Me
                            </label>       
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a class="text-dark" href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i>Forgot Your Password?</a>
                        
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
                <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Don't have an account? <br>
                        <a href="{{ url('/register') }}">Sign Up as <strong>Customer</strong></a> OR
                        <a href="{{ route('register_vendor') }}">Sign Up as <strong>Vendor</strong></a>
                    </p>
                        
                    </div>
                </div>
            
</div>

@endsection

    


