<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use Auth;
use App\Helpers;
use Session; 
use App\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomers()
    {
        $customers = Customer::all()->where('vendor_username', Auth::user()->username);
        return view('dashboard/vendor/customers/index', compact('customers', $customers));
    }

    public function getEmailCheck()
    {
        return view('dashboard/vendor/customers/checkemail');
    }

    public function setEmailCheck(Request $request)
    {
        $customer_email = $request->customer_email;

        //Search for this customer email in our users collection 
        $doesCustomerExistInUsersTable = User::where('email', $customer_email)->first();

        //If you got a result means that the customer exist in the users table , so give the vendor a copy of his info to add it to customers table
        if ($doesCustomerExistInUsersTable != '') {

            Session::flash('message-customer-exists-in-users-table', 'This customer do exist'); 
            return view('dashboard/vendor/customers/ifcustomerexist', compact('doesCustomerExistInUsersTable'));
            
        }

        //If you did not get any results means that the customer do not exist so the vendor can add him to the customers table and , email will be send to him automatically to invite him to reg with us as a vendor
        else{

            //Then now search by email in the customers table to see if that : this customer has been added to the customers table before by this vendor or not
            $doesCustomerExistInCustomersTable = Customer::where('email', $customer_email)->where('vendor_id', Auth::id())->first();

            //If the customer does seem to be added by the vendor then flash warning message
            if ($doesCustomerExistInCustomersTable != '') {

                Session::flash('message-customer-exists-in-customers-table', 'You added this customer before.'); 
                return view('dashboard/vendor/customers/checkemail');

            }

            //If the customer does not seem to be added to the customers table by this vendor before, then finally allow the vendor to add him/her
            else{

                return view('dashboard/vendor/customers/ifcustomerdoesntexist', compact('customer_email'));
            }
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->vendor_id = Auth::id();
        $customer->vendor_username = Auth::user()->username;

        //Check if there customer Id Passed with the request
        //If there one means this user already exist
        //If not means that there is no user in here 
        if($request->customer_id != '') {

            $customer->user_id = $request->customer_id;

        }else{
            
            $customer->user_id = 0;
        }

        $customer->name = $request->customer_name;
        $customer->email = $request->customer_email;
        $customer->phone        = $request->customer_phone;
        $customer->address      = $request->customer_address;
        $customer->save();
        Session::flash('message-added', 'Customer has been added !'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('vendor/customer/emailcheck');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            // store
            $customer               = Customer::find($request->customer_id);
            $customer->name         = $request->customer_name;
            $customer->email        = $request->customer_email;
            $customer->address      = $request->customer_address;
            $customer->phone        = $request->customer_phone;
            $customer->save();

            // redirect
            Session::flash('message-update', 'Successfully Updated Customer!');
            return redirect('vendor/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        Invoice::where('user_id', $id)->where('vendor_id', Auth::id())->delete();

        Session::flash('message-delete', 'Successfully Removed Customer!');
        return redirect('vendor/customers');
    }
}
