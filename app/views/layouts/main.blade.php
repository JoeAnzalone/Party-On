<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Party On!</title>
</head>
<body>
    @if(Session::has('flash'))
        <div class="flash-message {{ Session::get('flash.class') }}">
        {{ Session::get('flash.message') }}
        </div>
    @endif
    {{ $content }}
</body>
</html>
