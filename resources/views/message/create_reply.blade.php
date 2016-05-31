@extends('layouts.admin')
@section('title','Message Reply')
@section('content')
    @include('errors.errors')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body" style="font-size: 120%">
                       @include("message.message_info")
                        <hr>
                            <form action="{{url('message/'.$message->id.'/reply')}}" method="post" id="replyForm" class="form-horizontal">
                                <input type="hidden" name="_method" value="PUT">
                                {{csrf_field()}}
                                <div class="form-group">
                                 <label for="reply_message" class="col-md-2 form-label">Reply Message:</label>
                                <div class="col-md-10">
                                    <textarea name="reply_message" class="form-control" required rows="6">{{old('reply_message')}}</textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-4">
                                        <button class="btn btn-success btn-primary btn-lg" style="width: 100%">Reply</button>
                                    </div>
                                    <div class="col-md-2 col-md-offset-1">
                                    <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('messages')}}">Back</a>
                                        </div>
                                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection