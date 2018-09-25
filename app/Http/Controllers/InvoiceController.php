<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\InvoiceProduct;
use App\Invoice;
use App\Helpers;
use App\User;
use DateTime;
use Session;
use Auth;
use URL;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($filter)
    {
        if ($filter == 'all') {
            $invoices = Invoice::where('vendor_username', Auth::user()->username)->orderBy('created_at', 'desc')->get();
        }elseif ($filter == 'paid_invoices'){
            $invoices = Invoice::where('vendor_username', Auth::user()->username)->where('type', 0)->orderBy('created_at', 'desc')->get();

        }elseif ($filter == 'installment_invoices') {
            $invoices = Invoice::where('vendor_username', Auth::user()->username)->where('type', 1)->orderBy('created_at', 'desc')->get();
        }else{
            $filter = 'all';
            $invoices = Invoice::where('vendor_username', Auth::user()->username)->orderBy('created_at', 'desc')->get();
        }
        
        return view('dashboard/vendor/invoices/index', compact('invoices', 'filter'));
        
    }

    public function getPaid()
    {
        $paid_invoices = Invoice::all()->where('vendor_username', Auth::user()->username)->where('paid', 1);
        return view('dashboard/vendor/invoices/paid', compact('paid_invoices', $paid_invoices));
    }

    public function getUnpaid()
    {
        $unpaid_invoices = Invoice::all()->where('vendor_username', Auth::user()->username)->where('paid', 0);
        return view('dashboard/vendor/invoices/unpaid', compact('unpaid_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->where('vendor_username', Auth::user()->username);
        if ($customers->first()) {
            return view('dashboard/vendor/invoices/add', compact('customers'));
        }else{

            Session::flash('add-customer-first', "You don't have any customers yet, Add customer to create you invoice");
            return redirect('vendor/customer/emailcheck');
        }
        
    }

    public function order_invoice($username, $key)
    {
        # code...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Get the name of the input field for the name and the price and Qty fields
        $names_arr = $request->product_name_;
        $prices_arr = $request->product_price_;
        $qtys_arr = $request->product_qty_;

        //Check if the vendor didn't add products
        if ($names_arr) {

            if ($request->invoice_type == 0) {

                //Unique Key
                // Available alpha caracters
                $charactersBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersSmall = 'abcdefghijklmnopqrstuvwxyz';
                $unique_key = str_shuffle(mt_rand(1000000, 9999999). mt_rand(1000000, 9999999) . Auth::id() . $request->customer_id . $charactersBig[rand(0, strlen($charactersBig) - 1)] . $charactersSmall[rand(0, strlen($charactersSmall) - 1)]). strval(time());

                //Add the products to the invoice_products table first so you can get the total
                for ($i=0; $i <= sizeof($names_arr); $i++) { 
                    //For each product (Name, Price, Qty) create a new InvoiceProduct
                    if(isset($names_arr[$i])){
                        $invoice_producs = new InvoiceProduct;
                        $invoice_producs->invoice_key = $unique_key;
                        $invoice_producs->product_name = $names_arr[$i];
                        $invoice_producs->product_price = $prices_arr[$i];
                        $invoice_producs->product_quantity = $qtys_arr[$i];
                        $invoice_producs->total = $prices_arr[$i] * $qtys_arr[$i];
                        $invoice_producs->save();
                    }
                    
                }

                //Check if there is taxes on invoice
                if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                    
                        $items_total = $request->tax_amount * InvoiceProduct::where('invoice_key', $unique_key)->sum('total') / 100 + InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                        
                        
                }else{
                        $items_total = InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                        
                    }
                
                    
                    //Create a new invoice first
                    //to get an Invoice ID to link it with the invoice_products table
                    $invoice = new Invoice;
                    $invoice->invoice_key = $unique_key;
                    $invoice->vendor_id = Auth::id();
                    $invoice->vendor_username = Auth::user()->username;
                    $invoice->user_id = $request->customer_id;
                    $invoice->due_date = date('Y-m-d',strtotime($request->invoice_due_date));
                    $invoice->type = $request->invoice_type;

                    //Check if there is taxes
                    if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                        $invoice->tax_name = $request->tax_name;
                        $invoice->tax_amount = $request->tax_amount;
                        
                    }

                    $invoice->currency = $request->currency;
                    $invoice->total = $items_total;
                    $invoice->save();

                
                
            }else{

                //Unique Key
                // Available alpha caracters
                $charactersBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersSmall = 'abcdefghijklmnopqrstuvwxyz';
                $unique_key = str_shuffle(mt_rand(1000000, 9999999). mt_rand(1000000, 9999999) . Auth::id() . $request->customer_id . $charactersBig[rand(0, strlen($charactersBig) - 1)] . $charactersSmall[rand(0, strlen($charactersSmall) - 1)]). strval(time());

                //Add the products to the invoice_products table first so you can get the total
                for ($i=0; $i <= sizeof($names_arr); $i++) { 
                    //For each product (Name, Price, Qty) create a new InvoiceProduct
                    if(isset($names_arr[$i])){
                        $invoice_producs = new InvoiceProduct;
                        $invoice_producs->invoice_key = $unique_key;
                        $invoice_producs->product_name = $names_arr[$i];
                        $invoice_producs->product_price = $prices_arr[$i];
                        $invoice_producs->product_quantity = $qtys_arr[$i];
                        $invoice_producs->total = $prices_arr[$i] * $qtys_arr[$i];
                        $invoice_producs->save();
                    }
                    
                }

                //Check if there is taxes on invoice
                if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                    
                        $items_total = $request->tax_amount * InvoiceProduct::where('invoice_key', $unique_key)->sum('total') / 100 + InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                        
                        
                    }else{
                        $items_total = InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                        
                    }
                
              

                $period = $request->installment;
                $date = date('Y-m-d');

                for ($i=0; $i < $period ; $i++) { 
                    
                    //Create a new invoice first
                    //to get an Invoice ID to link it with the invoice_products table
                    $invoice = new Invoice;
                    $invoice->invoice_key = $unique_key;
                    $invoice->vendor_id = Auth::id();
                    $invoice->vendor_username = Auth::user()->username;
                    $invoice->user_id = $request->customer_id;
                    $invoice->due_date = date('Y-m-d',strtotime($date.'+'.$i.'month'));
                    $invoice->type = $request->invoice_type;

                    //Check if there is taxes
                    if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                        $invoice->tax_name = $request->tax_name;
                        $invoice->tax_amount = $request->tax_amount;
                        
                    }

                    $invoice->currency = $request->currency;

                    //Invoice payment for one month
                    $payment_per_month = number_format($items_total/$period, 2, '.', '');

                    $invoice->total = $payment_per_month;
                    $invoice->save();

                }

                
        }

        return redirect('vendor/invoices/filterBy/all');


    }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $key)
    {
        $invoice = Invoice::all()->where('invoice_key', $key)->where('id', $id)->first();

        if ($invoice) {
            $invoice_producs = InvoiceProduct::all()->where('invoice_key', $key);
            return view('dashboard/vendor/invoices/show', compact('invoice', 'invoice_producs'));
        }else{
            return view('404');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {

        $invoice = Invoice::all()->where('invoice_key', $key)->first();

        //To get Duration By month
        $count = Invoice::all()->where('invoice_key', $key)->count();

        if ($invoice == '' || $invoice->locked == 1) {

              return view('404');
             
        }else{

            $invoice_products = InvoiceProduct::all()->where('invoice_key', $key);
            $customers = Customer::all()->where('vendor_id', Auth::id());
            return view('dashboard/vendor/invoices/edit', compact('invoice', 'invoice_products', 'customers', 'count'));
        }
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $key)
    {
            if ($request->invoice_type == 0) {

            

            //Get all the edited and non-edited items from the request
            $old_products_names_arr = $request->item_name_;
            $old_products_prices_arr = $request->item_price_;
            $old_products_qtys_arr = $request->item_qty_;
            //Get all the new added items from the request if there any
            $new_products_names_arr = $request->product_name_;
            $new_products_prices_arr = $request->product_price_;
            $new_products_qtys_arr = $request->product_qty_;

            if ($old_products_names_arr || $new_products_names_arr) {

                //Get the invoice by ID
                $invoice = Invoice::find($id);
                $invoice_products = InvoiceProduct::all()->where('invoice_key', $key);
                
                if ($old_products_names_arr) {
                //Loop through the all the invoice item and update the values
                foreach ($invoice_products as $product) {
                        //For each product (Name, Price, Qty) update it with the items from the request
                        if(isset($old_products_names_arr[$product->id])){
                            $product->product_name = $old_products_names_arr[$product->id];
                            $product->product_price = $old_products_prices_arr[$product->id];
                            $product->product_quantity = $old_products_qtys_arr[$product->id];
                            $product->total = $old_products_prices_arr[$product->id] * $old_products_qtys_arr[$product->id];
                            $product->save();
                        }else{
                            InvoiceProduct::find($product->id)->delete();
                        }
                    } 
                }else{
                    InvoiceProduct::where('invoice_key', $key)->delete();
                }
            
                
                if ($new_products_names_arr) {
                    for ($i=0; $i <= sizeof($new_products_names_arr); $i++) { 
                        //For each product (Name, Price, Qty) create a new InvoiceProduct
                        if(isset($new_products_names_arr[$i])){
                            $invoice_producs = new InvoiceProduct;
                            $invoice_producs->invoice_key = $key;
                            $invoice_producs->product_name = $new_products_names_arr[$i];
                            $invoice_producs->product_price = $new_products_prices_arr[$i];
                            $invoice_producs->product_quantity = $new_products_qtys_arr[$i];
                            $invoice_producs->total = $new_products_prices_arr[$i] * $new_products_qtys_arr[$i];
                            $invoice_producs->save();
                        }  
                    }
                }
                
                
                $invoice->due_date = $request->invoice_due_date;
                
                //Check if there is taxes
                if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                    $invoice->tax_name = $request->tax_name;
                    $invoice->tax_amount = $request->tax_amount;
                                
                }
                
                $invoice->currency = $request->currency;
                $invoice->user_id       = $request->customer_id;
                $invoice->total              = 0;
                $invoice->save();
                //Add the total price of every product to the invoice
                //so we can get in the invoice table the total price of all the products
                //Check if there is taxes on invoice
                if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                            
                    $invoices_total = $request->tax_amount * InvoiceProduct::where('invoice_key', $key)->sum('total') / 100 + InvoiceProduct::where('invoice_key', $key)->sum('total');
                                
                                
                }else{
                    $invoices_total = InvoiceProduct::where('invoice_key', $key)->sum('total');
                                
                }

                $invoice = Invoice::find($id);
                $invoice->total = $invoices_total;
                $invoice->save(); 

                Session::flash('message-updated', 'Successfully Updated Invoice');
                return redirect('vendor/invoices/filterBy/all');

            }else{

                    Invoice::where('invoice_key', $key)->delete();
                    InvoiceProduct::where('invoice_key', $key)->delete();
                    Session::flash('message-invoice-removed', 'Invoice Removed');
                    return redirect('vendor/invoices/filterBy/all');
            }
            

            }else{
                
                //Get all the edited and non-edited items from the request
                $old_products_names_arr = $request->item_name_;
                $old_products_prices_arr = $request->item_price_;
                $old_products_qtys_arr = $request->item_qty_;
                //Get all the new added items from the request if there any
                $new_products_names_arr = $request->product_name_;
                $new_products_prices_arr = $request->product_price_;
                $new_products_qtys_arr = $request->product_qty_;

                if ($old_products_names_arr || $new_products_names_arr) {

                    //Get the invoice by ID
                    Invoice::where('invoice_key', $key)->delete();
                    $invoice_products = InvoiceProduct::all()->where('invoice_key', $key);

                    //Unique Key
                    // Available alpha caracters
                    $charactersBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersSmall = 'abcdefghijklmnopqrstuvwxyz';
                    $unique_key = str_shuffle(mt_rand(1000000, 9999999). mt_rand(1000000, 9999999) . Auth::id() . $request->customer_id . $charactersBig[rand(0, strlen($charactersBig) - 1)] . $charactersSmall[rand(0, strlen($charactersSmall) - 1)]). strval(time());

                    if ($old_products_names_arr) {
                    //Loop through the all the invoice item and update the values
                    foreach ($invoice_products as $product) {
                            //For each product (Name, Price, Qty) update it with the items from the request
                            if(isset($old_products_names_arr[$product->id])){

                                $product->invoice_key = $unique_key;
                                $product->product_name = $old_products_names_arr[$product->id];
                                $product->product_price = $old_products_prices_arr[$product->id];
                                $product->product_quantity = $old_products_qtys_arr[$product->id];
                                $product->total = $old_products_prices_arr[$product->id] * $old_products_qtys_arr[$product->id];
                                $product->save();
                            }else{
                                InvoiceProduct::find($product->id)->delete();
                            }
                        } 
                    }else{
                        InvoiceProduct::where('invoice_key', $key)->delete();
                    }

                    if ($new_products_names_arr) {
                        
                        //Add the products to the invoice_products table first so you can get the total
                        for ($i=0; $i <= sizeof($new_products_names_arr); $i++) { 
                            //For each product (Name, Price, Qty) create a new InvoiceProduct
                            if(isset($new_products_names_arr[$i])){
                                $invoice_producs = new InvoiceProduct;
                                $invoice_producs->invoice_key = $unique_key;
                                $invoice_producs->product_name = $new_products_names_arr[$i];
                                $invoice_producs->product_price = $new_products_prices_arr[$i];
                                $invoice_producs->product_quantity = $new_products_qtys_arr[$i];
                                $invoice_producs->total = $new_products_prices_arr[$i] * $new_products_qtys_arr[$i];
                                $invoice_producs->save();
                            }
                            
                        }
                    }

                    //Check if there is taxes on invoice
                    if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                        
                            $items_total = $request->tax_amount * InvoiceProduct::where('invoice_key', $unique_key)->sum('total') / 100 + InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                            
                            
                        }else{
                            $items_total = InvoiceProduct::where('invoice_key', $unique_key)->sum('total');
                            
                        }
                    
                  

                    $period = $request->installment;
                    $date = date('Y-m-d');

                    for ($i=0; $i < $period ; $i++) { 
                        
                        //Create a new invoice first
                        //to get an Invoice ID to link it with the invoice_products table
                        $invoice = new Invoice;
                        $invoice->invoice_key = $unique_key;
                        $invoice->vendor_id = Auth::id();
                        $invoice->vendor_username = Auth::user()->username;
                        $invoice->user_id = $request->customer_id;
                        $invoice->due_date = date('Y-m-d',strtotime($date.'+'.$i.'month'));
                        $invoice->type = $request->invoice_type;

                        //Check if there is taxes
                        if ($request->tax_name && $request->tax_amount && $request->tax_amount != 0) {
                            $invoice->tax_name = $request->tax_name;
                            $invoice->tax_amount = $request->tax_amount;
                            
                        }

                        $invoice->currency = $request->currency;

                        //Invoice payment for one month
                        $payment_per_month = number_format($items_total/$period, 2, '.', '');

                        $invoice->total = $payment_per_month;
                        $invoice->save();

                    }

                    Session::flash('message-updated', 'Successfully Updated Invoice');
                    return redirect('vendor/invoices/filterBy/all');
                    
                }else{

                    Invoice::where('invoice_key', $key)->delete();
                    InvoiceProduct::where('invoice_key', $key)->delete();
                    Session::flash('message-invoice-removed', 'Invoice Removed');
                    return redirect('vendor/invoices/filterBy/all');

                }

                
            }

            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $key, $type)
    {
        if ($type == 0) {
            $invoice = Invoice::find($id);

            if ($invoice) {
                
                if ($invoice->paid == 0) {

                Invoice::find($id)->delete();
                InvoiceProduct::where('invoice_key', $key)->delete();
                Session::flash('message-delete', 'Successfully Removed Invoice');
                return redirect('vendor/invoices/filterBy/all');
                
                }else{
                    Session::flash('message-delete-error', "Can't be removed already been paid");
                    return redirect('vendor/invoices/filterBy/all');
                }

            }else{
                return redirect('vendor/invoices/filterBy/all');
            }

            }else{
                    Invoice::where('invoice_key', $key)->delete();
                    InvoiceProduct::where('invoice_key', $key)->delete();
                    Session::flash('message-delete', 'Successfully Removed Invoices');
                    return redirect('vendor/invoices/filterBy/all');
                }
        
        }

    public function payInvoice(Request $request, $id ,$key)
    {
        // 1 => Credit Card
        // 2 => Cash
        if ($request->payment_method == 1) {
            return view('soon', compact('key', 'id'));
        }else{
            if ($request->user_id == $request->vendor_id) {
                Session::flash('message-vendor-pay', "Invoice can't be paid through the vendor");
                return redirect('invoice/'.$id.'/'.$key.'');
            }else{
                //here code
                $invoice = Invoice::find($id);
                Invoice::where('invoice_key', $key)->update(['locked' => 1]);
                $invoice->paid = 1;
                $invoice->save();
                Session::flash('message-payment-done', "Invoice has been paid successfully");
                return redirect('invoice/'.$id.'/'.$key.'');
            }
        }
    }
}
