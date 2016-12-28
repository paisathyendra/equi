@extends('master')
	@section('content')

	@can('manager-access')
	<div class="row">
		<label>Sorry, you don't have permission to view this page</label>
	</div>
	@endcan

	@can('admin-access')
	<div class="row">
		<h3>User - Edit</h3>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $user->avatar }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	<div class="row">
		<form class="" action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PATCH">	
			{{csrf_field()}}
		 	<div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
		 		<label>Name</label>
				<input type="text" name="name" class="form-control" placeholder="Enter User Name" value="{{$user->name}}"> 
				{!! $errors->first('name', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group{{ ($errors->has('email')) ? $errors->first('email') : '' }}">
				<label>Email</label>
				<input type="text" name="email" class="form-control" placeholder="Enter User Email" value="{{$user->email}}" disabled>
				{!! $errors->first('email', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<label>User Avatar</label>
				<input type="file" id="avatar" name="avatar">
				{!! $errors->first('avatar', '<p class="help-block">:message</p>')!!}
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Save">
			</div>
		</form>	
	</div>
	@endcan
@stop