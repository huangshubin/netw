@extends('layouts.admin')
@section('title','User Profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>
                    <div class="panel-body" style="font-size:120%">
                      @include('user.user_info')
                        <hr>
                            <div class="row">
                                <div class="col-md-4 text-center col-md-offset-4" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('password/change')}}">Password Change</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection