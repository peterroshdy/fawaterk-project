<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use App\Store;
use App\Order;
use App\OrderProduct;
use App\Withdraw;
use Auth;
use URL;
use Session;


class CheckoutController extends Controller
{


	//Start Here
	public function checkout_info(Request $request, $store_username)
	{
		
		$store = Store::where('vendor_username', $store_username)->where('status', 1)->first();
		if ($store) {

			$total = $request->cart_total;
			return view('store/cart/checkout', compact('store', $store, 'total', $total));
			
		}else{
			return view('404');
		}
		
	}

	public function buy(Request $request, $store_username)
	{
		//Search for the order info for the specific user
		//Fill the Address and phone and shipping method sections in the table
		//change the paid from 0 to 1 which mean the order is purchesed
		//Change the status in order_products table form 0 to 1 which means the items has been ordered
		$order = Order::where('customer_id', Auth::id())->where('paid', 0)->where('vendor_id', $request->vendor_id)->first();
		$store = Store::where('vendor_id', $request->vendor_id)->where('vendor_username', $store_username)->where('status', 1)->first();
		if ($store) {
			
			$order->shipping_address = $request->shipping_address;
			$order->phone = $request->phone_number;
			$order->total = $request->total;

			//Unique Key
	        $charactersBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	        $charactersSmall = 'abcdefghijklmnopqrstuvwxyz';

	        $unique_key = str_shuffle(mt_rand(1000000, 9999999). mt_rand(1000000, 9999999) . Auth::id() . $request->vendor_id . $charactersBig[rand(0, strlen($charactersBig) - 1)] . $charactersSmall[rand(0, strlen($charactersSmall) - 1)]). strval(time());
	            
	        // Create a basic QR code
	        $QR_url = URL::to('store/'.$store_username.'/order/'.$order->id.'/order_invoice/'.$unique_key);
	        $order->invoice_key            = $unique_key;
	        $order->qrcode_link           = $QR_url;
			$order->save();

			$cart_items = OrderProduct::where('user_id', Auth::id())->where('status', 0)->where('vendor_id', $request->vendor_id)->update(['status' => 1]);
			return redirect('/store/'.$store_username.'/order/'.$order->id.'/order_invoice/'.$unique_key.'');

		}else{
			return view('404');
		}
	}

	public function payment_method(Request $request, $username, $order_id)
	{
		$order = Order::find($order_id);
		$order_products = OrderProduct::where('order_id', $order_id)->get();

		foreach ($order_products as $product) {
			$product->product->stock = $product->product->stock - 1;
			$product->product->save(); 
		}

		if ($request->payment_method == 'Credit Card') {
			
			$order->payment_method = $request->payment_method;
			//add the money to withdraw table under the vendor ID, and if there is no row for him create one
			$withdraw = Withdraw::where('vendor_username', $username)->first();

			if ($withdraw) {

				$order->paid = 1;
				$order->total = $request->total;
				$withdraw->total = $withdraw->total + $request->total;
				$withdraw->save();
				$order->save();
				Session::flash('message-order-success', 'Order placed successfully ');
        		return redirect('/store/'.$username.'/order/'.$order->id.'/order_invoice/'.$order->invoice_key.'');

			}else{

				$order->paid = 1;
				$order->total = $request->total;
				$newWithdraw = new Withdraw;
				$newWithdraw->vendor_id = $request->vendor_id;
				$newWithdraw->vendor_username = $username;
				$newWithdraw->total = $request->total;
				$newWithdraw->save();
				$order->save();
				Session::flash('message-order-success', 'Order placed successfully ');
        		return redirect('/store/'.$username.'/order/'.$order->id.'/order_invoice/'.$order->invoice_key.'');
			}
		}else{

			$order->payment_method = $request->payment_method;
			$order->paid = 1;
			$order->save();
			Session::flash('message-order-success', 'Order placed successfully ');
        		return redirect('/store/'.$username.'/order/'.$order->id.'/order_invoice/'.$order->invoice_key.'');
		}
	}

	public function order_invoice($username, $order_id, $key)
	{
		$store = Store::where('vendor_username', $username)->where('status', 1)->first(); 

		if ($store != '') {
			
			$order = Order::where('customer_id', Auth::id())->where('vendor_id', $store->vendor_id)->where('store_id', $store->id)->where('invoice_key', $key)->first();
				if ($order != '') {
					
					$cart_items = OrderProduct::all()->where('order_id', $order_id);
					$items_sum = OrderProduct::where('order_id', $order_id)->sum('total');
					if ($cart_items->first() != '') {
						return view('store/cart/order_invoice', compact('store', 'order', 'cart_items', 'items_sum'));
					}else{
						return view('404');
					}
					

				}else{
					return view('404');
				}

		}else{
			return view('404');
		}
		
		
	}

	public function cancel_order($store_username, $lang, $user_id, $order_id)
	{
		if ($user_id == Auth::id()) {
			
			$order = Order::find($order_id);
			if ($order->paid == 0) {
				$order->delete();
				OrderProduct::where('order_id', $order_id)->delete();
				return redirect('store/'.$store_username.'/'.$lang.'');

			}else{
				return redirect()->back();
			}
		}else{
				return redirect()->back();
			}
	}

}