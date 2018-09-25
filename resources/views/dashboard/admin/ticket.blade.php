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
                                <h4 class="page-title">Ticket NO : {{ $ticket->id }}</h4><br>
                            </div>
                        </div>


                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                                
                                    <div class="table-responsive">
                                        <table class="table table-actions-bar m-b-0">
                                            @foreach($ticket_messages as $message)
                                                <div>
                                                    <span class="text-custom">From : </span><strong>{{ $message->user->name }}</strong>
                                                    <br>
                                                    <span class="text-custom">At : </span><strong>{{ $message->created_at }}</strong><br>
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                                <br><br>
                                            @endforeach
                                            
                                            @if($ticket->status == 0)
                                            <form method="POST" action="{{ url('admin/ticket/message/store') }}">
                                                {{ csrf_field() }}

                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                    
                                                    <textarea onkeyup='check();' id="message_field" required placeholder="Add Reply" rows="3" required name="message" class="form-control"></textarea>
                                                
                                                    <br>
                                                    <button style="display: none;" id="reply_btn" type="submit" class="btn btn-block btn-primary">Add Reply</button>
                                                
                                            </form>
                                            @endif

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
            <script type="text/javascript">

               var check = function() {
                  if (document.getElementById('message_field').value == '') {
                    document.getElementById('reply_btn').style.display = 'none';
                  } else {
                    document.getElementById('reply_btn').style.display = 'block';
                  }
                }
                    
            </script>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


@endsection