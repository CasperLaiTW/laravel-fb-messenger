<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Facebook Messenger Chatbot Debug Router</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/styles/default.min.css">
</head>
<body>
    <div id="app">
    </div>
    <script>
        window.pusherConfig = Object.assign({
            key: '{{ config('broadcasting.connections.pusher.key') }}',
        }, {!! json_encode(config('broadcasting.connections.pusher.options'))  !!});
    </script>
    <script src="/vendor/fb-messenger/dist.js"></script>
</body>
</html>