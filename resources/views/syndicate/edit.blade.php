@extends('master')
	@section('content')

	@can('manager-access')
	<div class="row">
		<label>Sorry, you don't have permission to view this page</label>
	</div>
	@endcan

	@can('admin-access')
	<div class="row">
		<h3>Syndicate - Edit</h3>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $syndicate->logo }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	
	@if ($syndicate->certificate)
	<div class="row">
		<a href="/equitise/public/uploads/{{ $syndicate->certificate }}" target="_blank">View Certificate</a>
	</div>
	@else
	<div class="row">
		<label>No Certificate Found</label>
	</div>
	@endif
	
	<br />
	<div class="row">
		<form class="" action="{{route('syndicate.update', $syndicate->id)}}" method="post" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PATCH">	
			{{csrf_field()}}
			<div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
				<label>Syndicate Name</label>
				<input type="text" name="name" class="form-control" placeholder="Enter Syndicate Name" value="{{$syndicate->name}}"> 
				{!! $errors->first('name', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group{{ ($errors->has('email')) ? $errors->first('email') : '' }}">
				<label>Syndicate Email</label>
				<input type="text" name="email" class="form-control" placeholder="Enter Syndicate Email" value="{{$user->email}}" disabled> 
				{!! $errors->first('email', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{$syndicate->address}}">
			</div>
			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" name="contact" class="form-control" placeholder="Enter Contact Number" value="{{$syndicate->contact}}">
			</div>
			<div class="form-group">
				<label>Syndicate Logo</label>
				<input type="file" id="logo" name="logo">
				{!! $errors->first('logo', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<label>Syndicate Certificate</label>
				<input type="file" id="certificate" name="certificate">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Save">
			</div>
		</form>	
	</div>
	@endcan

@stop