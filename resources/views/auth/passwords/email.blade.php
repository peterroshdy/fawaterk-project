@extends('layouts.main.header')

@section('content')


<div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Reset Your Password </h3>
            </div> 


            <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           
                            <div class="col-md-12">
                                <input placeholder="Enter Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
               
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">Send Password Reset Link</button>
                    </div>
                </div>

            </form> 
            
            </div>   
            </div>                              
        
</div>


@endsection


