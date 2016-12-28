@extends('master')
	@section('content')
	<div class="row">
		<h3>Syndicate Profile</h3>
	</div>
	<div class="row">
		<h4>{{ $syndicate->name }}</h4>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $syndicate->logo }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	<div class="row">
		<label>Name :</label>
		<span>{{ $syndicate->name }}</span>
	</div>
	<div class="row">
		<label>Email :</label>
		<span>{{ $user->email }}</span>
	</div>
	<div class="row">
		<label>Address :</label>
		<span>{{ $syndicate->address }}</span>
	</div>
	<div class="row">
		<label>Contact Number :</label>
		<span>{{ $syndicate->contact }}</span>
	</div>

	@if ($syndicate->certificate)
	<div class="row">
		<label>Certificate :</label>
		<a href="/equitise/public/uploads/{{ $syndicate->certificate }}" target="_blank">View</a>
	</div>
	@else
	<div class="row">
		<label>No Certificate Found</label>
	</div>
	@endif
@stop