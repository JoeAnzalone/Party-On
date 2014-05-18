<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Party On!</title>
    <meta name="viewport" content="width=device-width">
    {{ $styles }}
</head>
<body>
    <div class="page">
    @if(Session::has('flash'))
        <div class="flash-message {{ Session::get('flash.class') }}">
        {{ Session::get('flash.message') }}
        </div>
    @endif
    {{ $content }}
    {{ $scripts }}
    </div>
</body>
</html>
