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
                                <h4 class="page-title">Edit Invoice</h4>
                                <p class="text-muted page-title-alt">You can edit invoice from here</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- col -->
                            
                            <div class="col-lg-12">
                                <div class="card-box">
                                   
                                    <h4 class="text-dark header-title m-t-0">Edit Invoice</h4>
                                    <div class="table-responsive">
                                    @if(Session::has('message-no-products-added'))
                                    <p class="alert alert-danger">{{ Session::get('message-no-products-added') }}</p>
                                    @endif
                                        
                                        <form  method="POST" action="{{ url('vendor/invoice/'.$invoice->id.'/'.$invoice->invoice_key.'') }}">
                                        {{ csrf_field() }}


                                        
                                            <div class="col-lg-12">
                                                <label for="customer_name">Choose Customer</label>
                                                <select required name="customer_id"  type="name" class="form-control">
                                                    

                                                    @if($invoice->user)
                                                    <option value="{{ $invoice->user_id }}">{{ $invoice->user->name }}</option>
                                                    @else
                                                    <option value="{{ $invoice->user_id }}">{{ $invoice->customer->name }}</option>
                                                    @endif
                                                    
                                                    @foreach($customers as $customer)
                                                    <option  value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                                
                                           <input type="hidden" value="{{ $invoice->type }}" name="invoice_type">

                                            <br>
                                            <div class="col-lg-12">
                                                @if($invoice->type == 1)

                                                    <label id="field_label">Duration</label>
                                                    <span id="field_type"><input value="{{ $count }}" required name="installment" type="number" class="form-control"></span>
                                                    <br>
                                                    @else
                                                    <?php
                                                    $date= new DateTime($invoice->due_date) ;  
                                                    ?>
                                                    <label id="field_label">Due Date</label>
                                                    <span id="field_type"><input value="{{ $date->format('Y-m-d') }}" required name="invoice_due_date" type="date" class="form-control"></span>
                                                    <br>

                                                @endif
                                               
                                                        
                                            </div>  

                                             <div class="col-lg-12">

                                                <label>Invoice Currency</label>
                                                <select required name="currency" class="form-control">
                                                    
                                                    @if($invoice->currency == 'EGP')
                                                    <option  value="EGP">EGP</option>
                                                    <option  value="USD">USD</option>
                                                    @else
                                                    <option  value="USD">USD</option>
                                                    <option  value="EGP">EGP</option>   
                                                    @endif
                                                    
                                                </select>  
                                                <br>          
                                                </div>




                                            <div class="col-lg-12">
                                                <label>Add Tax (Optional)</label>

                                            <div class="row">
                                                <div class="col-lg-6">

                                                <label>Tax Name</label>
                                                <span ><input value="{{ $invoice->tax_name }}" name="tax_name" type="name" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-6">

                                                    <label>Tax Amount %</label>
                                                    <span ><input value="{{ $invoice->tax_amount }}" name="tax_amount" step="0.01" type="number" class="form-control"><br></span>
                                                            
                                                </div>

                                                            
                                                </div>
                                            </div>
                                            <br>
                                  
                                            <div id="room_fileds" class="col-lg-12">

                                                <label id="field_label">Invoices Items</label>
                                                <input class="add_product" type="button" id="more_fields" onclick="add_fields();" value="Add More Item + " />
                                                <br>

                                            @foreach($invoice_products as $product)
                                            <div id="field_{{$product->id}}">
                                                <div class="col-lg-3">

                                                <label>Item Name </label>
                                                <span id="field_type"><input required name="item_name_[{{ $product->id }}]" value="{{ $product->product_name }}" type="name" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3">

                                                    <label id="field_label">Item Price</label>
                                                    <span id="field_type"><input value="{{ $product->product_price }}" required name="item_price_[{{ $product->id }}]" step="0.01" type="number" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3">

                                                    <label id="field_label">Item Qty</label>
                                                    <span id="field_type"><input required type="number" value="{{ $product->product_quantity }}" name="item_qty_[{{ $product->id }}]" class="form-control"></span>
                                                            
                                                </div>

                                                <div class="col-lg-3"><label id="field_label">Item Action</label><span id="field_type"><input class="form-control remove_product text-left" type="button" onclick="remove_fields({{ $product->id }});" value="x Remove Item" /></span></div>

                                                
                                                            
                                            </div>
                                            @endforeach
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
                                                <button type="submit" class="btn btn-primary">Update Invoice</button>
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
                        document.getElementById("field_type").innerHTML = '<input required name="invoice_due_date" type="date" class="form-control">';
                    }else{
                        document.getElementById('field_label').innerHTML = 'Installment Duration By Month';
                        document.getElementById("field_type").innerHTML = '<input required name="installment" step="0.01" placeholder="Enter Installment Duration By Month"  type="number" class="form-control">';
                    }
                }
                var room = 0;
                function add_fields() {
                    
                    var objTo = document.getElementById('room_fileds')
                    var divName = document.createElement("div");
                    divName.setAttribute("id", "field_"+room);
                    divName.innerHTML = '<div class="col-lg-3"><label>Item Name </label><span id="field_type"><input required name="product_name_['+room+']" type="name" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Price</label><span id="field_type"><input required name="product_price_['+room+']" step="0.01" type="number" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Qty</label><span id="field_type"><input name="product_qty_['+room+']" required type="number" class="form-control"></span></div><div class="col-lg-3"><label id="field_label">Item Action</label><span id="field_type"><input class="form-control remove_product text-left" type="button" onclick="remove_fields('+room+');" value="x Remove Item" /></span></div>';
                    objTo.appendChild(divName)
                    room++;
                }
                function remove_fields(room) {
                   document.getElementById('field_'+room).remove();
                }
            </script>

@endsection
