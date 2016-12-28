@extends('master')
	@section('content')
	<div class="row">
		<h3>User Profile</h3>
	</div>
	<div class="row">
		<h4>{{ $user->name }}</h4>
	</div>
	<div class="row">
		<img src="/equitise/public/uploads/{{ $user->avatar }}" height="150" width="150" class="img-square"/>
	</div>
	<br />
	<div class="row">
		<label>Name :</label>
		<span>{{$user->name}}</span>
	</div>
	<div class="row">
		<label>Email :</label>
		<span>{{$user->email}}</span>
	</div>

@stop