<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gewinnspiel</title>
</head>
<body>
<h1>Gewinnspiel</h1>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif

<form action="{{ route('raffle.check') }}" method="POST">
    @csrf
    <label for="code">Dein Code:</label>
    <input type="text" id="code" name="code" required>
    <button type="submit">Prüfen</button>
</form>
</body>
</html>
