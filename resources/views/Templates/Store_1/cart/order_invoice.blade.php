
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

            
                <div class="invoice-box">
                    <div class="row no_print">
                    @if(Auth::check())
                       
                        <a class="col-md-4 col-md-offset-4 col-xs-12 float-none no_print" href="{{ url('/') }}">
                        <span class=" fa fa-backward"> </span> Return
                        </a>
                        <br>
                        
                    @endif
                </div>
                
               
                <table cellpadding="0" cellspacing="0">
                 @if(Session::has('message-order-success'))
                 <p class="alert alert-success">{{ Session::get('message-order-success') }}</p>
                 @endif
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img class="img-responsive col-md-5 col-xs-3" src="{{ asset('static/logo-0.png') }}" style="max-width: 168px;margin-left: -16px;">
                                </td>

                                <td>
                                    Invoice ID #: <strong>{{ $order->id }}</strong><br>
                                    Created At: <strong>{{ $order->created_at->format('M j Y') }}</strong><br>
                                    
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

                                    <strong>Vendor Name : {{ $order->vendor->name }}</strong><br>
                                    Mobile:  {{ $order->vendor->mobile }}<br> 
                                    Email: {{ $order->vendor->email }}<br>
                                    Store Name: {{ $store->store_name }}<br>

                                </td>

                                <td>
                                    
                                    <strong>Customer Name : {{ $order->user->name }}</strong><br>
                                    Mobile:  {{ $order->phone }}<br> 
                                    Email: {{ $order->user->email }}<br>
                                    Shipping Address: {{ $order->shipping_address }}

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
                
                @foreach($cart_items as $item)                               
                <tr class="item">
                    @if(Config::get('app.locale') == 'en')

                        @if($item->product->title_en != '')
                            <td>{{ $item->product->title_en }}</td>
                        @else
                            <td>{{ $item->product->title_ar }}</td>
                        @endif
                        
                    @elseif(Config::get('app.locale') == 'ar')
                        
                        @if($item->product->title_ar != '')
                            <td>{{ $item->product->title_ar }}</td>
                        @else
                            <td>{{ $item->product->title_en }}</td>
                        @endif

                    @endif
                    
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
                @endforeach
                            
                <tr class="total">
                    <td colspan="3"> Total :</td>
                    <td>
                        {{ $order->total }}$
                    </td>
                </tr>
            </table>
            <br>
            <div class="col-md-3 col-xs-4  qr_image" style="margin:auto;float:none;">
                <img class="qr_image" src="{{ asset('main/images/QRs/'.$order->qrcode.'') }}" alt=""/>
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
            <div class="row no_print">
                
                @if($order->paid == 1)
                <div class="col-xs-12">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>  Print</button>
                </div>
                @endif
                
            </div>
                @if($order->paid == 0)
                <form method="POST" action="{{ url('/store/'.$store->vendor_username.'/order/'.$order->id.'/payment-method') }}">

                    {{ csrf_field() }}
                    
                    <input value="{{ $order->vendor_id }}" required name="vendor_id" type="hidden" class="form-control">
                    <input required name="total" value="{{ $order->total }}" type="hidden" class="form-control">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Select Payment Method</label>
                            <select required name="payment_method" class="form-control">
                                                                    
                                <option value="Credit Card">Credit Card</option>
                                <option value="onDelivery">Pay on Delivery</option>
                                                                    
                            </select>
                        </div>
                    </div>
                                
                    <div class="col-lg-12">       
                    <button id="submit-btn" type="submit" class="btn btn-block btn-primary text-center">Pay Now</button>
                    </div>
                </form>
                @endif
        </div>

        
        
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