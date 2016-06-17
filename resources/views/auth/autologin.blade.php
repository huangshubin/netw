<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form class="form-horizontal" role="form" method="POST" id="loginForm" style="display: none;" action="{{ url('/login') }}">
    {!! csrf_field() !!}


            <input type="email" name="email" value="shubin@1211">
            <input type="password" name="password" value="111111">


</form>

<script type="text/javascript" src="{{asset('js/built-all.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $('#loginForm').submit();

    });
</script>
</body>
</html>
