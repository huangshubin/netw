<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form method="post" id="aliPayForm" action="{{$actionUrl}}" style="display: none;">
    {!! csrf_field() !!}
    @foreach($alipayParas as $key=>$value)
        <input type="hidden" name="{{$key}}" value="{{$value}}">
    @endforeach
</form>

<script type="application/javascript" src="{{asset('js/built-all.js')}}"></script>
<script type="text/javascript">
    $(document).ready(
            function () {
                $('#aliPayForm').submit();
            }

    );
</script>
</body>
</html>