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
                                <h4 class="page-title">All Tickets</h4>
                                <p class="text-muted page-title-alt">Here is all of tickets</p>
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
                                                    <th>Ticket ID</th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th style="min-width: 80px;">Create At</th>
                                                    <th style="min-width: 80px;">Action</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($tickets as $ticket)
                                                <tr>
                                                   
                                                    <td>{{ $ticket->id }}</td>
                                                    <td><span class="text-custom"><a href="{{ url('admin/ticket/'.$ticket->id.'') }}">{{ $ticket->title }}</a></span></td>
                                                    
                                                    @if($ticket->status == 0)
                                                    <td><span class="text-custom"><span class="badge badge-success">Open</span></span></td>
                                                    @elseif($ticket->status == 1)
                                                    <td><span class="text-custom"><span class="badge badge-danger">Closed</span></span></td>
                                                    @endif

                                                    <td>{{ $ticket->created_at }}</td>
                                                    <td><form action="{{ url('admin/ticket/'.$ticket->id.'/changeStatus') }}" method="post">

                                                        {{ csrf_field() }}
                                                        <select name="status" onchange="this.form.submit()" class="form-control">
                                                            @if($ticket->status == 0)

                                                            <option value="0">Open Ticket</option>
                                                            <option value="1">Close Ticket</option>
                                                            
                                                            @elseif($ticket->status == 1)
                                                            
                                                            <option value="1">Close Ticket</option>
                                                            <option value="0">Open Ticket</option>
                                                            
                                                            @endif
                                                        </select>
                                                       
                                                    </form></td>
                                                   
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