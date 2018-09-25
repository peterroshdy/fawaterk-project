<?php

use App\User;

//**********************************************************************************************************
function doesEmailExist($email){
	
	$check = User::all()->where('email', $email);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}

function doesUsernameExist($username){
	
	$check = User::all()->where('username', $username);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}

function doesCustomerExist($email){
	
	$check = Customer::all()->where('email', $email);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}

function doesNationalIdExist($national_id){
	
	$check = User::all()->where('national_id', $national_id);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}

function doesPhoneNumberExist($phone){
	
	$check = User::all()->where('mobile', $phone);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}

function doesBankAccountExist($account){
	
	$check = User::all()->where('bank_account', $account);
	if ($check->first() != '') {
		return True;
	}else{
		return False;
	}
}


function uniqueProductKey()
{
	$UPK = uniqid(rand()).uniqid().md5(uniqid()).Auth::id();
	return $UPK;
}