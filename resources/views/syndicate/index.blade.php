@extends('master')
	@section('content')

	@if(Session::has('alert-success'))
    <div class="alert alert-success">
        <h4>{{ Session::get('alert-success') }}</h4>
    </div>
	@endif

	@can('manager-access')
	<div class="row">
		<label>Sorry, you don't have permission to view this page</label>
	</div>
	@endcan

	@can('admin-access')
	<div class="row">
		<div class="col-md-12">
			<h1>Syndicates</h1>
		</div>
	</div>
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>Syndicate Name</th>
				<th>Address</th>
				<th>Actions</th>
			</tr>
			<a href="{{route('syndicate.create')}}" class="btn btn-info pull-right">Create New Syndicate</a>
			<br />
			<br />
			<?php $no=1; ?>

			@foreach($syndicates as $syndicate)
			<tr>
				<td>{{$no++}}</td>
				<td>{{$syndicate->name}}</td>
				<td>{{$syndicate->address}}</td>
				<td>
					<form class="" action="{{route('syndicate.destroy', $syndicate->id)}}" method="post">
						<input type="hidden" name="_method" value="delete">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<a href="{{route('syndicate.edit', $syndicate->id)}}" class="btn btn-primary">Edit</a>
						<input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data')" name="name" value="Delete">
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@endcan

	@stop