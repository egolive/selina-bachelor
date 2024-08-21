<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gewinnspiel Ergebnis</title>
</head>
<body>
<h1>{{ $message }}</h1>

@if($voucher_link)
    <p>Hier ist dein Gutschein: <a href="{{ route('voucher.download', ['filename' => $voucher_link]) }}">Gutschein herunterladen</a></p>
@endif

<a href="/gewinnspiel">Zurück zur Eingabe</a>
</body>
</html>
