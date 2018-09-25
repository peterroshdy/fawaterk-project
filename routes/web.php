<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Only Auth Users Can Go Here
Route::group(['middleware' => ['auth']], function() {

	//Pay Invocie
	Route::post('invoice/{id}/{key}/pay', 'InvoiceController@payInvoice');

	//Cart
	Route::post('store/{username}', 'OrderController@store');
	Route::get('/store/{username}/{locale}/cart', 'OrderController@index_page');
	Route::post('/cart/{id}', 'OrderController@update');
	Route::delete('/cart/{id}', 'OrderController@destroy');

	//Delete Order
	Route::get('store/{username}/{lang}/customer/{userId}/order/{orderId}/cancel', 'CheckoutController@cancel_order');

	//Checkout
	Route::post('/store/{username}/checkout', 'CheckoutController@checkout_info');
	Route::post('/store/{username}/done', 'CheckoutController@buy');
	Route::get('/store/{username}/order/{id}/order_invoice/{key}', 'CheckoutController@order_invoice');
	Route::post('/store/{username}/order/{id}/payment-method', 'CheckoutController@payment_method');

	Route::get('logout', function() {
		Auth::logout();
		return redirect('login');
	});

});

//Only ADMINS Can Go Here
Route::group(['middleware' => ['is_admin']], function() {

	//Get Users
	Route::get('/admin/users', 'AdminController@getUsers');

	//Get Invoices
	Route::get('/admin/invoices', 'AdminController@getInvoices');

	//Get Products
	Route::get('/admin/products', 'AdminController@getProducts');

	//Get Categories
	Route::get('/admin/categories', 'AdminController@getCategories');

	//Get Orders
	Route::get('/admin/orders', 'AdminController@getOrders');

	//Get Roles
	Route::get('/admin/roles', 'AdminController@getRoles');

	//Get Withdraws
	Route::get('/admin/withdraws', 'AdminController@getWithdraws');

	//Set Withdraws
	Route::post('/admin/withdraws', 'WithdrawController@withdraws_approve_or_reject');

	//Set Roles
	Route::post('/admin/roles/create', 'AdminController@setRoles');

	//Get Tickets
	Route::get('/admin/tickets', 'AdminController@getTickets');

	//Get Specific Ticket
	Route::get('/admin/ticket/{id}', 'AdminController@getTicket');

	//Reply to ticket
	Route::post('admin/ticket/message/store', 'AdminController@ticketReply');

	//Open or Close a Ticket
	Route::post('admin/ticket/{id}/changeStatus', 'AdminController@ticketStatusChange');

	//Get Edit Vendor Product page
	Route::get('admin/vendor/{username}/product/{key}/edit', 'AdminController@getEditProduct');

	//Set Edit Vendor Product
	Route::post('admin/vendor/{username}/product/{key}/update', 'AdminController@setEditProduct');

	//delete product as admin
	Route::get('admin/product/{id}/delete', 'AdminController@destroyProduct');

	//Get Edit page for user
	Route::get('admin/user/{id}/edit', 'AdminController@getEditUser');

	//update user general info
	Route::post('admin/user/{id}/info/update', 'AdminController@updateUserInfo');

	//update user password
	Route::post('admin/user/{id}/password/update', 'AdminController@updateUserPassword');

	//update user bank account
	Route::post('admin/user/{id}/bank/update', 'AdminController@updateUserBankAccount');

	//update user bank account
	Route::get('admin/user/{id}/delete', 'AdminController@removeUser');

	//Get Edit page for categories
	Route::get('admin/category/{id}/edit', 'AdminController@editCategory');

	//Update category
	Route::post('admin/category/{id}/update', 'AdminController@updateCategory');

	//Remove category
	Route::get('admin/category/{id}/delete', 'AdminController@removeCategory');
	


});


//Only VENDORS Can Go Here
Route::group(['middleware' => ['is_vendor']], function() {

	//Category add
	Route::post('vendor/categories/create', 'CategoryController@store');
	Route::get('vendor/category/{category_id}/edit', 'CategoryController@editCategory');
	Route::post('vendor/category/{category_id}/update', 'CategoryController@update');

	//Store Settings
	Route::get('vendor/store/settings', 'StoreController@edit');
	Route::post('vendor/store/settings/info/update', 'StoreController@update_info');
	Route::post('vendor/store/settings/tax/update', 'StoreController@update_tax');

	//Customer
	Route::get('vendor/customer/emailcheck', 'CustomerController@getEmailCheck');
	Route::get('vendor/customers', 'CustomerController@getCustomers');
	Route::post('vendor/customer/update/', 'CustomerController@update');
	Route::delete('vendor/customer/delete/{id}', 'CustomerController@destroy');
	Route::post('vendor/customer/emailcheck', 'CustomerController@setEmailCheck');
	Route::post('vendor/customer/store', 'CustomerController@store');

	//Orders
	Route::get('vendor/orders/pending', 'OrderController@getPendingOrders');
	Route::get('vendor/orders/pending/order/{id}/items', 'OrderController@getOrderItems');

	//Invoice
	//Route::resource('vendor/invoice', 'InvoiceController', ['except' => ['show']]);
	Route::post('vendor/invoice/store', 'InvoiceController@store');
	Route::get('vendor/invoice/{id}/edit', 'InvoiceController@edit');
	Route::get('vendor/invoice/create', 'InvoiceController@create');
	Route::post('vendor/invoice/{id}/{key}', 'InvoiceController@update');
	Route::get('vendor/invoices/filterBy/{filter}', 'InvoiceController@getIndex');
	Route::get('vendor/invoice/paid', 'InvoiceController@getPaid');
	Route::get('vendor/invoice/unpaid', 'InvoiceController@getUnpaid');
	Route::get('vendor/invoice/delete/{id}/{key}/{type}', 'InvoiceController@destroy');

	//Withdraw
	Route::get('vendor/request-withdraw', 'WithdrawController@request_withdraw_show');
	Route::post('vendor/request-withdraw', 'WithdrawController@request_withdraw_store');
	Route::get('vendor/withdraw-requests', 'WithdrawController@withdraws_show');

	//Vendor Profile
	Route::get('vendor/profile', 'VendorController@index');

	//Vendor Profile / Save Edited Info
	Route::post('vendor/profile/info/update', 'VendorController@update_info');

	//Vendor Profile / Save Edited Password Info
	Route::post('vendor/profile/password/update', 'VendorController@update_password');

	//Vendor Profile / Save Edited Bank Info
	Route::post('vendor/profile/bank/update', 'VendorController@update_bank');

	//Store
	Route::resource('vendor/store', 'StoreController', ['except' => ['show']]);
	Route::post('vendor/store/{id}/update/store', 'StoreController@storeStatus');

	//Products
	Route::get('vendor/products', 'ProductController@getProducts');

	//Product
	Route::resource('vendor/store/{username}/product', 'ProductController', ['except' => ['show']]);
	Route::get('/vendor/store/{username}/product/{key}', 'ProductController@destroy');

	//Email Invoice
	Route::get('vendor/invoice/{key}/email', 'MailController@emailInvoice');

	//Tickets
	Route::get('vendor/tickets', 'TicketController@getTickets');
	Route::get('vendor/ticket/create', 'TicketController@createTicket');
	Route::post('vendor/ticket/store', 'TicketController@storeTicket');
	Route::get('vendor/ticket/{id}', 'TicketController@getTicket');
	Route::post('vendor/ticket/message/store', 'TicketController@storeMessage');

	//Category add
	Route::post('vendor/categories/create', 'CategoryController@store');
	Route::get('category/{id}/edit'. 'CategoryController@edit');

});

//Only CUSTOMERS Can Go Here
Route::group(['middleware' => ['is_customer']], function() {

	//Store => Account
	Route::get('/store/{store_username}/account', 'Controller@profile');

});


// General Customer Routes
Route::group([ 'middleware' => ['is_general_customer'] ], function(){

	Route::get('/customer/home', 'GeneralCustomerController@index');
	
	Route::get('/customer/edit', 'GeneralCustomerController@edit');
	Route::post('/customer/edit', 'GeneralCustomerController@update')->name('user.update');

	Route::get('/customer/invoices', 'GeneralCustomerController@invoices');

	Route::get('/customer/invoices/paid', 'GeneralCustomerController@paid_invoices');
	Route::get('/customer/invoices/unpaid', 'GeneralCustomerController@unpaid_invoices');
	Route::get('/customer/stores', 'GeneralCustomerController@getStores');

	Route::get('/customer/invoices/{id}', function(){
		return view('Customer.invoice_view');
	});
	
	Route::get('/customer/tickets', function(){
		return view('Customer.tickets');
	});

	Route::get('/customer/tickets/{id}', function(){
		return view('Customer.ticket_view');
	});	

});


Route::get('/store/{username}', 'StoreController@getStore');

//Get store visibale for all
Route::get('store/{username}/{store_lang}', 'StoreController@show');

//Get store search page
Route::post('store/{username}/{store_lang}/search', 'StoreController@searchResults');

//Store => Categories
Route::get('/store/{store}/{locale}/category/{id}', 'CategoryController@index_page');

//Dashboard
Route::get('/', 'Controller@index');

//Get any product visibale for all
Route::get('/store/{username}/{locale}/product/{key}', 'ProductController@show');

//Get invoices
Route::get('/invoice/{id}/{key}', 'InvoiceController@show');

//Auth Routes (Sign Up, Sign In , etc ..)
Auth::routes();

//Error Page
Route::get('/404', 'Controller@_404');

//Verify Email
Route::get('/emailVerify/{token}', 'Auth\RegisterController@VerifyEmail');


// Change Language
Route::get('lang/{locale}', function ($locale) {
	
	if ( in_array($locale, \Config::get('app.locales')) )
	{
		Session::put('locale', $locale);
	}
	
	return redirect()->back();
});


  
// Customers Routes
Route::get('/register', function(){
	return view('auth.register');
});


Route::post('user/customer_register', 'Account\UserAuthController@register')->name('user.customer_register');