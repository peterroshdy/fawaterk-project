<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProduct;
use App\Order;
use App\Store;
use App\StoreLanguage;
use Auth;
use App;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       # Code ..
    }

    public function index_page($store, $store_lang)
    {
        //Check store name in our DB
        $store = Store::where('vendor_username', $store)->where('status', 1)->first();
        if ($store) {

            $store_languages = StoreLanguage::all()->where('store_id', $store->id);
            //Get all Products Carts that the Auth user Choose before
            $cart_products = OrderProduct::all()->where('user_id', Auth::id())->where('status', 0)->where('store_id', $store->id);
            App::setlocale($store_lang);
            return view('store/cart/show', compact('cart_products', 'store', 'store_languages', 'store_lang'));

        }else{

            return view('404');
        }
        
    }

    public function getPendingOrders()
    {
       
        //Get all Pending orders
        $pending_orders = Order::all()->where('vendor_id', Auth::id())->where('paid', 1);
        return view('dashboard/vendor/orders/pendingOrders', compact('pending_orders', $pending_orders));
        
    }

    public function getOrderItems($order_id)
    {
        //Make sure that this function works only with vendors
        if (Auth::user()->role_id == 1) {

           //Get all the cart items linked with the same order id
           $order_items = OrderProduct::all()->where('order_id', $order_id)->where('status', 1);
           return view('dashboard/vendor/orders/OrderProducts', compact('order_items', $order_items));
        }
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ##
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check to see if this logged in customer have any unpaid placed orders or not
        //if he does then , get the order id and link it to his cart items
        //if he doesn't then create one and link it to his cart items
        $order_check = Order::where('customer_id', Auth::id())->where('paid', 0)->where('vendor_id', $request->vendor_id)->first();
        if ($order_check) {
            $order_id = $order_check->id;
            $cart_products = new OrderProduct;

            //Check if the product user try to add to cart exist before on this user carts
            $check = OrderProduct::where('product_key', $request->product_key)->where('user_id', Auth::id())->where('status', 0)->first();

            //if not , then add this product to a cart 
            if ($check == '') {
                
                $cart_products->order_id         = $order_id;
                $cart_products->product_id      = $request->product_id;
                $cart_products->product_key      = $request->product_key;
                $cart_products->store_id         = $request->store_id;
                $cart_products->user_id          = Auth::id();
                $cart_products->vendor_id        = $request->vendor_id;
                $cart_products->price            = $request->product_price;

                if ($request->product_color) {
                    $cart_products->color_id            = $request->product_color;
                }

                if ($request->product_size) {
                    $cart_products->size_id            = $request->product_size;
                }

                $cart_products->status           = 0;
                $cart_products->quantity         = $request->product_quantity;
                $cart_products->total            = $request->product_price * $request->product_quantity;

                $cart_products->save();
                return redirect('store/'.$request->vendor_username.'/'.$request->store_lang.'/cart');

            //If it exists then just update the quantity and total in the existed cart and 
            }else{
                
                //New Quantity by adding old quantity value to the new value entered by use
                $newQ                   = $check->quantity + $request->product_quantity;

                //New Total by mult new Quantity with product original price
                $newT                   = $newQ * $check->product->price;

                $check->quantity        = $newQ;
                $check->total           = $newT;

                if ($request->product_color) {
                    $check->color_id            = $request->product_color;
                }

                if ($request->product_size) {
                    $check->size_id            = $request->product_size;
                }

                $check->save();
                return redirect('store/'.$request->vendor_username.'/'.$request->store_lang.'/cart');

            }
        }else{
            //Create a new order for this customer
            $order = new Order;

            //Create a new Cart so he can add items
            $cart_products = new OrderProduct;

            $order->customer_id = Auth::id();
            $order->vendor_id = $request->vendor_id;
            $order->store_id = $request->store_id;
            $order->save();
            $last_added_order_ID = Order::orderBy('created_at', 'desc')->first()->id;

            $cart_products->product_id      = $request->product_id;
            $cart_products->order_id         = $last_added_order_ID;
            $cart_products->product_key      = $request->product_key;
            $cart_products->store_id         = $request->store_id;
            $cart_products->user_id          = Auth::id();
            $cart_products->vendor_id        = $request->vendor_id;
            $cart_products->price            = $request->product_price;

            if ($request->product_color) {
                $cart_products->color_id            = $request->product_color;
            }

            if ($request->product_size) {
                $cart_products->size_id            = $request->product_size;
            }


            $cart_products->status           = 0;
            $cart_products->quantity         = $request->product_quantity;
            $cart_products->total            = $request->product_price * $request->product_quantity;

            $cart_products->save();
            return redirect('store/'.$request->vendor_username.'/'.$request->store_lang.'/cart');


        }
        
        
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
    public function update(Request $request, $id)
    {
        $order_item                   = OrderProduct::find($id);
        $order_item->quantity         = $request->product_quantity;
        $order_item->total            = $order_item->product->price * $request->product_quantity;
        
        $order_item->save();
        return redirect('store/'.$request->vendor_username.'/'.$request->store_lang.'/cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        OrderProduct::find($id)->delete();
        return redirect('store/'.$request->vendor_username.'/'.$request->store_lang.'/cart');
    }
}
