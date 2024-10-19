<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gewinnspiel Ergebnis</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-D6YyM5zc.css') }}">
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-primary mb-6 text-center">Ergebnis der Gutschein-Verlosung</h1>

            @if($voucher_link)
                <p class="text-gray-700 text-md mb-6 text-center">
                    Herzlichen Glückwunsch! Ihr Code wurde ausgewählt, und Sie haben einen Gutschein gewonnen.
                    <a href="{{ route('voucher.download', ['filename' => $voucher_link]) }}"
                       class="text-white bg-primary border border-transparent font-semibold px-4 py-2 mt-4 inline-block rounded-lg transition-colors duration-300 hover:bg-white hover:text-primary hover:border-primary">
                        Gutschein herunterladen
                    </a>
                </p>
            @else
                <p class="text-gray-700 text-md mb-6 text-center">
                    Vielen Dank für Ihre Teilnahme, leider wurde Ihr Code <strong>nicht ausgewählt</strong>. Ich danken Ihnen dennoch herzlich für Ihre Unterstützung bei meiner Bachelorarbeit!
                </p>
            @endif

            <div class="text-center">
                <a href="/gewinnspiel"
                   class="text-white bg-primary border border-transparent font-semibold px-4 py-2 rounded-lg transition-colors duration-300 hover:bg-white hover:text-primary hover:border-primary inline-block">
                    Zurück zur Eingabe
                </a>
            </div>

            <p class="mt-6 text-gray-500 text-center text-xs">
                Bei Fragen oder Problemen können Sie sich gerne an mich wenden. Nochmals vielen Dank für Ihre Teilnahme!
            </p>
        </div>

        <div class="text-gray-700 text-center mt-2">
                <p><a href="{{ route('impressum') }}" class="text-primary hover:underline">Impressum</a></p>
            </div>
        </div>
    </div>
</body>
</html>

@if($voucher_link)
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2/dist/confetti.browser.min.js" type="text/javascript"></script>
<script>
    $('#confetti-btn').click(function() {

        var end = Date.now() + (8 * 500);
        var colors = ['#e6631a', '#72bedd'];

        (function frame() {
            confetti({
                particleCount: 2,
                angle: 60,
                spread: 100,
                origin: { x: 0 },
                colors: colors
            });
            confetti({
                particleCount: 2,
                angle: 120,
                spread: 90,
                origin: { x: 1 },
                colors: colors
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());

    });
</script>
<script>
    var duration = 8 * 1000;
    var animationEnd = Date.now() + duration;
    var defaults = { startVelocity: 30, spread: 360, ticks: 80, zIndex: 0 };

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    var interval = setInterval(function() {
        var timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        var particleCount = 50 * (timeLeft / duration);
        // since particles fall down, start a bit higher than random
        confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
        confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
    }, 250);
</script>
@endif
</body>
</html>
