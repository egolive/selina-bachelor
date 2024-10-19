<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gewinnspiel</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-D6YyM5zc.css') }}">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-primary mb-6 text-center">Teilnahme am Gewinnspiel zur Bachelorarbeit</h1>

                @if($currentDate->lessThan($startDate))
                    <p class="text-gray-700 text-center">
                        Das Gewinnspiel startet am {{ $startDate->format('d.m.Y') }}. Bitte kommen Sie zu einem späteren Zeitpunkt zurück.
                    </p>
                @else
                    <p class="text-gray-700 text-sm mb-6 text-center">
                        Vielen Dank für Ihre Teilnahme an meiner Bachelorarbeit und an der dazugehörigen Umfrage!
                    </p>

                    <p class="text-gray-700 text-sm mb-6 text-center">
                        Als kleines Dankeschön verlose ich unter allen Teilnehmenden vier <a href="https://www.wunschgutschein.de/" target="_blank" class="text-primary hover:underline" rel="noopener">Wunsch Gutscheine</a> im Wert von je 25€. Geben Sie dazu bitte Ihren persönlichen Code, den Sie am Anfang der Umfrage festgelegt haben, in das untenstehende Feld ein und klicken Sie auf <strong>"Prüfen"</strong>, um zu sehen, ob Sie gewonnen haben.
                    </p>

                    @if(session('message'))
                        <p class="mb-6 text-center text-green-600 font-medium">{{ session('message') }}</p>
                    @endif

                    <form action="{{ route('raffle.check') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="code" class="block text-xs font-medium text-gray-700">Ihr persönlicher Code:</label>
                            <input type="text" id="code" name="code" required placeholder="Bitte geben Sie hier Ihren Code ein"
                                   class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-md">
                            <p class="mt-2 text-xs text-gray-500">
                                Buchstabe Vor- und Nachname, den Geburtsmonat und das Geburtsjahr:<br>
                                Anna Mustermann, Geburtsmonat August, Geburtsjahr 1990 = AM081990<br>
                            </p>
                            @if($errors->has('code'))
                                <p class="mt-2 text-xs text-red-600">{{ $errors->first('code') }}</p>
                            @endif
                        </div>
                        <button type="submit"
                                class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 hover:bg-white hover:text-primary hover:border-primary border-2 border-transparent">
                            Prüfen
                        </button>
                        <p class="text-xs text-gray-500 font-bold" style="margin-top: .5rem;">Bitte beachten Sie, dass Sie mindestens 18 Jahre alt sein müssen!</p>
                    </form>

                    <p class="mt-6 text-gray-500 text-center text-xs">
                        Sollten Sie Fragen zur Teilnahme oder technische Schwierigkeiten haben, zögern Sie nicht, mich zu kontaktieren. Viel Glück bei der Verlosung und nochmals vielen Dank für Ihre Unterstützung!
                    </p>
                @endif
            </div>

            <!-- Impressum Section -->
            <div class="text-gray-700 text-center mt-2">
                <p><a href="{{ route('impressum') }}" class="text-primary hover:underline">Impressum</a></p>
            </div>
        </div>
    </div>
</body>
</html>
