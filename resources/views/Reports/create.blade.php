<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFO Melding Indienen - UFO Meldpunt Nederland</title>
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
                        <a href="/meld" class="text-green-400 px-3 py-2 rounded-md text-sm font-medium">Meld UFO</a>
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
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- UFO Report Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-800 rounded-lg shadow-xl p-8">
            <h1 class="text-3xl font-bold text-green-400 mb-6 text-center">
                <i class="fas fa-user-alien mr-2"></i>UFO Melding Indienen
            </h1>
            
            @if($errors->any())
                <div class="bg-red-600/20 border border-red-500 text-red-300 px-4 py-3 mb-6 rounded">
                    <strong>Er zijn fouten in uw formulier:</strong>
                    <ul class="mt-2">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-600/20 border border-green-500 text-green-300 px-4 py-3 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                @auth
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 mb-6 rounded">
                    <p><strong>Ingelogd als:</strong> {{ auth()->user()->name }} ({{ auth()->user()->email }})</p>
                    <p class="text-sm">Deze melding wordt gekoppeld aan uw account.</p>
                </div>
                @else
                <input type="hidden" name="guest" value="true">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Uw Naam *</label>
                        <input type="text" name="reporter_name" value="{{ old('reporter_name') }}" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('reporter_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Adres *</label>
                        <input type="email" name="reporter_email" value="{{ old('reporter_email') }}" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('reporter_email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @endauth

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Datum & Tijd Waarneming *</label>
                        <input type="datetime-local" name="incident_datetime" value="{{ old('incident_datetime') }}" 
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('incident_datetime')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Locatie *</label>
                        <input type="text" name="location" value="{{ old('location') }}" placeholder="Bijv. Amsterdam, Noord-Holland"
                               class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('location')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Categorie *</label>
                    <select name="category" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        <option value="">Selecteer een categorie</option>
                        <option value="licht" {{ old('category') == 'licht' ? 'selected' : '' }}>Vreemd licht</option>
                        <option value="object" {{ old('category') == 'object' ? 'selected' : '' }}>Vliegend object</option>
                        <option value="ontmoeting" {{ old('category') == 'ontmoeting' ? 'selected' : '' }}>Ontmoeting</option>
                        <option value="geluid" {{ old('category') == 'geluid' ? 'selected' : '' }}>Vreemd geluid</option>
                        <option value="anders" {{ old('category') == 'anders' ? 'selected' : '' }}>Anders</option>
                    </select>
                    @error('category')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Beschrijving *</label>
                    <textarea name="description" rows="6" placeholder="Beschrijf uw waarneming in detail (minimaal 50 karakters)" 
                              class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Foto (optioneel)</label>
                    <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <p class="text-gray-400 text-sm mt-1">Maximaal 2MB, alleen JPEG/PNG</p>
                    @error('photo')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-all transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Melding Indienen
                    </button>
                </div>
            </form>
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