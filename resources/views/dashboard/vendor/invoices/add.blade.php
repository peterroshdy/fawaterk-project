@extends('layouts/dashboard/header')
@section('content')

<style type="text/css">
    .add_product{
    background: transparent;
    border: none;
    color: #2196F3;
    font-weight: bold;
    
    }
    .remove_product{
    background: red;
    border: none;
    color: white;
    font-weight: bold;
    
    }
</style>

@section('Styles')
    <link href="{{ asset('main/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@endsection

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
                                <h4 class="page-title">@lang('invoices.Add_New_Inv')</h4>
                                <p class="text-muted page-title-alt">@lang('invoices.You_Desc')</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->
                            
                            <div class="col-lg-12">
                                <div class="card-box">
                                   

                                    
                                    <div class="table-responsive">

                                    <div class="table-responsive">

                                    @if(Session::has('message-no-products-added'))
                                    <p class="alert alert-danger">{{ Session::get('message-no-products-added') }}</p>
                                    @endif
                                        
                                        <form  method="POST" action="{{ url('vendor/invoice/store') }}">
                                        {{ csrf_field() }}
                                      
                                            
                                            <div class="col-lg-12">
                                                <label for="customer_name">@lang('invoices.Choose_Customer')</label>

                                                <select required name="customer_id"  type="name" class="form-control">
                                                    @foreach($customers as $customer)
                                                        @if($customer->user_id == 0)
                                                        <option  value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @else
                                                        <option  value="{{$customer->user_id}}">{{$customer->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>

                                                    
                                            <div class="col-lg-12">
                                                <label for="customer_name">@lang('invoices.Cho_Inv_Ty')</label>
                                                <select required onchange="myFunction(event)" name="invoice_type" class="form-control">
                                                    
                                                    <option  value="0">@lang('invoices.Paid_Invoice')</option>
                                                    <option  value="1">@lang('invoices.Installment_Invoice')</option>
                                                </select>
                                                <br>
                                            </div>

                                            <br>
                                            <div class="col-lg-12">

                                                <label id="field_label">@lang('invoices.Due_Date')</label>
                                                <div id="field_type" class="input-group">
                                                    <input type="text" name="invoice_due_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                                    <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                                                </div><!-- input-group -->

                                                <br>
                                                        
                                            </div>

                                            <div class="col-lg-12">

                                                <label>Invoice Currency</label>
                                                <select required name="currency" class="form-control">
                                                    
                                                    <option  value="EGP">EGP</option>
                                                    <option  value="USD">USD</option>
                                                </select>  
                                                <br>          
                                                </div>




                                            <div class="col-lg-12">
                                                <label>Add Tax (Optional)</label>

                                            <div class="row">
                                                <div class="col-lg-6">

                                                <label>Tax Name</label>
                                                <span ><input name="tax_name" type="name" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-6">

                                                    <label>Tax Amount %</label>
                                                    <span ><input name="tax_amount" step="0.01" type="number" class="form-control"><br></span>
                                                            
                                                </div>

                                                            
                                                </div>
                                            </div>
                                            <br>

                                            <div id="room_fileds" class="col-lg-12">
                                                <label id="field_label">@lang('invoices.Invoices_Items')</label>

                                            <div id="field_0" class="row">
                                                <div class="col-lg-3">

                                                <label>@lang('invoices.Item_Name')</label>
                                                <span ><input required name="product_name_[0]" type="name" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3">

                                                    <label id="field_label">@lang('invoices.Item_Price')</label>
                                                    <span ><input required name="product_price_[0]" step="0.01" type="number" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3">

                                                    <label id="field_label">@lang('invoices.Item_Qty')</label>
                                                    <span ><input name="product_qty_[0]" required type="number" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3"><label id="field_label">@lang('invoices.Item_Action')</label><span id="field_type"><input class="form-control remove_product text-left" type="button" onclick="remove_fields(0);" value="@lang('invoices.x_Remove')" /></span></div>

                                                
                                                            
                                                </div>
                                            </div>
                                            <br>


                                            <!--
                                            <div id="container" class="col-lg-4">
                                                <label>Product Name</label>
                                                <input required class="form-control" type="text" name="invoice_product_name" placeholder="Enter Product Name">
                                            </div>
                                            -->

                                            <div class="col-lg-12">
                                                <br>
                                                <button type="submit" class="btn btn-success pull-right">@lang('invoices.Create_Invoice')</button>
                                                <button type="button" class="btn btn-info" onclick="add_fields();">@lang('invoices.Add_More')</button>
                                            </div>

                                            
                                        </form>

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
                function myFunction(e) { 
                    if (e.target.value == 0) {
                        document.getElementById('field_label').innerHTML = 'Due Date';
                        document.getElementById("field_type").innerHTML = '<input type="text" name="invoice_due_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker"><span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>';
                    }else{
                        document.getElementById('field_label').innerHTML = 'Installment Duration By Month';
                        document.getElementById("field_type").innerHTML = '<input required name="installment" placeholder="Enter Installment Duration By Month"  type="number" class="form-control">';
                    }
                }
                var room = 0;
                function add_fields() {
                    room++;
                    var objTo = document.getElementById('room_fileds')
                    var divName = document.createElement("div");
                    divName.setAttribute("id", "field_"+room);
                    divName.setAttribute("data-func", "order_item");
                    divName.innerHTML = '<div class="col-lg-3"><label>Item Name </label><span id="field_type"><input required name="product_name_['+room+']" type="name" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Price</label><span id="field_type"><input required name="product_price_['+room+']" step="0.01" type="number" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Qty</label><span id="field_type"><input name="product_qty_['+room+']" required type="number" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Action</label><span id="field_type"><input class="form-control remove_product text-left" type="button" onclick="remove_fields('+room+');" value="x Remove Item" /></span></div>';
                    objTo.appendChild(divName)
                }
                function remove_fields(room)
                {
                    if ( $('[data-func=order_item]').length == 0 )
                    {
                        return;
                    }
                   document.getElementById('field_'+room).remove();
                }
            </script>

@endsection


@section('Scripts')
    <script src="{{ asset('main/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('main/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('main/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('main/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('main/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('main/pages/jquery.form-pickers.init.js') }}"></script>
@endsection
                                           