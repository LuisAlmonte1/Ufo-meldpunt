<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedankt voor Uw Melding - UFO Meldpunt Nederland</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <!-- Navigation -->
    <nav class="bg-black/50 backdrop-blur-sm border-b border-green-500/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-green-400 text-xl font-bold">
                        <i class="fas fa-user-alien mr-2"></i>UFO Meldpunt
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="/meld" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Meld UFO</a>
                        <a href="/over-ons" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Over Ons</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Thank You Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-800 rounded-lg shadow-xl p-8 text-center">
            <div class="mb-6">
                <i class="fas fa-check-circle text-6xl text-green-400"></i>
            </div>
            <h1 class="text-3xl font-bold text-green-400 mb-4">Bedankt voor Uw Melding!</h1>
            <p class="text-xl text-gray-300 mb-6">
                Uw UFO-melding (#{{ $report->id }}) is succesvol ontvangen en zal worden onderzocht.
            </p>
            
            <div class="bg-gray-700 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-white mb-3">Overzicht van Uw Melding:</h3>
                <div class="text-left space-y-2">
                    <p><strong class="text-gray-300">Datum/Tijd:</strong> {{ $report->incident_datetime }}</p>
                    <p><strong class="text-gray-300">Locatie:</strong> {{ $report->location }}</p>
                    <p><strong class="text-gray-300">Categorie:</strong> {{ ucfirst($report->category) }}</p>
                    @if($report->photo_path)
                        <p><strong class="text-gray-300">Foto:</strong> Toegevoegd</p>
                    @endif
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-gray-300">
                    Bedankt voor uw bijdrage aan het UFO-onderzoek in Nederland!
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <a href="/" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg">
                        <i class="fas fa-home mr-2"></i>Terug naar Home
                    </a>
                    <a href="/meld" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                        <i class="fas fa-plus mr-2"></i>Nieuwe Melding
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black/50 border-t border-green-500/30 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2025 UFO Meldpunt Nederland. Alle rechten voorbehouden.</p>
                <p class="text-sm mt-2">Voor een veiligere samenleving, ook in de ruimte.</p>
            </div>
        </div>
    </footer>
</body>
</html>