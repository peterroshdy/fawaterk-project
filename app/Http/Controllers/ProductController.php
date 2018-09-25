<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use App\Color;
use App\Size;
use App\Store;
use App\Category;
use Auth;
use App\OrderProduct;
use App\StoreLanguage;
use App\ProductColor;
use App\ProductSize;
use Session;
use Config;
use App;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function getProducts()
    {
        $products_en = Product::where('vendor_id', Auth::id())->where('status', 1)->where('lang', 'en')->orderBy('created_at', 'desc')->get();
        $products_ar = Product::where('vendor_id', Auth::id())->where('status', 1)->where('lang', 'ar')->orderBy('created_at', 'desc')->get();
        $store = Store::where('vendor_id', Auth::id())->first();
        if ($store) {
            $store_languages = StoreLanguage::all()->where('store_id', $store->id);
            return view('dashboard/vendor/products/index', compact('products_en', 'products_ar' ,'store' ,'store_languages'));
        }else{
            return view('404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::where('vendor_id', Auth::id())->first();
        

        if (Auth::check() && $store != '') {
            
            $categories = Category::all()->where('store_id', $store->id);
            $store_languages = StoreLanguage::all()->where('store_id', $store->id);
            return view('dashboard/vendor/products/create', compact('categories', 'colors', 'sizes', 'store_languages'));

        }else{

            return redirect('/');
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

        if ($request->file('product_main_image') && $request->file('product_main_image')->getClientSize() > 5000000 || $request->file('product_image_2') && $request->file('product_image_2')->getClientSize() > 5000000 || $request->file('product_image_3') && $request->file('product_image_3')->getClientSize() > 5000000 || $request->file('product_image_4') && $request->file('product_image_4')->getClientSize() > 5000000 || $request->file('product_image_5') && $request->file('product_image_5')->getClientSize() > 5000000) {

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
        }

        $this->validate($request, [
            'product_title_en' => 'bail|max:50',
            'product_title_ar' => 'bail|max:50',
            'product_body_en' => 'bail|max:1000',
            'product_body_ar' => 'bail|max:1000',
            'product_price' => 'required|digits_between:1,6',
            'product_stock' => 'required|digits_between:1,6',
        ]);


        $key = uniqueProductKey();
        $store_languages = StoreLanguage::all()->where('store_id', $request->store_id);

        foreach($store_languages as $lang){
            //If the English Language availabe then add english language to it
            if($lang->lang == 'en'){

                $product = new Product;
                $product->key               = $key;
                $product->lang              = 'en';
                $product->title          = $request->product_title_en;
                $product->body          = $request->product_body_en;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->status            = 1;
                $product->vendor_id         = Auth::id();
                $product->vendor_username   = Auth::user()->username;
                $product->store_id          = $request->store_id;
                $product->save();

                $product_colors = $request->product_colors_en;
                $colors = explode(',', $product_colors);

                if ($product_colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $key;
                        $c->lang = 'en';
                        $c->color = $color;
                        $c->save();
                    }
                }

                $product_sizes = $request->product_sizes_en;
                $sizes = explode(',', $product_sizes);

                if ($product_sizes != '') {
                    foreach ($sizes as $size) {
                        $c = new ProductSize;
                        $c->product_key = $key;
                        $c->lang = 'en';
                        $c->size = $size;
                        $c->save();
                    }
                }
            }
            //If the Arabic Language availabe then add arabic language to it
            elseif($lang->lang == 'ar'){

                $product = new Product;
                $product->key               = $key;
                $product->lang              = 'ar';
                $product->title          = $request->product_title_ar;
                $product->body          = $request->product_body_ar;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->status            = 1;
                $product->vendor_id         = Auth::id();
                $product->vendor_username   = Auth::user()->username;
                $product->store_id          = $request->store_id;
                $product->save();

                $product_colors = $request->product_colors_ar;
                $colors = explode(',', $product_colors);

                if ($product_colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $key;
                        $c->lang = 'ar';
                        $c->color = $color;
                        $c->save();
                    }
                }

                $product_sizes = $request->product_sizes_ar;
                $sizes = explode(',', $product_sizes);

                if ($product_sizes != '') {
                    foreach ($sizes as $size) {
                        $c = new ProductSize;
                        $c->product_key = $key;
                        $c->lang = 'ar';
                        $c->size = $size;
                        $c->save();
                    }
                }
            }

        }

        //If store don't have languges , then defualt add the product in english
        if (count($store_languages) == 0) {
            
                $product = new Product;
                $product->key               = $key;
                $product->lang              = 'en';
                $product->title          = $request->product_title_en;
                $product->body          = $request->product_body_en;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->status            = 1;
                $product->vendor_id         = Auth::id();
                $product->vendor_username   = Auth::user()->username;
                $product->store_id          = $request->store_id;
                $product->save();

                $product_colors = $request->product_colors_en;
                $colors = explode(',', $product_colors);

                if ($product_colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $key;
                        $c->lang = 'en';
                        $c->color = $color;
                        $c->save();
                    }
                }

                $product_sizes = $request->product_sizes_en;
                $sizes = explode(',', $product_sizes);

                if ($product_sizes != '') {
                    foreach ($sizes as $size) {
                        $c = new ProductSize;
                        $c->product_key = $key;
                        $c->lang = 'en';
                        $c->size = $size;
                        $c->save();
                    }
                }
        }

        //Check if first image has value
        if ($request->product_main_image) {

            $db_image = new Image;
            $image = $request->file('product_main_image');
            $size= $request->file('product_main_image')->getClientSize();
            
            if ($size < 5000000) {

                 $input['product_main_image'] = pathinfo($_FILES['product_main_image']['name'], PATHINFO_FILENAME).'.'. $key .'-1'.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('clients/vendors/products/');
                $image->move($destinationPath, $input['product_main_image']);
                $db_image->product_key = $key;
                $db_image->image = $input['product_main_image'];
                $db_image->save();

            }else{

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
            }

           
        }

        //Check if second image has value
        if ($request->product_image_2) {

            $db_image = new Image;
            $image = $request->file('product_image_2');
            $size= $request->file('product_image_2')->getClientSize();
            
            if ($size < 5000000) {

                 $input['product_image_2'] = pathinfo($_FILES['product_image_2']['name'], PATHINFO_FILENAME).'.'. $key .'-1'.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('clients/vendors/products/');
                $image->move($destinationPath, $input['product_image_2']);
                $db_image->product_key = $key;
                $db_image->image = $input['product_image_2'];
                $db_image->save();

            }else{

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
            }

           
        }

        //Check if third image has value
        if ($request->product_image_3) {

            $db_image = new Image;
            $image = $request->file('product_image_3');
            $size= $request->file('product_image_3')->getClientSize();
            
            if ($size < 5000000) {

                 $input['product_image_3'] = pathinfo($_FILES['product_image_3']['name'], PATHINFO_FILENAME).'.'. $key .'-1'.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('clients/vendors/products/');
                $image->move($destinationPath, $input['product_image_3']);
                $db_image->product_key = $key;
                $db_image->image = $input['product_image_3'];
                $db_image->save();

            }else{

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
            }

           
        }

        //Check if forth image has value
        if ($request->product_image_4) {

            $db_image = new Image;
            $image = $request->file('product_image_4');
            $size= $request->file('product_image_4')->getClientSize();
            
            if ($size < 5000000) {

                 $input['product_image_4'] = pathinfo($_FILES['product_image_4']['name'], PATHINFO_FILENAME).'.'. $key .'-1'.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('clients/vendors/products/');
                $image->move($destinationPath, $input['product_image_4']);
                $db_image->product_key = $key;
                $db_image->image = $input['product_image_4'];
                $db_image->save();

            }else{

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
            }

           
        }

        //Check if fifth image has value
        if ($request->product_image_5) {

            $db_image = new Image;
            $image = $request->file('product_image_5');
            $size= $request->file('product_image_5')->getClientSize();
            
            if ($size < 5000000) {

                 $input['product_image_5'] = pathinfo($_FILES['product_image_5']['name'], PATHINFO_FILENAME).'.'. $key .'-1'.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('clients/vendors/products/');
                $image->move($destinationPath, $input['product_image_5']);
                $db_image->product_key = $key;
                $db_image->image = $input['product_image_5'];
                $db_image->save();

            }else{

                Session::flash('message-image-big', 'The uploaded image is too big, MAX:5M'); 
                return redirect('vendor/store/'.Auth::user()->username.'/product/create');
            }

           
        }


        Session::flash('message-product-added', 'Product added successfully !'); 
        return redirect('vendor/products');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($store_vendor_username, $store_lang, $key)
    {
        
        //Fetch the Product Info with the specific key
        $product = Product::where('key', $key)->where('lang', $store_lang)->where('status', 1)->first();

        //Check if product not null, If not let's fetch the store info next
        if ($product) {
            
            //Check if product not null, If not let's fetch the store info for the URL
            $store = Store::where('vendor_username', $store_vendor_username)->where('status', 1)->first();

            //Check if store not null, If not let's fetch the categories and last added products
            if ($store) {

                $store_languages = StoreLanguage::all()->where('store_id', $store->id);
                $categories = Category::all()->where('store_id', $store->id);
                $products = Product::all()->where('store_id', $store->id)->where('lang', $store_lang)->where('category_id', $product->category_id)->where('status', 1)->take(4);
                $colors = ProductColor::all()->where('product_key', $key)->where('lang', $store_lang);
                $sizes = ProductSize::all()->where('product_key', $key)->where('lang', $store_lang);
                App::setlocale($store_lang);
                return view('store/product/show', compact('product', 'store', 'categories', 'colors', 'sizes', 'store_languages', 'products', 'store_lang'));
            }else{

                return view('404');

            }
            
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
    public function edit($vendor_username, $product_key)
    {
        $store = Store::where('vendor_id', Auth::id())->where('vendor_username', $vendor_username)->first();
        $lang =  Config::get('app.locale');

        //Fetch the Product Info with the specific key
        $product_en = Product::where('key', $product_key)->where('lang', 'en')->first();
        $product_ar = Product::where('key', $product_key)->where('lang', 'ar')->first();

        $common_product_info = Product::where('key', $product_key)->first();
   

        if (Auth::check() && $store != '') {

            if ($product_en || $product_ar) {
                
                $store_languages = StoreLanguage::all()->where('store_id', $store->id);

                $categories = Category::all()->where('store_id', $store->id);
                
                //Get the Product Colors in english if there any
                $product_colors_en = ProductColor::all()->where('product_key', $product_key)->where('lang', 'en');
                $colorsArrayEN = array();
                foreach ($product_colors_en as $color) {
                    array_push($colorsArrayEN, $color->color);
                }

                $colors_en = implode(',', $colorsArrayEN);


                //Get the Product Colors in english if there any
                $product_colors_ar = ProductColor::all()->where('product_key', $product_key)->where('lang', 'ar');
                $colorsArrayAR = array();
                foreach ($product_colors_ar as $color) {
                    array_push($colorsArrayAR, $color->color);
                }
                
                $colors_ar = implode(',', $colorsArrayAR);


                return view('dashboard/vendor/products/edit', compact('store', 'product_en', 'product_ar', 'colors_en', 'colors_ar', 'categories', 'store_languages', 'common_product_info'));

            }else{
                return redirect('/');
            }

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
    public function update(Request $request, $vendor_username, $product_key)
    {
        $store = Store::where('vendor_id', Auth::id())->where('vendor_username', $vendor_username)->first();
        $store_languages = StoreLanguage::all()->where('store_id', $store->id);

        foreach($store_languages as $lang){
            //If the English Language availabe then add english language to it
            if($lang->lang == 'en'){
                $product = Product::where('key', $product_key)->where('lang', 'en')->first();
                $product->title          = $request->product_title_en;
                $product->body          = $request->product_body_en;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->save();

                
                //Delete existing colors before add new
                ProductColor::where('product_key', $product_key)->where('lang', 'en')->delete();
                $product_colors = $request->product_colors_en;
                $colors = explode(',', $product_colors);

                //Check if there any added colors
                if ($product_colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $product_key;
                        $c->lang = 'en';
                        $c->color = $color;
                        $c->save();
                    }
                }

            }
            //If the Arabic Language availabe then add arabic language to it
            elseif($lang->lang == 'ar'){
                $product = Product::where('key', $product_key)->where('lang', 'ar')->first();
                $product->title          = $request->product_title_ar;
                $product->body          = $request->product_body_ar;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->save();

                
                //Delete existing colors before add new
                ProductColor::where('product_key', $product_key)->where('lang', 'ar')->delete();
                $product_colors = $request->product_colors_ar;
                $colors = explode(',', $product_colors);

                //Check if there any added colors
                if ($product_colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $product_key;
                        $c->lang = 'ar';
                        $c->color = $color;
                        $c->save();
                    }
                }

            }
        }

        return redirect('vendor/products');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vendor_username, $key)
    {
        if (OrderProduct::where('product_key', $key)->where('status', 1)->first() != '') {
            Session::flash('message-product-delete-rejacted', 'Can not remove it, This product is involved in pending orders'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('vendor/products');
        }else{

            Product::where('key', $key)->delete();
            ProductColor::where('product_key', $key)->delete();
            Session::flash('message-product-delete-approved', 'Product Removed Successfully');
            Session::flash('alert-class', 'alert-success'); 
            return redirect('vendor/products');
        }
        
    }
}
