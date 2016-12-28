@extends('master')
	@section('content')

	@can('manager-access')
	<div class="row">
		<label>Sorry, you don't have permission to view this page</label>
	</div>
	@endcan
	
	@can('admin-access')
	<div class="row">
		<div class="col-md-12">
			<h1>Create Company</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="" action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group{{ ($errors->has('company_name')) ? $errors->first('company_name') : '' }}">
					<label>Name</label>
					<input type="text" name="company_name" class="form-control" placeholder="Enter Company Name"> 
					{!! $errors->first('company_name', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="company_email" class="form-control" placeholder="Enter Email Address">
					{!! $errors->first('company_email', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="company_address" class="form-control" placeholder="Enter Address">
				</div>
				<div class="form-group">
					<label>Contact Number</label>
					<input type="text" name="company_contact" class="form-control" placeholder="Enter Contact Number">
				</div>
				<div class="form-group">
					<label>Company Logo</label>
					<input type="file" id="company_logo" name="company_logo">
					{!! $errors->first('company_logo', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>Company Certificate</label>
					<input type="file" id="company_certificate" name="company_certificate">
					{!! $errors->first('company_certificate', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<input type="hidden" name="role" value="manager">
					<input type="hidden" name="account_type" value="company">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</form>	
		</div>
	</div>
	@endcan

@stop