@extends('layouts.main.header')
@section('title', 'Sign Up Customer')

@section('content')

    
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
                <div class="panel-heading">
                    <h3 class="text-center"> Sign Up to <strong class="text-custom">{{ $store->store_name }}</strong> Store as Customer</h3>
                </div>

                <div class="panel-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>     
                    @endif
                    <form method="post" class="form-horizontal m-t-20" action="{{ route('register_customer', $store->vendor_username) }}">
                        {{ csrf_field() }}

                       
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" name="customer_name" type="name" required placeholder="Full Name">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control"  name="customer_email" type="email" required placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control"  name="customer_password" type="password" required placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="customer_phone" type="number" required placeholder="Phone Number">
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
                    </form>
                    <div class="row">
                <div class="col-sm-12 text-center">
                    <p>
                        Already have account?<a href="{{ url('login') }}" class="text-primary m-l-5"><b>Sign In</b></a>
                    </p>
                </div>
            </div>
                </div>
            </div>

            

        </div>
@endsection
