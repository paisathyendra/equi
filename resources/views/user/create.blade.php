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
			<h1>Create User</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form class="" action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group{{ ($errors->has('name')) ? $errors->first('name') : '' }}">
					<label>Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter User Name"> 
					{!! $errors->first('name', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group{{ ($errors->has('email')) ? $errors->first('email') : '' }}">
					<label>Email</label>
					<input type="text" name="email" class="form-control" placeholder="Enter User Email"> 
					{!! $errors->first('email', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<label>User Avatar</label>
					<input type="file" id="avatar" name="avatar">
					{!! $errors->first('avatar', '<p class="help-block">:message</p>')!!}
				</div>
				<div class="form-group">
					<input type="hidden" name="role" value="manager">
					<input type="hidden" name="account_type" value="individual">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</form>	
		</div>
	</div>
	@endcan

@stop

