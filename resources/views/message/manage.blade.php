@extends('layouts.admin')
@section('title','Message')
@section('styles')
    #msg-container tr td:nth-child(1){
    width:2%;
    }
    #msg-container tr td:nth-child(2){
    width:15%;
    }
    #msg-container tr td:nth-child(3){
    width:15%;
    }
    .table > tbody > tr > td {
    vertical-align: middle;
    }
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages</div>
                    <div class="panel-body">

                        <form action="{{url('message/manage')}}" method="get" class="form-horizontal text-center">
                            <div class="form-group">
                            <div class="col-md-8">
                                <input type="text" placeholder="Name / Phone / Message" name="p" value="{{old('p')}}" id="searchInput" class="form-control">
                            </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label style="padding-left: 15px">
                                            <input type="checkbox" {{old("r")==1?"checked":""}} name="r" value="1" >Replied?
                                        </label>
                                    </div>
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
                                <th>Contact Name</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                <th>Reply</th>
                                <th>Delete</th>
                                </tr>
                                @foreach($messages as $index=>$message)
                                    <tr>
                                        <td>{{$index+1+(null!==old('page') ? (old('page')-1)*5:0)}}</td>
                                        <td>{{$message->name}}</td>
                                        <td>{{$message->phone_number}}</td>
                                        <td>{{str_limit($message->message,100)}}</td>
                                        <td>
                                            @if($message->is_reply)
                                                <span class="label label-success" style="font-size:100%">Replied</span>
                                            @else
                                                <span class="label label-info" style="font-size:100%">No Reply</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('delete',ENTITY_MESSAGE)
                                                <a class="btn btn-primary" style="font-size:100%" href="{{url('message/'.$message->id.'/delete')}}">Delete</a>
                                                @else
                                                <a class="btn btn-primary" style="font-size:100%" href="{{url('message/'.$message->id)}}">Details</a>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer text-right">{!! $messages->appends(['p'=>old('p'),
                    'r'=>old('r')])->links() !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection