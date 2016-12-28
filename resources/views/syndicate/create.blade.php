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
			<h1>Create Syndicate</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="" action="{{route('syndicate.store')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
					<label>Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter Syndicate Name"> 
					{!! $errors->first('name', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group{{ ($errors->has('email')) ? $errors->first('email') : '' }}">
					<label>Email</label>
					<input type="text" name="email" class="form-control" placeholder="Enter Syndicate Email"> 
					{!! $errors->first('email', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="address" class="form-control" placeholder="Enter Address">
				</div>
				<div class="form-group">
					<label>Contact Number</label>
					<input type="text" name="contact" class="form-control" placeholder="Enter Contact Number">
				</div>
				<div class="form-group">
					<label>Syndicate Logo</label>
					<input type="file" id="logo" name="logo">
					{!! $errors->first('logo', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>Syndicate Certificate</label>
					<input type="file" id="certificate" name="certificate">
					{!! $errors->first('certificate', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<input type="hidden" name="role" value="manager">
					<input type="hidden" name="account_type" value="syndicate">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</form>	
		</div>
	</div>
	@endcan

@stop