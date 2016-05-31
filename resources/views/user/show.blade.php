@extends('layouts.admin')
@section('title','User Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body" style="font-size:120%">
                      @include('user.user_info')
                        <hr>

                        @if(true)
                            <div class="row">
                                @can('edit',ENTITY_USER)
                                <div class="col-md-2 text-center col-md-offset-3" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('user/'.$user->id.'/edit')}}">Edit</a>
                                </div>
                                @endcan
                                <div class="col-md-2" >
                                    <form action="{{url('user/'.$user->id.'/delete')}}" class="modal fade" id='deleteForm' method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Confirm</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h2 class="text-danger">Are you sure want to delete?</h2>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                      </form>
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#deleteForm" style="width:100%">Delete</button>

                                </div>
                                <div class="col-md-2 text-center" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('users')}}">Back</a>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-2 text-center col-md-offset-5" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('users')}}">Back</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection