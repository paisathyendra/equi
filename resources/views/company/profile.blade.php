@extends('master')
	@section('content')
	<div class="row">
		<h3>Company Profile</h3>
	</div>
	<div class="row">
		<h4>{{ $company->company_name }}</h4>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $company->company_logo }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	<div class="row">
		<label>Name :</label>
		<span>{{ $company->company_name }}</span>
	</div>
	<div class="row">
		<label>Email :</label>
		<span>{{ $user->email }}</span>
	</div>
	<div class="row">
		<label>Address :</label>
		<span>{{ $company->address }}</span>
	</div>
	<div class="row">
		<label>Contact Number :</label>
		<span>{{ $company->contact }}</span>
	</div>
	@if ($company->company_certificate)
	<div class="row">
		<label>Certificate :</label>
		<a href="/equitise/public/uploads/{{ $company->company_certificate }}" target="_blank">View</a>
	</div>
	@else
	<div class="row">
		<label>No Certificate Found</label>
	</div>
	@endif
@stop