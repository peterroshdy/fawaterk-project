<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Withdraw;
use App\WithdrawRequest;
use Auth;
use Session;

class WithdrawController extends Model
{
    public function request_withdraw_show()
    {
    	$withdraw = Withdraw::where('vendor_id', Auth::id())->first();
    	return view('dashboard/vendor/withdraws/request', compact('withdraw', $withdraw));
    }

    public function request_withdraw_store(Request $request)
    {
    	
    	$withdraw_amount = $request->withdraw_amount;
    	$available_money = $request->available_money;

    	if ($available_money >= $withdraw_amount) {
    		
    		$withdraw_request = new WithdrawRequest;
    		$withdraw_request->withdraw_id = $request->withdraw_id;
    		$withdraw_request->withdraw_amount = $withdraw_amount;
    		$withdraw_request->status = 0;
    		$withdraw_request->save();
    		return redirect('vendor/request-withdraw');

    	}else{
    		
    		Session::flash('message-withdraw-rejected', 'You do not have this amount of money'); 
	        Session::flash('alert-class', 'alert-danger'); 
	        return redirect('vendor/request-withdraw');
    	}
    	
    }

    public function withdraws_show()
    {
    	$withdraw = Withdraw::where('vendor_id', Auth::id())->first();
        if ($withdraw != '') {

            $withdraw_requests = WithdrawRequest::all()->where('withdraw_id', $withdraw->id);
            return view('dashboard/vendor/withdraws/withdraw_requests', compact('withdraw_requests', $withdraw_requests));
        }else{
            $withdraw_requests = 0;
            return view('dashboard/vendor/withdraws/withdraw_requests', compact('withdraw_requests', $withdraw_requests));
        }
    	
    }

    public function withdraws_approve_or_reject(Request $request)
    {
        
        if ($request->status == 1) {

            $withdraw = Withdraw::find($request->withdraw_id);
            if ($withdraw->total - $request->withdraw_amount >= 0) {

                $withdraw->total = $withdraw->total - $request->withdraw_amount;
                $withdraw->save();
                $withdraw_request = WithdrawRequest::find($request->withdraw_request_id);
                $withdraw_request->status = $request->status;
                $withdraw_request->save();
                Session::flash('message-withdraw-a', 'Withdraw Approved successfully'); 
                Session::flash('alert-class', 'alert-success'); 
                return redirect('/admin/withdraws');

            }else{

                Session::flash('message-cash-less-withdraw', 'Available Cash is less than the withdraw'); 
                Session::flash('alert-class', 'alert-danger'); 
                return redirect('/admin/withdraws');
            }

        }else{

            $withdraw_request = WithdrawRequest::find($request->withdraw_request_id);
            $withdraw_request->status = $request->status;
            $withdraw_request->save();

            Session::flash('message-withdraw-r', 'Withdraw Rejected successfully'); 
            Session::flash('alert-class', 'alert-success'); 
            return redirect('/admin/withdraws');
        }
    }
}
