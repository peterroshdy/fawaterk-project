@extends('layouts/dashboard/header')
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
					<h4 class="page-title">{{ $store->name }} @lang('store.Store_Settings')</h4>
					<p class="text-muted page-title-alt">@lang('store.Here_is')</p>
				</div>
			</div>
			<div class="row">
				<!-- col -->
				@if(Session::has('message-image-big'))
                                <p class="alert alert-danger">{{ Session::get('message-image-big') }}</p>
                            @endif
				
				<div class="col-lg-12">
					<div class="card-box">
						
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<!-- Nav tabs --><div class="card">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#store" aria-controls="home" role="tab" data-toggle="tab">@lang('store.Store_Info')</a></li>
										<li role="presentation"><a href="#taxes" aria-controls="profile" role="tab" data-toggle="tab">@lang('store.Taxes')</a></li>
										<li role="presentation"><a href="#status" aria-controls="profile" role="tab" data-toggle="tab">@lang('store.Status')</a></li>
										<li role="presentation"><a href="#categories" aria-controls="profile" role="tab" data-toggle="tab">@lang('store.Categories')</a></li>
										
										
									</ul>
									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="store">
											@if(Session::has('message-store-info-updated'))
											<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-store-info-updated') }}</p>
											@elseif(Session::has('message-store-tax-updated'))
											<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-store-tax-updated') }}</p>
											@elseif(Session::has('message-category-updated'))
											<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-category-updated') }}</p>
											@endif
											<form  enctype="multipart/form-data" method="POST" action="{{ url('vendor/store/settings/info/update') }}">
												{{ csrf_field() }}
												<input value="{{ $store->id }}" required name="store_id" type="hidden">
												<div class="col-lg-12">
													<div class="form-group">
														<label>@lang('store.Store_Name')</label>
														<input value="{{ $store->store_name }}" required name="store_name" type="name" class="form-control"  placeholder="@lang('store.What_is')">
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group">
														<label>@lang('store.Store_Description')</label>
														<textarea name="store_desc" class="form-control" placeholder="@lang('store.What_is_your')">{{ $store->store_desc }}</textarea>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="form-group">
														<label>@lang('store.Your_Shipping')</label>
														<input value="{{ $store->shipping_fees }}" name="store_fees" step="0.01" type="number" class="form-control"  placeholder="@lang('store.What_desc')">
													</div>
												</div>

												<div class="col-lg-12">
													
                                                    <div class="form-group">
                                                        <label>@lang('store.store_logo')</label><br><br>
                                                        @if($store->logo != '')
									                    <img width="100px" class="img-fluid center img-round" src="{{ asset('clients/vendors/logos/'.$store->logo.'') }}" alt="">
									                @endif<br><br>
                                                        <input class="form-control" name="store_logo" type="file">
                                                    </div>
                                                </div>

												<input type="submit" class="btn btn-primary btn-block" value="@lang('store.Save_Changes')">
											</form>
										</div>
										<div role="tabpanel" class="tab-pane" id="taxes">
											
											<form method="POST" action="{{ url('vendor/store/settings/tax/update') }}">
												{{ csrf_field() }}
												<input value="{{ $store->id }}" required name="store_id" type="hidden">
												
												
												<div class="col-lg-6">
													<div class="form-group">
														<label>@lang('store.Tax_name')</label>
														<input value="{{ $store->tax_name_1 }}" name="tax_name_1" type="text" class="form-control"  placeholder="@lang('store.What_tax_name')">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>@lang('store.Tax_amount')</label>
														<input value="{{ $store->tax_amount_1 }}" name="tax_amount_1" step="0.01" type="number" class="form-control"  placeholder="@lang('store.What_tax_amount')">
													</div>
												</div>
												
												<div class="col-lg-6">
													<div class="form-group">
														<label>@lang('store.Tax_two_name')</label>
														<input  value="{{ $store->tax_name_2 }}" name="tax_name_2" type="text" class="form-control"  placeholder="@lang('store.What_tax_name')">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label>@lang('store.Tax_two_amount')</label>
														<input value="{{ $store->tax_amount_2 }}" name="tax_amount_2" step="0.01" type="number" class="form-control"  placeholder="@lang('store.What_tax_amount')">
													</div>
												</div>
												<input type="submit" class="btn btn-primary btn-block" value="@lang('store.Save_Changes')">
											</form>
										</div>
										<div role="tabpanel" class="tab-pane" id="status">
											
											
											<div class="col-lg-12">
												<div class="form-group">
													<label>@lang('store.Store_Status')</label>
													<form action="{{ url('vendor/store/'.$store->id.'/update/store') }}" method="post">
														{{ csrf_field() }}
														<select name="status" onchange="this.form.submit()" class="form-control">
															@if($store->status == 0)
															<option value="0">Disable</option>
															<option value="1">Activate</option>
															
															@elseif($store->status == 1)
															
															<option value="1">Activate</option>
															<option value="0">Disable</option>
															
															@endif
														</select>
														
													</form>
													
												</div>
											</div>
										</div>
										<div role="tabpanel" class="tab-pane" id="categories">
											
											@if($store)
											
											<table class="table table-actions-bar m-b-0">
												<thead>
													<tr>
														<th>Category Name</th>
													</tr>
												</thead>
												<tbody>

													
														@if($categories->first())
															@foreach($categories as $category)
															@if($category->name_en && $category->name_ar)
															<tr>
															<td><span>{{ $category->name_en }}<a href="{{ url('vendor/category/'.$category->id.'/edit') }}" class="table-action-btn" ><i class="md md-edit"></i></a></span></td>
															</tr>
															@elseif($category->name_en)
															<tr>
															<td><span>{{ $category->name_en }}<a href="{{  url('vendor/category/'.$category->id.'/edit') }}" class="table-action-btn" ><i class="md md-edit"></i></a></span></td>
															</tr>
															@elseif($category->name_ar)
															<tr>
															<td><span>{{ $category->name_ar }}<a href="{{  url('vendor/category/'.$category->id.'/edit') }}" class="table-action-btn" ><i class="md md-edit"></i></a></span></td>
															</tr>
															@endif
															@endforeach
														@endif
														
														
													
												</div>
												
											</tbody>
										</table>
										<a class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal" href="#">Add New Category +</a>
										
										@else
										<h3 class="text-center">You don't have a store yet <i class="fa fa-frown-o"></i></h3>
										<div class="text-center"><a class="btn btn-success" href="{{ route("store.create") }}">Setup Store</a></div>
										@endif
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-body">
														
														<form method="POST" action="{{ url('vendor/categories/create') }}">
															{{ csrf_field() }}
															<input value="{{ $store->id }}" required name="store_id" type="hidden" class="form-control">
															
															@if(count( $store_languages ) == 0)
															<div class="col-lg-12">
																<div class="form-group">
																	<input required name="category_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
																</div>
															</div>
															@endif

															@foreach($store_languages as $lang) 
                    										@if($lang->lang == 'en')
                    										<div class="col-lg-12">
																<div class="form-group">
																	<input required name="category_name_en"  type="name" class="form-control"  placeholder="Enter Category Name">
																</div>
															</div>
                    										@elseif($lang->lang == 'ar')
                    										<div class="col-lg-12">
																<div class="form-group">
																	<input required name="category_name_ar"  type="name" class="form-control"  placeholder="أسم القسم">
																</div>
															</div>
                    										@endif
                    										@endforeach
															<br><br>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-success"><strong>Save changes</strong></button>
													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<footer class="footer text-right">
© 2018. All rights reserved.
</footer>
@endsection