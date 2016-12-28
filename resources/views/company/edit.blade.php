@extends('master')
	@section('content')

	@can('manager-access')
	<div class="row">
		<label>Sorry, you don't have permission to view this page</label>
	</div>
	@endcan

	@can('admin-access')
	<div class="row">
		<h3>Company - Edit</h3>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $company->company_logo }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	
	@if ($company->company_certificate)
	<div class="row">
		<a href="/equitise/public/uploads/{{ $company->company_certificate }}" target="_blank">View Certificate</a>
	</div>
	@else
	<div class="row">
		<label>No Certificate Found</label>
	</div>
	@endif

	<br />
	<div class="row">
		<form class="" action="{{route('company.update', $company->id)}}" method="post" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PATCH">	
			{{csrf_field()}}
			<div class="form-group{{ ($errors->has('company_name')) ? $errors->first('company_name') : '' }}">
				<label>Company Name</label>
				<input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" value="{{$company->company_name}}"> 
				{!! $errors->first('company_name', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<label>Company Email</label>
				<input type="text" name="company_email" class="form-control" placeholder="Enter Company Email" value="{{$user->email}}" disabled> 
				{!! $errors->first('company_email', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="company_address" class="form-control" placeholder="Enter Address" value="{{$company->address}}">
			</div>
			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" name="company_contact" class="form-control" placeholder="Enter Contact Number" value="{{$company->contact}}">
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
				<input type="submit" class="btn btn-primary" value="Save">
			</div>
		</form>	
	</div>
	@endcan
@stop