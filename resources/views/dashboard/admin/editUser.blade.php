@extends('layouts/dashboard/admin/header')
@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">{{ $profile->name }} @lang('profile.Profile')</h4>
                                <p class="text-muted page-title-alt">@lang('profile.Here_is')</p>
                            </div>
                        </div>

                        


                        <div class="row">
                            <!-- col -->

                            <div class="col-lg-12">
                                <div class="card-box">
                               
         							<div class="container">
										<div class="row">
		                                	<div class="col-md-12">
		                                    <!-- Nav tabs --><div class="card">
		                                    <ul class="nav nav-tabs" role="tablist">
		                                        <li role="presentation" class="active"><a href="#profile" aria-controls="home" role="tab" data-toggle="tab">@lang('profile.Profile')</a></li>
		                                        <li role="presentation"><a href="#password" aria-controls="profile" role="tab" data-toggle="tab"> @lang('profile.Change_Password')</a></li>
		                                        <li role="presentation"><a href="#bankaccount" aria-controls="profile" role="tab" data-toggle="tab">@lang('profile.Bank_Account') </a></li>
		                                        
		                                    </ul>

		                                    <!-- Tab panes -->
		                                    <div class="tab-content">
		                                        <div role="tabpanel" class="tab-pane active" id="profile">

		                                        	@if(Session::has('message-info-updated'))
				                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-info-updated') }}</p>
				                                    @elseif(Session::has('message-password-updated'))
				                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-password-updated') }}</p>
				                                    @elseif(Session::has('message-password-error'))
				                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-password-error') }}</p>
				                                    @elseif(Session::has('message-bank-updated'))
				                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-bank-updated') }}</p>
				                                    @endif

		                                        	<form method="POST" action="{{ url('admin/user/'.$profile->id.'/info/update') }}">
		                                        		{{ csrf_field() }}
		                                        		 <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_Name')</label>
		                                                        <input value="{{ $profile->name }}" required name="name"  type="name" class="form-control"  placeholder="@lang('profile.what')">
		                                                    </div>
		                                                </div>

		                                               
		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_Phone')</label>
		                                                        <input value="{{ $profile->mobile }}" name="phone"  type="number" class="form-control"  placeholder="@lang('profile.what_is')">
		                                                    </div>
		                                                </div>

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_National')</label>
		                                                        <input value="{{ $profile->national_id }}" name="national_id"  type="number" class="form-control"  placeholder="@lang('profile.what_is_your')">
		                                                    </div>
		                                                </div>


		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_Address')</label>
		                                                        <textarea required rows="5" name="address" class="form-control">{{ $profile->address }}</textarea>
		                                                    </div>
		                                                </div>

		                                                <input type="submit" class="btn btn-primary btn-block" value="@lang('profile.Save_Changes')">

		                                        	</form>

		                                        </div>

		                                        <div role="tabpanel" class="tab-pane" id="bankaccount">
		                                        	
		                                        	<form method="POST" action="{{ url('admin/user/'.$profile->id.'/bank/update') }}">
		                                        		{{ csrf_field() }}
		                                        		 

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_Bank_Name')</label>
		                                                        <select class="form-control" name="bank_name">
		                                                        	<option value="{{ $profile->bank_name }}">{{ $profile->bank_name }}</option>
		                                                        	<option value="Al Ahli Bank Of Kuwait (ABK-Egypt)">@lang('profile.Al_Ahli')</option>
																	<option value="Banque du Caire">@lang('profile.Banque')</option>
																	<option value="Egyptian Arab Land Bank">@lang('profile.Egyptian')</option>
																	<option value="National Bank of Egypt">@lang('profile.National')</option>
															
																	<option value="Bank of Alexandria">@lang('profile.Bank_of_Alex')</option>
												
																	<option value="Commercial International Bank (CIB)">@lang('profile.Commercial')</option>
																
																	
															
																	<option value="Credit Agricole Egypt">@lang('profile.Credit')</option>
																
																
																	<option value="Qatar National Bank Al Ahli (QNB Alahli)">@lang('profile.Qatar')</option>
																	<option value="Banque Misr">@lang('profile.Banque_Misr')</option>
														
																	<option value="Ahli United Bank">@lang('profile.Ahli_United_Bank')</option>
																	<option value="Faisal Islamic Bank of Egypt">@lang('profile.Faisal')</option>
																	<option value="National Bank of Kuwait - Egypt (NBK-Egypt)">@lang('profile.Nat_Ban_Kuw')</option>

																	<option value="Abu Dhabi Islamic Bank (ADIB)">@lang('profile.Abu_Dhabi')</option>
																	<option value="Union National Bank Egypt (UNB-E)">@lang('profile.Union_National')</option>
																	<option value="Egyptian Gulf Bank (EG BANK)">@lang('profile.Egyptian_Gulf')</option>
																	<option value="Arab African International Bank">@lang('profile.Arab_African')</option>
																	<option value="HSBC Bank Egypt">@lang('profile.HSBC')</option>
																	
		                                                        </select>
		                                                    </div>
		                                                </div>

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.You_Ban_Acc')</label>
		                                                        <input value="{{ $profile->bank_account }}" name="bank_account"  type="number" class="form-control"  placeholder="@lang('profile.what_des')">
		                                                    </div>
		                                                </div>

		                                                <input type="submit" class="btn btn-primary btn-block" value="@lang('profile.Save_Changes')">


		                                        	</form>

		                                        </div>

		                                        <div role="tabpanel" class="tab-pane" id="password">
		                                        	
		                                        	<form method="POST" action="{{ url('admin/user/'.$profile->id.'/password/update') }}">
		                                        		{{ csrf_field() }}
		                                        		
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_Old_Password')</label>
		                                                        <input name="old_password" required type="password" class="form-control"  placeholder="@lang('profile.Old_Password')">
		                                                    </div>
		                                                </div>

		                                                

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Your_New_Password')</label>
		                                                        <input onkeyup='check();' id="new_pass" name="new_password" required type="password" class="form-control"  placeholder="@lang('profile.New_Password')">
		                                                    </div>
		                                                </div>

		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label>@lang('profile.Confirm')</label> 
		                                                        <strong><span id='message'></span></strong>
		                                                        <input onkeyup='check();' id="re_new_pass" required type="password" class="form-control"  placeholder="@lang('profile.Confirm_desc')">
		                                                    </div>
		                                                </div>

		                                                <input style="display: none;" id="sub-btn" type="submit" class="btn btn-primary btn-block" value="@lang('profile.Save_Changes')">


		                                        	</form>

		                                        </div>

		                                        
		                                    </div>
										</div>
                                	</div>
								</div>
								</div>

                                </div>
                            </div>
                            <!-- end col -->



                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
        <script type="text/javascript">
        	
        	var check = function() {
				  if (document.getElementById('new_pass').value ==
				    document.getElementById('re_new_pass').value) {
				    document.getElementById('message').style.color = 'green';
				    document.getElementById('message').innerHTML = 'Matching';
				    document.getElementById('sub-btn').style.display = 'block'
				  } else {
				    document.getElementById('message').style.color = 'red';
				    document.getElementById('message').innerHTML = 'Not Matching';
				    document.getElementById('sub-btn').style.display = 'none'
				  }
				}

        </script>

@endsection