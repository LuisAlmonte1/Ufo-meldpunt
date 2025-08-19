<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFO Meldpunt Nederland</title>
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
                        @auth
                            <a href="/mijn-meldingen" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Mijn Meldingen</a>
                        @endauth
                        <a href="/over-ons" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Over Ons</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="/login" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Inloggen</a>
                        <a href="/register" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md text-sm font-medium">Registreren</a>
                    @else
                        <div class="relative flex items-center space-x-4">
                            <span class="text-gray-300">Welkom, {{ auth()->user()->name }}</span>
                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <button type="submit" class="text-red-400 hover:text-red-300 px-3 py-2 rounded-md text-sm font-medium">Uitloggen</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-purple-900 via-blue-900 to-green-900 min-h-screen flex items-center">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-green-400 to-blue-400 bg-clip-text text-transparent">
                UFO Meldpunt Nederland
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300">
                Heeft u iets ongewoons gezien aan de hemel? Deel uw waarneming met ons!
            </p>
            <div class="space-y-4 md:space-y-0 md:space-x-4 md:flex justify-center">
                <a href="/meld" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-all transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>Meld Nu
                </a>
                <a href="#stats" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-all">
                    <i class="fas fa-eye mr-2"></i>Statistieken
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div id="stats" class="bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-gray-700/50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-green-400 mb-2">{{ \App\Models\UfoReport::count() }}</div>
                    <div class="text-gray-300">Totaal Meldingen</div>
                </div>
                <div class="bg-gray-700/50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ \App\Models\UfoReport::whereMonth('created_at', now()->month)->count() }}</div>
                    <div class="text-gray-300">Deze Maand</div>
                </div>
                <div class="bg-gray-700/50 p-6 rounded-lg">
                    <div class="text-3xl font-bold text-purple-400 mb-2">{{ \App\Models\User::count() }}</div>
                    <div class="text-gray-300">Geregistreerde Melders</div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white mb-4">Waarom UFO Meldpunt?</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Wij verzamelen en analyseren UFO-waarnemingen in Nederland om patronen te ontdekken en bewustwording te creëren.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Veilig & Anoniem</h3>
                    <p class="text-gray-300">Uw privacy wordt gerespecteerd. Meld anoniem als gast of registreer voor meer functies.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Wetenschappelijk</h3>
                    <p class="text-gray-300">Alle meldingen worden zorgvuldig geanalyseerd en gedocumenteerd voor onderzoeksdoeleinden.</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Gemeenschap</h3>
                    <p class="text-gray-300">Word onderdeel van een gemeenschap van mensen die het mysterie willen ontrafelen.</p>
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