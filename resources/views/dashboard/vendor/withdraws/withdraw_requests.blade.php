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
                                <h4 class="page-title">@lang('withdraw.Withdraw_Requests')</h4>
                                <p class="text-muted page-title-alt">@lang('withdraw.Here_all')</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                
                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>@lang('withdraw.ID')</th>
                                                    <th>@lang('withdraw.Amount')</th>
                                                    <th>@lang('withdraw.Status')</th>
                                                    <th style="min-width: 80px;">@lang('withdraw.Create_At')</th>
                                                    <th style="min-width: 80px;">@lang('withdraw.Action')</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($withdraw_requests != '')
                                                @foreach($withdraw_requests as $request)
                                                <tr>
                                                   
                                                    <td>{{ $request->id }}</td>
                                                    <td><span class="text-custom">{{ $request->withdraw_amount }}</span></td>
                                                    
                                                    @if($request->status == 0)
                                                    <td><span class="text-custom"><span class="badge badge-primary">@lang('withdraw.Pending')</span></span></td>
                                                    @elseif($request->status == 1)
                                                    <td><span class="text-custom"><span class="badge badge-success">@lang('withdraw.Approved')</span></span></td>
                                                    @elseif($request->status == 2)
                                                    <td><span class="text-custom"><span class="badge badge-danger">@lang('withdraw.Rejacted')</span></span></td>
                                                    @endif

                                                    <td>{{ $request->created_at }}</td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn" data-toggle="modal" data-target="#deleteModal"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->



                        </div>
                        <!-- end row -->


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