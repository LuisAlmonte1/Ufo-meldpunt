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
                    @auth
                        <span class="text-gray-300">Welkom, {{ auth()->user()->name }}</span>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300 px-3 py-2 rounded-md text-sm font-medium">Uitloggen</button>
                        </form>
                    @else
                        <a href="/login" class="text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium">Inloggen</a>
                        <a href="/register" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">Registreren</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- UFO Report Form -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-800 rounded-lg shadow-xl p-8">
            <h1 class="text-3xl font-bold text-green-400 mb-2">
                <i class="fas fa-user-alien mr-2"></i>UFO Melding Indienen
            </h1>
            <p class="text-gray-300 mb-8">
                Heeft u iets ongewoons gezien aan de hemel? Deel uw waarneming met ons!
            </p>

            @if ($errors->any())
                <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/meld" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Guest Information (only if not logged in) -->
                @guest
                    <div class="bg-yellow-600/20 border border-yellow-500/50 rounded-lg p-4 mb-6">
                        <h3 class="text-yellow-400 font-semibold mb-3">
                            <i class="fas fa-info-circle mr-2"></i>Uw Contactgegevens
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="reporter_name" class="block text-sm font-medium text-gray-300 mb-2">Naam *</label>
                                <input type="text" 
                                       id="reporter_name" 
                                       name="reporter_name" 
                                       value="{{ old('reporter_name') }}"
                                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       required>
                            </div>
                            <div>
                                <label for="reporter_email" class="block text-sm font-medium text-gray-300 mb-2">E-mail *</label>
                                <input type="email" 
                                       id="reporter_email" 
                                       name="reporter_email" 
                                       value="{{ old('reporter_email') }}"
                                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       required>
                            </div>
                        </div>
                    </div>
                @endguest

                <!-- Incident Details -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-green-400">
                        <i class="fas fa-calendar-alt mr-2"></i>Wanneer en Waar?
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="incident_datetime" class="block text-sm font-medium text-gray-300 mb-2">Datum & Tijd *</label>
                            <input type="datetime-local" 
                                   id="incident_datetime" 
                                   name="incident_datetime" 
                                   value="{{ old('incident_datetime') }}"
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-300 mb-2">Locatie *</label>
                            <input type="text" 
                                   id="location" 
                                   name="location" 
                                   value="{{ old('location') }}"
                                   placeholder="Bijv. Amsterdam, Vondelpark"
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-tags mr-2"></i>Categorie *
                    </label>
                    <select id="category" 
                            name="category" 
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            required>
                        <option value="">Selecteer een categorie</option>
                        <option value="licht" {{ old('category') == 'licht' ? 'selected' : '' }}>Vreemd licht</option>
                        <option value="object" {{ old('category') == 'object' ? 'selected' : '' }}>Onbekend object</option>
                        <option value="ontmoeting" {{ old('category') == 'ontmoeting' ? 'selected' : '' }}>Ontmoeting</option>
                        <option value="geluid" {{ old('category') == 'geluid' ? 'selected' : '' }}>Vreemd geluid</option>
                        <option value="anders" {{ old('category') == 'anders' ? 'selected' : '' }}>Anders</option>
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-edit mr-2"></i>Beschrijving *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="6" 
                              placeholder="Beschrijf wat u heeft gezien zo gedetailleerd mogelijk..."
                              class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                              required>{{ old('description') }}</textarea>
                    <p class="text-sm text-gray-400 mt-1">Minimaal 10 karakters</p>
                </div>

                <!-- Photo Upload -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-camera mr-2"></i>Foto (optioneel)
                    </label>
                    <input type="file" 
                           id="photo" 
                           name="photo" 
                           accept="image/jpeg,image/png,image/jpg"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700">
                    <p class="text-sm text-gray-400 mt-1">Toegestane formaten: JPEG, PNG, JPG. Max 2MB.</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="/" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-300">
                        Annuleren
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Melding Indienen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Information Box -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-blue-900/50 border border-blue-500/30 rounded-lg p-6">
            <h3 class="text-blue-400 font-semibold mb-3">
                <i class="fas fa-info-circle mr-2"></i>Tips voor een goede melding
            </h3>
            <ul class="text-gray-300 space-y-2">
                <li><i class="fas fa-check text-green-400 mr-2"></i>Wees zo specifiek mogelijk over tijd en locatie</li>
                <li><i class="fas fa-check text-green-400 mr-2"></i>Beschrijf de vorm, grootte en beweging van het object</li>
                <li><i class="fas fa-check text-green-400 mr-2"></i>Vermeld weersomstandigheden en zichtbaarheid</li>
                <li><i class="fas fa-check text-green-400 mr-2"></i>Voeg foto's of video's toe indien beschikbaar</li>
            </ul>
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