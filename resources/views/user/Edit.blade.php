@extends('layouts.admin')
@section('title','User Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body" style="font-size:120%">
                        <div class="row">
                            <div class="col-md-2 col-xs-4 text-right bold">User Name:</div>
                            <div class="col-md-10">{{$user->name}}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-xs-4 text-right bold">Email:</div>
                            <div class="col-md-10">{{$user->email}}</div>
                        </div>
                        <hr>

                        <form action="{{url('user/'.$user->id.'/edit')}}"  method="post" class="form-horizontal">
                            {{method_field('put')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="isAdmin" class="col-md-2 col-xs-4 text-right  form-label">Is Admin:</label>
                                <div class="col-md-10">
                                    <input type="checkbox" name="is_admin" @if((null!==old('is_admin')?old('is_admin'):$user->is_admin)==1) checked="checked" @endif
                                           value="1" id="isAdmin">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 form-label text-right">Permissions:</label>
                                <div class="col-md-10">
                                    @php($index=0)
                                    @foreach($all_permissions as $key=>$value)
                                        <label class="checkbox-inline" style="min-width: 140px">
                                            <input type="checkbox" @if(in_array($value,null!==old('permissions') ? old('permissions'): $user->permissions))  checked="checked" @endif name="permissions[{{$key}}]"  id="inlineCheckbox1" value="{{$value}}"> {{$value}}
                                        </label>
                                        @php($index++)
                                        @if($index%3==0)
                                            <br>
                                        @endif
                                    @endforeach

                                 </div>
                            </div>
                            <hr>
                            @if(true)
                                <div class="form-group">
                                    <div class="col-md-2 text-center col-md-offset-4" >
                                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%" >Save</button>
                                    </div>
                                    <div class="col-md-2 text-center" >
                                        <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('user/'.$user->id)}}">Back</a>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-2 text-center col-md-offset-5" >
                                        <a class="btn btn-primary btn-lg" style="width:100%" href="{{url('users')}}">Back</a>
                                    </div>
                                </div>
                            @endif
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection