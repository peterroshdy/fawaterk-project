@extends('Customer.Base')

{{-- Document Title --}}
@section('Title')
    @lang('Common.Home')
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

<div class="col-md-6 col-md-offset-3 text-center">
    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</div>
    @endif
</div>

<div class="container-alt">
    <div class="col-md-6 col-md-offset-3">
        <div class="profile-detail card-box">

            <form method="post" class="form-horizontal m-t-20" action="{{ route('user.update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($customer->image)
                <img src="{{ asset('market/images/customers/' . $customer->image) }}" class="img-circle" alt="profile-image">
                @else
                <img src="{{ asset('static/pp.jpg') }}" class="img-circle" alt="profile-image">
                @endif

                <br>
                <br>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="file" name="image" class="filestyle" data-iconname="fa fa-cloud-upload" id="filestyle-6" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                        <div class="bootstrap-filestyle input-group">
                            <input type="text" name="avatar" class="form-control " placeholder="" disabled>
                            <span class="group-span-filestyle input-group-btn" tabindex="0">
                                <label for="filestyle-6" class="btn btn-default ">
                                    <span class="icon-span-filestyle fa fa-cloud-upload"></span>
                                    <span class="buttonText">@lang('customer.Choose_file')</span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="name" type="name" placeholder="@lang('customer.Full_Name')" value="{{ old('name') ?? $customer->username }}" required>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="email" type="email" placeholder="@lang('customer.Email')" value="{{ old('email') ?? $customer->email }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="phone" type="number" value="{{ old('phone') ?? $customer->mobile }}" placeholder="@lang('customer.Phone_Number')">
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="old_password" value="{{ old('old_password') }}" type="password" placeholder="@lang('customer.Old_Password')">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password" type="password" value="{{ old('password') }}" placeholder="@lang('customer.Password')">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" placeholder="@lang('customer.Confirm_Password')">
                    </div>
                </div>


                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-success btn-block text-uppercase waves-effect waves-light" type="submit">@lang('customer.Update')</button>
                    </div>
                </div>


            </form>

        </div>
    </div>
</div>

@endsection
