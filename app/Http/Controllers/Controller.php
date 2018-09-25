<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Invoice;
use App\Order;
use App\Withdraw;
use App\Customer;
use App\StoreVisit;
use App;
use Auth;
use App\Store;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
    	if (Auth::check()) {
    		$user = User::find(Auth::id());
            $nvoices_count = Invoice::all()->where('vendor_id', Auth::id())->count();
            $withdraw = Withdraw::where('vendor_id', Auth::id())->first();
            $orders_count = Order::all()->where('vendor_id', Auth::id())->where('paid', 1)->count();
            $pending_orders = Order::all()->where('vendor_id', Auth::id())->where('paid', 1);
            $customers = Customer::all()->where('vendor_username', Auth::user()->username);
            $store_visits = StoreVisit::where('vendor_username', Auth::user()->username)->first();

    		if ($user->role_id == 1) {

    			return view('dashboard/vendor/index', compact('nvoices_count', 'withdraw', 'orders_count', 'pending_orders', 'customers', 'store_visits'));

    		}elseif ($user->role_id == 0) {
             
                return view('dashboard/admin/index');

            }else{
                return redirect('customer/home');
            }

		}else{

			return view('auth/login');
		}
    }

    //Not finished yet
    public function profile($store_username)
    {
        $store = Store::where('vendor_username', $store_username)->first();
        if (Auth::check()) {

            
                if ($store != '') {
                    $profile = User::where('id', Auth::id())->first();
                    if ($profile != '') {

                        return view('store/profile/index', compact('profile', $profile, 'store', $store));

                    }else{

                        return view('404');
                    }
                
                }else{

                    return view('404');

                }   
                        
        }else{
            return redirect('/store/'.$store->vendor_username.'/customer/register');
        }

        }

    public function getStore($username)
    {
       
        $store = Store::where('vendor_username', $username)->first();
        if ($store != '') {
            
            $products = Product::where('vendor_username', $username)->where('status', 1)->paginate(16);
            $categories = Category::all();
            return view('store/show', compact('store', $store, 'products', $products, 'categories', $categories));
            
        
        }else{

            return view('404');
            
        }
        
    }

    public function _404()
    {
        return view('404');
    }
}

