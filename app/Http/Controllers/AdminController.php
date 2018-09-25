<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WithdrawRequest;
use App\TicketMessage;
use App\Category;
use App\Invoice;
use App\Product;
use App\Ticket;
use App\Order;
use App\User;
use App\Role;
use App\Store;
use App\StoreLanguage;
use App\ProductColor;
use App\ProductSize;
use App\OrderProduct;
use App\Color;
use App\Size;
use Config;
use Session;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function getUsers()
    {
    	$profiles = User::all();
    	return view('dashboard/admin/users', compact('profiles'));	
    }

    public function getInvoices()
    {
    	$invoices = Invoice::all();
    	return view('dashboard/admin/invoices', compact('invoices', $invoices));
    }

    public function getProducts()
    {
        $products = Product::all();
        return view('dashboard/admin/products', compact('products', $products));
    }

    public function getCategories()
    {
        $categories = Category::all();
        return view('dashboard/admin/categories', compact('categories', $categories));
    }

    public function getRoles()
    {
        $roles = Role::all();
        return view('dashboard/admin/roles', compact('roles', $roles));
    }

    public function setRoles(Request $request)
    {
        $role = new Role;
        $role->name = $request->role_name_en;
        $role->name_ar = $request->role_name_ar;
        $role->save();
        return redirect('admin/roles');
    }

    public function getWithdraws()
    {
        $withdraw_requests = WithdrawRequest::all()->where('status', 0);
        return view('dashboard/admin/withdraws', compact('withdraw_requests', $withdraw_requests));

    }

    public function getOrders()
    {
        //Get all orders
        $orders = Order::all();
        return view('dashboard/admin/orders', compact('orders', $orders));
    }

    public function getTickets()
    {
        $tickets = Ticket::all();
        return view('dashboard/admin/tickets', compact('tickets'));
    }

    public function getTicket($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket != '') {
            
            $ticket_messages = TicketMessage::all()->where('ticket_id', $id);
            return view('dashboard/admin/ticket', compact('ticket', 'ticket_messages'));

        }else{
            return view('404');
        }
    }

    public function ticketReply(Request $request)
    {
        //add the message to the messages table
        $ticket_message = new TicketMessage;
        $ticket_message->ticket_id = $request->ticket_id;
        $ticket_message->from_user_id = Auth::id();
        $ticket_message->message = $request->message;
        $ticket_message->save();

        return redirect('admin/ticket/'.$request->ticket_id.'');
    }

    public function ticketStatusChange(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->status = $request->status;
        $ticket->save();
        return redirect('admin/tickets');
    }

    public function getEditProduct($vendor_username, $product_key)
    {

        $store = Store::where('vendor_username', $vendor_username)->first();
        $lang =  Config::get('app.locale');
        $product = Product::where('key', $product_key)->first();

        if ($store != '') {

            if ($product != '') {
                
                $store_languages = StoreLanguage::all()->where('store_id', $store->id);

                //Get all the colors and sizes from our database
                $colors = Color::all();
                $sizes = Size::all();
                $categories = Category::all();
                
                //Get the Product Colors and Sizes
                $product_colors = ProductColor::all()->where('product_key', $product_key)->where('code', $lang);
                $product_sizes = ProductSize::all()->where('product_key', $product_key)->where('code', $lang);


                //This is lists of the All the colors and sizes exept the product color and size(For the Checkboxes in the view)
                $other_colors = Color::all();
                $other_sizes = Size::all();
                
                //Check to see if the product color equals the same color in the database then remove this color from the second list
                foreach ($product_colors as $color) {

                        for ($i=0; $i < sizeof($colors); $i++) { 
                            
                            if ($color->color->id == $colors[$i]->id) {

                                unset($other_colors[$i]);
                            }
                        }
                }

                //Check to see if the product size equals the same size in the database then remove this size from the second list
                foreach ($product_sizes as $size) {

                        for ($i=0; $i < sizeof($sizes); $i++) { 
                            
                            if ($size->size->id == $sizes[$i]->id) {

                                unset($other_sizes[$i]);
                            }
                        }
                }

                return view('dashboard/admin/editProduct', compact('store', 'product', 'product_en', 'product_ar', 'product_colors', 'other_colors', 'product_sizes', 'other_sizes', 'categories', 'store_languages'));

            }else{
                echo "PRoduct is empty";
            }

            }else{

                echo "There is no store";
            }
        
    }

    public function setEditProduct(Request $request, $vendor_username, $product_key)
    {
        $store = Store::where('vendor_username', $vendor_username)->first();
        $store_languages = StoreLanguage::all()->where('store_id', $store->id);
        $product = Product::where('key', $product_key)->first();

        //If store don't have languges , then defualt add the product in english
        if (count($store_languages) == 0) {
            
                $product->title_en          = $request->product_title_en;
                $product->body_en          = $request->product_body_en;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->save();

                //Check if there any added colors
                $colors = $request->colors;
                //Delete all colors attached to this product and add the new
                ProductColor::where('product_key', $product_key)->where('code', 'en')->delete();
                if ($colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $product_key;
                        $c->code = 'en';
                        $c->color_id = $color;
                        $c->save();
                    }
                }

                //Check if there any added sizes
                $sizes = $request->sizes;
                ProductSize::where('product_key', $product_key)->where('code', 'en')->delete();
                if ($sizes != '') {
                    foreach ($sizes as $size) {
                        $s = new ProductSize;
                        $s->product_key = $product_key;
                        $s->code = 'en';
                        $s->size_id = $size;
                        $s->save();
                    }
                }
        }

        foreach($store_languages as $lang){
            //If the English Language availabe then add english language to it
            if($lang->language->code == 'EN'){

                $product->title_en          = $request->product_title_en;
                $product->body_en          = $request->product_body_en;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->save();

                //Check if there any added colors
                $colors = $request->colors;
                //Delete all colors attached to this product and add the new
                ProductColor::where('product_key', $product_key)->where('code', 'en')->delete();
                if ($colors != '') {
                    foreach ($colors as $color) {
                        $c = new ProductColor;
                        $c->product_key = $product_key;
                        $c->code = 'en';
                        $c->color_id = $color;
                        $c->save();
                    }
                }

                //Check if there any added sizes
                $sizes = $request->sizes;
                ProductSize::where('product_key', $product_key)->where('code', 'en')->delete();
                if ($sizes != '') {
                    foreach ($sizes as $size) {
                        $s = new ProductSize;
                        $s->product_key = $product_key;
                        $s->code = 'en';
                        $s->size_id = $size;
                        $s->save();
                    }
                }

            }
            //If the Arabic Language availabe then add arabic language to it
            elseif ($lang->language->code == 'AR') {
            
                $product->title_ar        = $request->product_title_ar;
                $product->body_ar         = $request->product_body_ar;
                $product->price             = $request->product_price;
                $product->category_id       = $request->product_category;
                $product->stock            = $request->product_stock;
                $product->save();

                //Check if there any added colors
                $colors = $request->colors;
                //Delete all colors attached to this product and add the new
                ProductColor::where('product_key', $product_key)->where('code', 'ar')->delete();
                if ($colors != '') {
                    foreach ($colors as $color) {

                        $c = new ProductColor;
                        $c->product_key = $product_key;
                        $c->code = 'ar';
                        $c->color_id = $color;
                        $c->save();
                    }
                }

                //Check if there any added sizes
                $sizes = $request->sizes;
                ProductSize::where('product_key', $product_key)->where('code', 'ar')->delete();
                if ($sizes != '') {
                    foreach ($sizes as $size) {
                        
                        $s = new ProductSize;
                        $s->product_key = $product_key;
                        $s->code = 'ar';
                        $s->size_id = $size;
                        $s->save();
                    }
                }

            }
        }

        return redirect('admin/products');
    }

    public function destroyProduct($id)
    {
        if (OrderProduct::where('product_id', $id)->where('status', 1)->first() != '') {
            Session::flash('message-product-delete-rejacted', 'Can not remove it, This product is involved in pending orders'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('admin/products');
        }else{

            Product::find($id)->delete();
            Session::flash('message-product-delete-approved', 'Product Removed Successfully');
            Session::flash('alert-class', 'alert-success'); 
            return redirect('admin/products');
        }
        
    }

    public function getEditUser($id)
    {
        $profile = User::find($id);
        return view('dashboard/admin/editUser', compact('profile'));
    }

    public function updateUserInfo(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->phone;
        $user->national_id = $request->national_id;
        $user->save();
        Session::flash('message-info-updated', 'Profile updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user/'.$user->id.'/edit');
    }

    public function updateUserPassword(Request $request, $id)
    {
        $user = User::find($id);

        $old_password = $request->old_password;

        if (Hash::check($old_password, $user->password)) {

            $user->password = bcrypt($request->new_password);
            $user->save();
            Session::flash('message-password-updated', 'Password updated successfully'); 
            Session::flash('alert-class', 'alert-success'); 
            return redirect('admin/user/'.$user->id.'/edit');

        }else{

            Session::flash('message-password-error', 'The password your entered does not match our recordes'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('admin/user/'.$user->id.'/edit');
        }
    }

    public function updateUserBankAccount(Request $request, $id)
    {
        $user = User::find($id);
        $user->bank_name = $request->bank_name;
        $user->bank_account = $request->bank_account;
        $user->save();
        Session::flash('message-bank-updated', 'Bank info updated successfully'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/user/'.$user->id.'/edit');
    }

    public function removeUser(Request $request, $id)
    {
        User::find($id)->delete();
        return redirect('admin/users');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('dashboard/admin/editCategory', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->cate_en;
        $category->name_ar = $request->cate_ar;
        $category->save();
        return redirect('admin/categories');
    }

    public function removeCategory($id)
    {
        Category::find($id)->delete();
        return redirect('admin/categories');
    }

}
