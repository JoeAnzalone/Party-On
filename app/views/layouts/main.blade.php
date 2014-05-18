<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Party On!</title>
    {{ $styles }}
</head>
<body>
    @if(Session::has('flash'))
        <div class="flash-message {{ Session::get('flash.class') }}">
        {{ Session::get('flash.message') }}
        </div>
    @endif
    {{ $content }}
    {{ $scripts }}
</body>
</html>
