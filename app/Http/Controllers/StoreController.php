<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Product;
use App\Category;
use App\Language;
use App\StoreLanguage;
use App\StoreVisit;
use App\Order;
use Auth;
use Config;
use Session;
use App;
use Validator;
use Illuminate\Support\Facades\Input;


class StoreController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    //Redirect to the store based on the store language
    public function getStore($username)
    {
        $store = Store::where('vendor_username', $username)->where('status', 1)->first();
        if ($store) {

            $store_languages = StoreLanguage::all()->where('store_id', $store->id);
            if( count( $store_languages ) > 1){
                return redirect('store/'.$username.'/en');
            }else{

                foreach($store_languages as $lang){

                    if($lang->lang == 'en'){

                        return redirect('store/'.$username.'/en');
                        
                    }else{

                        return redirect('store/'.$username.'/ar');
                    
                    }
                }
            }
            
        }else{
            return redirect('/');
        }
    }   



    public function create()
    {
        //Make sure user is logged in
        if (Auth::check()) {

            //Query to see if the This user ID is linked to any store in the DB
            $vendorHasStore = Store::where('vendor_id', Auth::id())->first();

            //Get Available Languages
            $languages = Language::all();

            //If Not , Then Let's redirect this user to create his first store
            if ($vendorHasStore == '') {
                return view('store/create', compact('languages'));

            //If Yes , Then Let's get this user Store ID and redirect him to it
            }else{
                return redirect('store/'.$vendorHasStore->vendor_username.'');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $store                  = new Store;
        $store->vendor_username = Auth::user()->username;
        $store->vendor_id       = Auth::id();
        $store->store_name      = $request->store_name;
        $store->store_desc      = $request->store_desc;
        $store->shipping_fees   = $request->store_shipping_fees;


        //Check if image has value
        if ($request->store_logo) {

            $image = $request->file('store_logo');
            $size= $request->file('store_logo')->getClientSize();
            if ($size < 200000) {
                $input['store_logo'] = pathinfo($_FILES['store_logo']['name'], PATHINFO_FILENAME).'.'. Auth::id() . Auth::user()->username .'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/clients/vendors/logos');
                $image->move($destinationPath, $input['store_logo']);
                $store->logo = $input['store_logo'];
            }else{
                Session::flash('message-image-big', 'The uploaded image is too big, MAX:2M'); 
                return redirect('vendor/store/create');
            }
            
            
        }

        $store->save();
        $last_added_store_ID = Store::orderBy('created_at', 'desc')->first()->id;

        $languages = $request->languages;
        if ($languages != '') {

            foreach ($languages as $language) {

                $lang = new StoreLanguage;
                $lang->store_id = $last_added_store_ID;
                $lang->lang = $language;
                $lang->save();
                
            }
        }else{

                $lang = new StoreLanguage;
                $lang->store_id = $last_added_store_ID;
                $lang->lang = 'en';
                $lang->save();
        }

        
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($username, $store_lang)
    {
        //================================
        $products = Product::where('vendor_username', $username)->where('status', 1)->where('lang', $store_lang)->orderBy('created_at', 'desc')->paginate(16);

        if ($products->first()) {
            $store = Store::where('vendor_username', $username)->where('status', 1)->first();
            if ($store) {
                $store_languages = StoreLanguage::all()->where('store_id', $store->id);
                $order = Order::where('customer_id', Auth::id())->where('vendor_id', $store->vendor_id)->where('store_id', $store->id)->where('paid', 0)->where('total', '>' ,0)->first();
                $categories = Category::all()->where('store_id', $store->id);
                $store_visits = StoreVisit::where('vendor_username', $username)->first();
                if ($store_visits != '') {

                    $store_visits->visits = $store_visits->visits + 1;
                    $store_visits->save();

                }else{

                    $store_visits = new StoreVisit;
                    $store_visits->vendor_username = $username;
                    $store_visits->visits = 1;
                    $store_visits->save();
                }
                App::setlocale($store_lang);
                return view('store/show', compact('store', 'products', 'categories', 'store_languages', 'store_lang', 'order'));
                
            
            }else{

                return view('404');
                
            }
        }else{
            return view('store_empty');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $store = Store::where('vendor_username', Auth::user()->username)->first();
        if ($store != '') {
            $categories = Category::all()->where('store_id', $store->id);
            return view('dashboard/vendor/store/settings', compact('store', 'categories'));
        }else{
            return redirect('/');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_info(Request $request)
    {
        $store = Store::find($request->store_id);
        $store->store_name = $request->store_name;
        $store->store_desc = $request->store_desc;
        $store->shipping_fees = $request->store_fees;
        $store->status = $store->status;

        //Check if store logo has changed
        if ($request->store_logo) {

            $image = $request->file('store_logo');
            $size= $request->file('store_logo')->getClientSize();
            
            if ($size < 200000) {
                $input['store_logo'] = pathinfo($_FILES['store_logo']['name'], PATHINFO_FILENAME).'.'. Auth::id() . Auth::user()->username .'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/clients/vendors/logos');
                $image->move($destinationPath, $input['store_logo']);
                $store->logo = $input['store_logo'];
            }else{
                Session::flash('message-image-big', 'The uploaded image is too big, MAX:2M'); 
                return redirect('vendor/store/settings');
            }
        }

        $store->save();
        Session::flash('message-store-info-updated', 'Store info updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('vendor/store/settings');
    }

    public function update_tax(Request $request)
    {
        $store = Store::find($request->store_id);

        $store->tax_name_1 = $request->tax_name_1;
        $store->tax_amount_1 = $request->tax_amount_1;

        $store->tax_name_2 = $request->tax_name_2;
        $store->tax_amount_2 = $request->tax_amount_2;

        $store->save();
        Session::flash('message-store-tax-updated', 'Store taxes updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('vendor/store/settings');
    }

    public function storeStatus(Request $request, $id)
    {
        $store = Store::find($id);
        $store->status = $request->status;
        $store->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchResults(Request $request, $username, $store_lang)
    {
        $store = Store::where('vendor_username', $username)->where('status', 1)->first();
        if ($store) {
            $products = Product::where('store_id', $store->id)->where('title', 'LIKE', '%' . $request->search_word . '%')->orWhere('body', 'LIKE', '%' . $request->search_word . '%')->get();
            $categories = Category::all()->where('store_id', $store->id);
            App::setlocale($store_lang);
            return view('store/search/search', compact('store_lang', 'store', 'products', 'categories'));
        }else{
            return redirect('/');
        }
        
    }

}
