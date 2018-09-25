
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice Page</title>
        	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	

        <style>

            .qr_image{

                width: 100%;
                float: none;
                margin: 0 auto;
                text-align: center;
                display: block;
            }


            .invoice-box {
                max-width: 800px;
                margin: 1em auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr td{
                border-bottom: 1px solid #eee;
            }
            .top td{
                border: none !important;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .rtl table {
                text-align: right;
            }

            .rtl table tr td:nth-child(2) {
                text-align: left;
            }
        </style>
            </head>

    <body>
        <style>
            @media print {
                .no_print {display: none;}
            }
        </style>

        @if($invoice->type == 0)
        <div class="invoice-box">
                    <div class="row no_print">

                     
                    @if(Auth::check())
                        @if(Auth::user()->role_id == 1 && $invoice->vendor->id == Auth::id())
                        <a class="col-md-4 col-md-offset-4 col-xs-12 float-none no_print" href="{{ url('vendor/invoices/filterBy/all') }}">
                        <span class=" fa fa-backward"> </span> Return To Invoices 
                        </a>
                        <br>
                        
                        @endif
                    @endif
                </div>
                
               
                <table cellpadding="0" cellspacing="0">
                    @if(Session::has('message-vendor-pay'))
                                    <p class="alert alert-danger">{{ Session::get('message-vendor-pay') }}</p><br>
                                    @elseif(Session::has('message-payment-done'))
                                    <p class="alert alert-success">{{ Session::get('message-payment-done') }}</p><br>
                                    @endif


                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img class="img-responsive col-md-5 col-xs-3" src="{{ asset('static/logo-0.png') }}" style="max-width: 168px;margin-left: -16px;">
                                </td>

                                <td>
                                    Invoice ID #: <strong>{{ $invoice->id }}</strong><br>
                                    Created: <strong>{{ $invoice->created_at }}</strong><br>
                                    Due Date: <strong>{{ $invoice->due_date }}</strong>
                                  
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>

                                    <strong>Vendor Name : {{ $invoice->vendor->name }}</strong><br>
                                    Mobile:  {{ $invoice->vendor->mobile }}<br> 
                                    Email: {{ $invoice->vendor->email }}<br>
                                    Address: {{ $invoice->vendor->address }}

                                </td>

                                <td>
                                    @if($invoice->user != '')
                                    <strong>Customer Name : {{ $invoice->user->name }}</strong><br>
                                    Mobile:  {{ $invoice->user->phone }}<br> 
                                    Email: {{ $invoice->user->email }}<br>
                                    Address: {{ $invoice->user->address }}
                                    @else
                                    <strong>Customer Name : {{ $invoice->customer->name }}</strong><br>
                                    Mobile:  {{ $invoice->customer->phone }}<br> 
                                    Email: {{ $invoice->customer->email }}<br>
                                    Address: {{ $invoice->customer->address }}
                                    @endif
                                    

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">

                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
                
                @foreach($invoice_producs as $product)                               
                <tr class="item">
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->total }}</td>
                </tr>
                @endforeach
                            
                @if($invoice->tax_name && $invoice->tax_amount)
                <tr class="total">
                    <td colspan="3"> {{ $invoice->tax_name }} Tax :</td>
                    <td>
                        {{ $invoice->tax_amount }} %
                    </td>
                </tr>

                <tr class="total">
                    <td colspan="3"> Total :</td>
                    <td>
                        {{ $invoice->total }} {{ $invoice->currency }}
                    </td>
                </tr>
                @else

                <tr class="total">
                    <td colspan="3"> Total :</td>
                    <td>
                        {{ $invoice->total }} {{ $invoice->currency }}
                    </td>
                </tr>
                @endif

            </table>
            <br>
            <div class="col-md-3 col-xs-4  qr_image" style="margin:auto;float:none;">
                <img src="http://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$invoice->qrcode_link}}" alt="QRCode"/>
            </div>
            <!--
            <div class="row">
                <div class="col-xs-12 col-md-12 payment_container">

                    <p class="lead">Payment Type :</p>
                    <img src="/Fawaterk_Dev/Fawaterk-Dev/img/visa.png" alt="Visa">
                    <img src="/Fawaterk_Dev/Fawaterk-Dev/img/mastercard.png" alt="Mastercard">
                    <img src="/Fawaterk_Dev/Fawaterk-Dev/img/american-express.png" alt="American Express">
                    <img src="/Fawaterk_Dev/Fawaterk-Dev/img/paypal.png" alt="Paypal">
                    <br class="clear">
                </div>
            </div>
            -->
            

            
        </div>
        <div class="no_print">
        <div class="invoice-box">
            @auth
            @if($invoice->paid == 0)
                <form method="POST" action="{{ url('invoice/'.$invoice->id.'/'.$invoice->invoice_key.'/pay') }}">

                    {{ csrf_field() }}
                    
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" value="{{ $invoice->type }}" name="invoice_type">
                    <input value="{{ $invoice->vendor_id }}" required name="vendor_id" type="hidden" class="form-control">
                    <input required name="total" value="{{ $invoice->total }}" type="hidden" class="form-control">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Select Payment Method</label>
                            <select required name="payment_method" class="form-control">
                                                                    
                                <option value="1">Credit Card</option>
                                <option value="2">Cash Payment</option>
                                                                    
                            </select>
                        </div>
                    </div>
                                
                    <div class="col-lg-12">       
                    <button id="submit-btn" type="submit" class="btn btn-block btn-primary text-center">Pay Now</button>
                    </div>

                    <div class="col-lg-12"><br>   
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
               
                
                </div>
                    </div>
                </form>
            @else
                <div class="no_print">
                        
                    <div class="col-lg-12"><br> 
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
                        
                </div>
            @endif
            @endauth

            @guest

                <div class="no_print">
                        
                    <div class="col-lg-12"><br>  
                    <a href="{{ url('/') }}"><button class="btn btn-block btn-danger">Login to pay</button></a><br>
                    <a href="{{ url('/register') }}"><button class="btn btn-block btn-warning">Register to pay</button></a><br>
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
                        
                </div>

            @endguest

            
        </div>
        @else

        <div class="invoice-box">
                <div class="row no_print">
                    @if(Auth::check())
                        @if(Auth::user()->role_id == 1 && $invoice->vendor->id == Auth::id())
                        <a class="col-md-4 col-md-offset-4 col-xs-12 float-none no_print" href="{{ url('vendor/invoices/filterBy/all') }}">
                        <span class=" fa fa-backward"> </span> Return To Invoices 
                        </a>
                        <br>
                        
                        @endif
                    @endif
                </div>
                
                <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    @if(Session::has('message-vendor-pay'))
                                    <p class="alert alert-danger">{{ Session::get('message-vendor-pay') }}</p><br>
                                    @elseif(Session::has('message-payment-done'))
                                    <p class="alert alert-success">{{ Session::get('message-payment-done') }}</p><br>
                                    @endif
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img class="img-responsive col-md-5 col-xs-3" src="{{ asset('static/logo-0.png') }}" style="max-width: 168px;margin-left: -16px;">
                                </td>

                                <td>
                                    Invoice Key #: <strong>{{ $invoice->invoice_key }}</strong><br>
                                    Due Date : <strong>{{ $invoice->due_date }}</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>

                                    <strong>Vendor Name : {{ $invoice->vendor->name }}</strong><br>
                                    Mobile:  {{ $invoice->vendor->mobile }}<br> 
                                    Email: {{ $invoice->vendor->email }}<br>
                                    Address: {{ $invoice->vendor->address }}

                                </td>

                                <td>
                                    
                                    @if($invoice->user != '')
                                    <strong>Customer Name : {{ $invoice->user->name }}</strong><br>
                                    Mobile:  {{ $invoice->user->phone }}<br> 
                                    Email: {{ $invoice->user->email }}<br>
                                    Address: {{ $invoice->user->address }}
                                    @else
                                    <strong>Customer Name : {{ $invoice->customer->name }}</strong><br>
                                    Mobile:  {{ $invoice->customer->phone }}<br> 
                                    Email: {{ $invoice->customer->email }}<br>
                                    Address: {{ $invoice->customer->address }}
                                    @endif

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">

                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
                
                @foreach($invoice_producs as $product)                               
                <tr class="item">
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->total }}</td>
                </tr>
                @endforeach
                            
                 @if($invoice->tax_name && $invoice->tax_amount)
                <tr class="total">
                    <td colspan="3"> {{ $invoice->tax_name }} Tax :</td>
                    <td>
                        {{ $invoice->tax_amount }} %
                    </td>
                </tr>

                <tr class="total">
                    <td colspan="3"> Payment This Month : </td>
                    <td>
                        {{ $invoice->total }} {{ $invoice->currency }}
                    </td>
                </tr>

                @else

                <tr class="total">
                    <td colspan="3"> Payment This Month : </td>
                    <td>
                        
                        {{ $invoice->total }} {{ $invoice->currency }}
                    </td>
                </tr>


                @endif

                
            </table>

            <div class="col-md-3 col-xs-4  qr_image" style="margin:auto;float:none;">
                <img src="http://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$invoice->qrcode_link}}" alt="QRCode"/>
            </div>
        </div>

        <div class="no_print">
        <div class="invoice-box">
            @auth
            @if($invoice->paid == 0)
                <form method="POST" action="{{ url('invoice/'.$invoice->id.'/'.$invoice->invoice_key.'/pay') }}">

                    {{ csrf_field() }}
                    
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" value="{{ $invoice->type }}" name="invoice_type">
                    <input value="{{ $invoice->vendor_id }}" required name="vendor_id" type="hidden" class="form-control">
                    <input required name="total" value="{{ $invoice->total }}" type="hidden" class="form-control">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Select Payment Method</label>
                            <select required name="payment_method" class="form-control">
                                                                    
                                <option value="1">Credit Card</option>
                                <option value="2">Cash Payment</option>
                                                                    
                            </select>
                        </div>
                    </div>
                                
                    <div class="col-lg-12">       
                    <button id="submit-btn" type="submit" class="btn btn-block btn-primary text-center">Pay Now</button>
                    </div>

                    <div class="col-lg-12"><br>   
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
               
                
                </div>
                    </div>
                </form>
            @else
                <div class="no_print">
                        
                    <div class="col-lg-12"><br> 
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
                        
                </div>
            @endif
            @endauth

            @guest

                <div class="no_print">
                        
                    <div class="col-lg-12"><br>  
                    <a href="{{ url('/') }}"><button class="btn btn-block btn-danger">Login to pay</button></a><br>
                    <a href="{{ url('/register') }}"><button class="btn btn-block btn-warning">Register to pay</button></a><br>
                    <button class="btn btn-block btn-success" onclick="window.print();"><i class="fa fa-print"></i>Print</button>
                        
                </div>

            @endguest

            
        </div>
        
        @endif
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>
                        $(document).ready(function () {
                            $('body').undelegate('#Type', 'change').delegate('#Type', 'change', function () {
                                type = $(this).val();
                                if (type == 1) {
                                    $(".paypal-form").show();
                                    $(".fawry-form").hide();
                                } else if (type == 0) {
                                    $(".fawry-form").show();
                                    $(".paypal-form").hide();
                                } else {
                                    $(".fawry-form").hide();
                                    $(".paypal-form").hide();
                                }
                            });
                            resizeContent();
                            $(window).resize(function () {
                                resizeContent();
                            });
                            function resizeContent() {
                                $height = $('#masthead').height();
                                $('.site-content').css({'padding-top': $height});
                            }

                        });
        </script>
    </body>
</html>