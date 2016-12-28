@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @can('admin-access')
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/user') }}">Users</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/company') }}">Companies</a>
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/syndicate') }}">Syndicates</a>
                        </div>    
                    </div>
                    @endcan
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('/profile') }}/{{ Auth::user()->id }}">Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
