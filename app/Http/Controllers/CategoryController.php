<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Product;
use App\StoreLanguage;
use Auth;
use Session;
use App;

class CategoryController extends Controller
{

	public function index_page($store, $store_lang, $id)
	{
		$store = Store::where('vendor_username', $store)->where('status', 1)->first();
		if ($store) {

			//Get all the products assigned to the same Category ID
			$category_products = Product::all()->where('category_id', $id)->where('store_id', $store->id)->where('lang', $store_lang)->where('status', 1);

			//Get all categories for the Categories NavBar in the View
			$categories = Category::all()->where('store_id', $store->id);

			//Check if there is no products
			if ($category_products->isEmpty()) {

				return view('404');
				
			}else{
				
				App::setlocale($store_lang);
				return view('store/category/index', compact('store', 'category_products', 'categories', 'store_lang'));
			}
			
			
		}else{

			return view('404');
		}
	}


	public function store(Request $request)
    {
    	$category = new Category;

        $store_languages = StoreLanguage::all()->where('store_id', $request->store_id);
    	if(count( $store_languages ) == 0){
    			
		        $category->store_id = $request->store_id;
		        $category->vendor_id = Auth::id();
		        $category->name_en = $request->category_name_en;
    	}


    	foreach($store_languages as $lang){
    		if($lang->lang == 'en'){

		        $category->store_id = $request->store_id;
		        $category->vendor_id = Auth::id();
		        $category->name_en = $request->category_name_en;

    		}
            elseif($lang->lang == 'ar'){

		        $category->store_id = $request->store_id;
		        $category->vendor_id = Auth::id();
		        $category->name_ar = $request->category_name_ar;

            }
    	} 
        
        $category->save();
        return redirect('vendor/store/settings');
    }

    public function editCategory($id)
    {
    	$category = Category::find($id);
    	$store = Store::where('vendor_username', Auth::user()->username)->first();
    	$store_languages = StoreLanguage::all()->where('store_id', $store->id);
    	if ($category->vendor_id == Auth::id()) {
    		return view('dashboard/vendor/categories/edit', compact('category', 'store', 'store_languages'));
    	}else{
    		return view('404');
    	}
    	
    }


    public function update(Request $request, $id)
    {
    	$category = Category::find($id);
    	if($category->name_en && $category->name_ar){

    		$category->name_en = $request->category_name_en;
    		$category->name_ar = $request->category_name_ar;
    		$category->save();

    	}elseif($category->name_en){

    		$category->name_en = $request->category_name_en;
    		$category->save();

    	}elseif ($category->name_ar) {

    		$category->name_ar = $request->category_name_ar;
    		$category->save();
    	}

    	Session::flash('message-category-updated', 'Category updated successfully'); 
        return redirect('vendor/store/settings');
    }

    
}