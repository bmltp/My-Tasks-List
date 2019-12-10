<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Tasks</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>
