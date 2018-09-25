<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Hash;

class VendorController extends Controller
{
    public function index()
    {
    	$profile = User::find(Auth::id());
    	return view('dashboard/vendor/profile/index', compact('profile', $profile));
    }

    public function update_info(Request $request)
    {
    	$user = User::find(Auth::id());
    	$user->name = $request->name;
    	$user->mobile = $request->phone;
    	$user->national_id = $request->national_id;
    	$user->save();
    	Session::flash('message-info-updated', 'Profile updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('vendor/profile');
    }

    public function update_password(Request $request)
    {
    	$user = User::find(Auth::id());

    	$old_password = $request->old_password;

    	if (Hash::check($old_password, $user->password)) {

		  	$user->password = bcrypt($request->new_password);
		  	$user->save();
    		Session::flash('message-password-updated', 'Password updated successfully'); 
	        Session::flash('alert-class', 'alert-success'); 
	        return redirect('vendor/profile');

		}else{

    		Session::flash('message-password-error', 'The password your entered does not match our recordes'); 
	        Session::flash('alert-class', 'alert-danger'); 
	        return redirect('vendor/profile');
    	}
    	


    }

    public function update_bank(Request $request)
    {
    	$user = User::find(Auth::id());
    	$user->bank_name = $request->bank_name;
    	$user->bank_account = $request->bank_account;
    	$user->save();
    	Session::flash('message-bank-updated', 'Bank info updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('vendor/profile');
    }
}
