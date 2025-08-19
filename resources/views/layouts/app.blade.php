<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UFO Meldpunt Nederland')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <nav class="bg-black/50 backdrop-blur-sm border-b border-green-500/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-green-400 text-xl font-bold">
                        <i class="fas fa-user-alien mr-2"></i>UFO Meldpunt
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                        <a href="{{ route('reports.create') }}" class="nav-link">Meld UFO</a>
                        @auth
                            <a href="{{ route('reports.my-reports') }}" class="nav-link">Mijn Meldingen</a>
                        @endauth
                        <a href="{{ route('about') }}" class="nav-link">Over Ons</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Inloggen</a>
                        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md text-sm font-medium transition-colors">Registreren</a>
                    @else
                        <div class="relative">
                            <span class="text-gray-300">Welkom, {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                                @csrf
                                <button type="submit" class="text-red-400 hover:text-red-300">Uitloggen</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @if(session('success'))
            <div class="bg-green-600/20 border border-green-500 text-green-300 px-4 py-3 mx-4 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-600/20 border border-red-500 text-red-300 px-4 py-3 mx-4 mt-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-black/50 border-t border-green-500/30 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2025 UFO Meldpunt Nederland. Alle rechten voorbehouden.</p>
                <p class="text-sm mt-2">Voor een veiligere samenleving, ook in de ruimte.</p>
            </div>
        </div>
    </footer>

    <style>
        .nav-link {
            @apply text-gray-300 hover:text-green-400 px-3 py-2 rounded-md text-sm font-medium transition-colors;
        }
    </style>
</body>
</html>