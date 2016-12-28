@extends('master')
	@section('content')

	@if(Session::has('alert-success'))
    <div class="alert alert-success">
        <h4>{{ Session::get('alert-success') }}</h4>
    </div>
	@endif

	@can('admin-access')
	<div class="row">
		<div class="col-md-12">
			<h1>Users</h1>
		</div>
	</div>
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>User Name</th>
				<th>User Email</th>
				<th>Actions</th>
			</tr>
			<a href="{{route('user.create')}}" class="btn btn-info pull-right">Create New User</a>
			<br />
			<br />
			<?php $no=1; ?>

			@foreach($users as $user)
			<tr>
				<td>{{$no++}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
					<form class="" action="{{route('user.destroy', $user->id)}}" method="post">
						<input type="hidden" name="_method" value="delete">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<a href="{{route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a>
						<input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data')" name="name" value="Delete">
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@endcan



	@stop