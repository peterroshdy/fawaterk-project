@extends('layouts/dashboard/header')
@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">@lang('withdraw.Request_Withdraw')</h4>
                                <p class="text-muted page-title-alt">@lang('withdraw.Here_is')</p>
                            </div>
                        </div>

                        

                        @if($withdraw != '')
                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                @if(Session::has('message-withdraw-rejected'))
                                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-withdraw-rejected') }}</p>
                                @endif
                                   <form method="POST" action="{{ url('vendor/request-withdraw') }}">
                                        {{ csrf_field() }}
                                                
                                                <h1>@lang('withdraw.Available_for') {{ $withdraw->total }}$</h1>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        
                                                        <input type="hidden" required name="available_money" value="{{ $withdraw->total }}">

                                                        <input type="hidden" required name="withdraw_id" value="{{ $withdraw->id }}">

                                                        <input required name="withdraw_amount" step="0.01" type="number" class="form-control"  placeholder="@lang('withdraw.How_much')">
                                                    </div>
                                                </div>
                                     <button type="submit" class="btn btn-block btn-primary">@lang('withdraw.Request_Withdraw')</button>
                                    </form>

                                    </div>  
                                  </div>
                                

                                   
                                    
                                </div>
                            </div>
                            <!-- end col -->

                        </div>
                        @else

                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                  
                                  <h1>@lang('withdraw.Your_account')</h1>
                                  <a href="{{ url('/') }}"><button class="btn btn-primary">@lang('withdraw.Return_Home')</button></a>

                                    </div>  
                                  </div>
                                

                                   
                                    
                                </div>
                            </div>
                            <!-- end col -->

                        </div>

                        @endif
       
                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>

            </div>



            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


@endsection