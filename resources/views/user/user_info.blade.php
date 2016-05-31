
    <div class="row">
        <div class="col-md-2 col-xs-3 text-right bold">User Name:</div>
        <div class="col-md-10">{{$user->name}}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 col-xs-3 text-right bold">Email:</div>
        <div class="col-md-10">{{$user->email}}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 col-xs-3 text-right bold">Is Admin:</div>
        <div class="col-md-10 col-xs-9">{{$user->is_admin?'True':'False'}}</div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2 col-xs-3 text-right bold">Permissions:</div>
        <div class="col-md-10 col-xs-9">{!!implode('<br>',$user->permissions)!!}</div>
    </div>