@extends('layouts/dashboard/admin/header')
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
                                <h4 class="page-title">Withdraw Requests</h4>
                                <p class="text-muted page-title-alt">Here is all of the withdraw requests</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">

                                    @if(Session::has('message-withdraw-a'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-withdraw-a') }}</p>
                                    @elseif(Session::has('message-withdraw-r'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-withdraw-r') }}</p>
                                    @elseif(Session::has('message-cash-less-withdraw'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-cash-less-withdraw') }}</p>
                                    @endif
                                
                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>

                                                    <th>Amount</th>
                                                    <th>Available Cash</th>
                                                    <th>Status</th>
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($withdraw_requests as $request)
                                                <tr>
                                                   
                                                    <td>{{ $request->id }}</td>
                                                    <td><span class="text-custom">{{ $request->withdraw_amount }}</span></td>
                                                    <td><span class="text-custom">{{ $request->withdraw->total }}</span></td>
                                                    @if($request->status == 0)
                                                    <td><span class="text-custom"><span class="badge badge-primary">Pending</span></span></td>
                                                    @elseif($request->status == 1)
                                                    <td><span class="text-custom"><span class="badge badge-success">Approved</span></span></td>
                                                    @elseif($request->status == 2)
                                                    <td><span class="text-custom"><span class="badge badge-danger">Rejacted</span></span></td>
                                                    @endif

                                                    <td>{{ $request->created_at }}</td>
                                                    <td>
                                                        
                                                        <form method="post" action="{{ url('admin/withdraws') }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="withdraw_id" value="{{ $request->withdraw_id }}">
                                                            <input type="hidden" name="withdraw_request_id" value="{{ $request->id }}">
                                                            <input type="hidden" name="withdraw_amount" value="{{ $request->withdraw_amount }}">
                                                            <select name="status" class="form-control">
                                                                <option value="1">Approve</option>
                                                                <option value="2">Reject</option>
                                                            </select>
                                                            <button class="btn btn-block btn-primary" type="submit">Response</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                                @endforeach

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