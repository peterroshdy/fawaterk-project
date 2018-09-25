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
                                            @if($message->user->id == Auth::id())
                                                <div class="text-left" style="background-color: #03A9F4;color: white;padding: 10px;border-radius: 25px;">
                                                    @if($message->user->id == Auth::id())
                                                    <strong>ME</strong>
                                                    @else
                                                    <strong>{{ $message->user->name }}</strong>
                                                    @endif
                                                    <br>
                                                    <strong>{{ $message->created_at->diffForHumans() }}</strong><br>
                                                    <p>{{ $message->message }}</p>
                                                </div><br><br>
                                            @else
                                                <div class="text-right" style="background-color: #9e9e9e;color: white;padding: 10px;border-radius: 25px;">
                                                    @if($message->user->id == Auth::id())
                                                    <strong>ME</strong>
                                                    @else
                                                    <strong>{{ $message->user->name }}</strong>
                                                    @endif
                                                    <br>
                                                    <strong>{{ $message->created_at->diffForHumans() }}</strong><br>
                                                    <p>{{ $message->message }}</p>
                                                </div><br><br>
                                            @endif
                                            @endforeach
                                            
                                            @if($ticket->status == 0)
                                            <form method="POST" action="{{ url('vendor/ticket/message/store') }}">
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