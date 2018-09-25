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
                                <h4 class="page-title">@lang('tickets.My_Tickets')</h4>
                                <p class="text-muted page-title-alt">@lang('tickets.Here_is')</p>
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
                                                    <th>@lang('tickets.Ticket_ID')</th>
                                                    <th>@lang('tickets.Title')</th>
                                                    <th>@lang('tickets.Status')</th>
                                                    <th style="min-width: 80px;">@lang('tickets.Create_At')</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($tickets != '')
                                                @foreach($tickets as $ticket)
                                                <tr>
                                                   
                                                    <td>{{ $ticket->id }}</td>
                                                    <td><span class="text-custom"><a href="{{ url('vendor/ticket/'.$ticket->id.'') }}">{{ $ticket->title }}</a></span></td>
                                                    
                                                    @if($ticket->status == 0)
                                                    <td><span class="text-custom"><span class="badge badge-success">@lang('tickets.Open')</span></span></td>
                                                    @elseif($ticket->status == 1)
                                                    <td><span class="text-custom"><span class="badge badge-danger">@lang('tickets.Closed')</span></span></td>
                                                    @endif

                                                    <td>{{ $ticket->created_at }}</td>
                                                   
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