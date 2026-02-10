<!DOCTYPE html>
<html>
<head>
    <title>Dashboard SPP</title>
</head>
<body>

<h1>Selamat Datang, {{ auth()->user()->name }}</h1>

<p>Role Anda: <strong>{{ auth()->user()->role }}</strong></p>

<a href="/logout">Logout</a>

</body>
</html>
