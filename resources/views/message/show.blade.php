@extends('layouts.admin')
@section('title','Message Details')
@section('content')
    <div class="container">
        @if(isset($tip))

        <div class="row">
            <div class="col-md-12">
                <h4 class="alert alert-success">{{$tip}}</h4>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body" style="font-size:120%">
                      @include('message.message_info')
                        <hr>
                        <div class="row">
                            <div class="col-md-2 bold">Reply Message:</div>
                            <div class="col-md-10">{{$message->reply_message}}</div>
                        </div>
                        <br>
                        @if(isset($action)&&'delete')

                            <div class="row">
                                <div class="col-md-2 col-md-offset-4" >
                                    <form action="{{url('message/'.$message->id.'/delete')}}" class="modal fade" id="deleteForm" method="post">
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
                                    <a class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#deleteForm" style="width:100%">Delete</a>

                                </div>
                                <div class="col-md-2 text-center" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('message/manage')}}">Back</a>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-2 text-center col-md-offset-5" >
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('messages')}}">Back</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection