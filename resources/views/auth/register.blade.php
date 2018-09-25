@extends('layouts.Base')

{{-- Document Title --}}
@section('Title')
    @lang('Common.Customer_SignUp')
@endsection

{{-- Page Content --}}

@section('MainContent')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><strong class="text-custom">@lang('Common.Fawaterk')</strong></h3>
            <h4 class="text-center">@lang('Common.Customer_SignUp')</h4>
        </div>

        <div class="panel-body">
            <form method="post" class="form-horizontal m-t-20" action="{{ route('user.customer_register') }}">
               {{ csrf_field() }}

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="name" type="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" value="{{ old('password') }}" placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" placeholder="Confirm Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="phone" type="number" value="{{ old('phone') }}" placeholder="Phone Number" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <textarea class="form-control" name="address" value="{{ old('address') }}" placeholder="Your address" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" name="agree_to_terms_conditions" type="checkbox" checked="checked">
                            <label for="checkbox-signup">I accept
                                <a href="#">Terms and Conditions</a>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">
                            @lang('Common.SignUp')
                        </button>
                    </div>
                </div>


            </form>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <p>
                    Already have account?
                    <a href="{{ url('/') }}" class="text-primary m-l-5">
                        <b>@lang('Common.Login')</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
