<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Lang;
use Hash;
use Session;
use App\StoreLanguage;
use App\Invoice;
use App\Order;
use \Carbon\Carbon;
use App\User;

class GeneralCustomerController extends Controller
{
    public function index()
    {
        $customer = Auth::user();
        $invoices = Invoice::where('user_id', '=', $customer->id)->get();

        $upcoming_invoices = [];

        foreach( $invoices as $invoice )
        {
            $invoice->link = 'invoice/' . $invoice->invoice_key;

            $due = strtotime( $invoice->due_date );

            // check if the due date is in a week
            if ( ! $invoice->paid && ( $due < strtotime('+7 days') ) && ( $due > time() ) )
            {
                $invoice->day = date('d', $due);
                $invoice->month = date('M', $due);
                $invoice->title = 'hehe';

                $upcoming_invoices[] = $invoice;
            }
        }

        return view('Customer.home', compact('customer', 'invoices', 'upcoming_invoices'));
    }

    
    public function invoices()
    {
        $customer = Auth::user();
        $invoices = Invoice::where('user_id', '=', $customer->id)->get();

        $upcoming_invoices = [];

        foreach( $invoices as $invoice )
        {
            $invoice->link = 'invoice/' . $invoice->invoice_key;

            $due = strtotime( $invoice->due_date );

            // check if the due date is in a week
            if ( ! $invoice->paid && ( $due < strtotime('+7 days') ) && ( $due > time() ) )
            {
                $invoice->day = date('d', $due);
                $invoice->month = date('M', $due);
                $invoice->title = 'hehe';

                $upcoming_invoices[] = $invoice;
            }
        }

        return view('Customer.invoices', compact('invoices', 'upcoming_invoices', 'customer'));
    }

    public function paid_invoices()
    {
        $customer = Auth::user();
        $invoices = Invoice::where('user_id', '=', $customer->id)->where('paid', 1)->get();
        return view('Customer.paid_invoices', compact('invoices', 'customer'));
    }

    public function unpaid_invoices()
    {
        $customer = Auth::user();
        $invoices = Invoice::where('user_id', '=', $customer->id)->where('paid', 0)->get();
        return view('Customer.paid_invoices', compact('invoices', 'customer'));
    }

    
    public function edit()
    {
        $customer = Auth::user();

        return view('Customer.edit', compact('customer'));
    }


    public function update( Request $request )
    {
        $customer = User::findOrFail( Auth::id() );

        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'nullable|min:4|max:40|confirmed',
            'phone'         => 'nullable|numeric'
        ]);


        if ( $request->name != $customer->username )
        {
            $check = User::where('username', '=', $request->name)->first();

            if ( ! empty( $check ) )
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'username already exists!');

                return redirect('customer/edit');
            }
        }

        if ( $request->image )
        {
            $image = $request->file('image');

            $path = public_path('market' . DIRECTORY_SEPARATOR. 'images' . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR);
            
            $rand_name = bin2hex( random_bytes(25) ) . '.' . $image->getClientOriginalExtension();
            
            $image->move( $path, $rand_name );

            // Remove old image.
            if ( $customer->image )
            {
                if ( is_file( $path . $customer->image ) )
                {
                    unlink( $path . $customer->image );
                }
            }

            $customer->image = $rand_name;
        }


        if ( $request->old_password )
        {
            $this->validate($request, [
                'password'      => 'required|min:4|max:40|confirmed'
            ]);

            if ( ! Hash::check($request->old_password, $customer->password) )
            {
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Your old password doesnt match!!');

                return redirect('/customer/edit');
            }


            $customer->password = bcrypt($request->password);
        }

        $customer->username = $request->name;
        $customer->mobile = $request->phone;

        $customer->save();

        Session::flash('message', Lang::get('updated_successfully'));

        return redirect('/customer/edit');
    }

    public function getStores()
    {
        $stores = Order::all()->where('customer_id', Auth::id());
        $store_languages = StoreLanguage::all();
        return view('Customer.stores', compact('stores', 'store_languages'));
    }
}
