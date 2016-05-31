@extends('layouts.admin')
@section('title','User')
@section('styles')

    .table > tbody > tr > td,.table > tbody > tr > th{
    vertical-align: middle;
    text-align: center;
    }
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">

                        <form action="{{url('users')}}"  method="get" class="form-horizontal text-center">
                            <div class="form-group">
                            <div class="col-md-10">
                                <input type="text" placeholder="Name / Email" name="q" value="{{old('q')}}" id="searchInput" class="form-control">
                            </div>


                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="width: 100%">Search</button>
                            </div>
                            </div>
                        </form>


                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="msg-container">
                                <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Permission</th>
                                <th>Is Admin</th>
                                    <th></th>
                                </tr>
                                @foreach($users as $index=>$user)
                                    <tr>
                                        <td>{{$index+1+(null!==old('page') ? (old('page')-1)*5:0)}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{!! implode('<br>',$user->permissions) !!}</td>
                                        <td>{{$user->is_admin?'Yes':'No'}}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{url('user/'.$user->id)}}">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer text-right">{!! $users->appends(['q'=>old('q')])->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection