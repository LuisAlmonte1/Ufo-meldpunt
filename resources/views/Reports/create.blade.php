<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn UFO Meldingen - UFO Meldpunt Nederland</title>
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
                        <a href="/mijn-meldingen" class="text-green-400 px-3 py-2 rounded-md text-sm font-medium">Mijn Meldingen</a>
                        <a href="/over-ons" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Over Ons</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-300">Welkom, {{ auth()->user()->name }}</span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 px-3 py-2 rounded-md text-sm font-medium">Uitloggen</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- My Reports Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-green-400 mb-8">
            <i class="fas fa-list mr-2"></i>Mijn UFO Meldingen
        </h1>

        @if($reports->count() > 0)
            <div class="grid gap-6">
                @foreach($reports as $report)
                    <div class="bg-gray-800 rounded-lg shadow-xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-white">Melding #{{ $report->id }}</h3>
                                <p class="text-gray-300">{{ $report->incident_datetime }} - {{ $report->location }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                </span>
                                @if($report->is_paid)
                                    <div class="mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Ondersteund
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <p class="text-gray-300 mb-2"><strong>Categorie:</strong> {{ ucfirst($report->category) }}</p>
                                <p class="text-gray-300">{{ \Illuminate\Support\Str::limit($report->description, 200) }}</p>
                            </div>
                            <div class="text-center">
                                @if($report->photo_path)
                                    <img src="/storage/{{ $report->photo_path }}" alt="UFO Foto" class="w-32 h-32 object-cover rounded-lg mx-auto">
                                @else
                                    <div class="w-32 h-32 bg-gray-700 rounded-lg mx-auto flex items-center justify-center">
                                        <i class="fas fa-image text-gray-500 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-user-alien text-6xl text-gray-600 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Nog geen meldingen</h3>
                <p class="text-gray-400 mb-6">U heeft nog geen UFO-meldingen ingediend als ingelogde gebruiker.</p>
                <a href="/meld" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Eerste Melding Indienen
                </a>
            </div>
        @endif
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