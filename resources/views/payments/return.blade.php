@extends('layouts.app')

@section('title', 'Bedankt voor Uw Donatie')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-xl p-8 text-center">
        <div class="mb-6">
            <i class="fas fa-heart text-6xl text-blue-400"></i>
        </div>
        <h1 class="text-3xl font-bold text-blue-400 mb-4">Bedankt voor Uw Donatie!</h1>
        <p class="text-xl text-gray-300 mb-6">
            Uw steun helpt ons bij het onderzoek naar UFO-melding #{{ $report->id }}.
        </p>
        
        <div class="bg-gray-700 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-white mb-3">Uw bijdrage maakt het verschil:</h3>
            <div class="text-left space-y-2">
                <p class="text-gray-300"><i class="fas fa-check text-green-400 mr-2"></i>Wetenschappelijk onderzoek wordt gefinancierd</p>
                <p class="text-gray-300"><i class="fas fa-check text-green-400 mr-2"></i>Database en website blijven online</p>
                <p class="text-gray-300"><i class="fas fa-check text-green-400 mr-2"></i>Onderzoeksteam kan uitbreiden</p>
                <p class="text-gray-300"><i class="fas fa-check text-green-400 mr-2"></i>Nieuwe apparatuur wordt aangeschaft</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
            <a href="{{ route('home') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg">
                <i class="fas fa-home mr-2"></i>Terug naar Home
            </a>
            <a href="{{ route('reports.my-reports') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                <i class="fas fa-list mr-2"></i>Mijn Meldingen
            </a>
            <a href="{{ route('reports.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Nieuwe Melding
            </a>
        </div>
    </div>
</div>
@endsection