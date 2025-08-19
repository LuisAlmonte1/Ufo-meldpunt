@extends('layouts.app')

@section('title', 'Mijn UFO Meldingen')

@section('content')
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
                            <p class="text-gray-300">{{ $report->incident_datetime->format('d-m-Y H:i') }} - {{ $report->location }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($report->status === 'nieuw') bg-blue-100 text-blue-800
                                @elseif($report->status === 'in_behandeling') bg-yellow-100 text-yellow-800
                                @elseif($report->status === 'opgelost') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
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
                            <p class="text-gray-300">{{ Str::limit($report->description, 200) }}</p>
                        </div>
                        <div class="text-center">
                            @if($report->photo_path)
                                <img src="{{ Storage::url($report->photo_path) }}" alt="UFO Foto" class="w-32 h-32 object-cover rounded-lg mx-auto">
                            @else
                                <div class="w-32 h-32 bg-gray-700 rounded-lg mx-auto flex items-center justify-center">
                                    <i class="fas fa-image text-gray-500 text-2xl"></i>
                                </div>
                            @endif
                            @if(!$report->is_paid)
                                <a href="{{ route('payments.create', $report) }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                    <i class="fas fa-heart mr-1"></i>Ondersteun
                                </a>
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
            <p class="text-gray-400 mb-6">U heeft nog geen UFO-meldingen ingediend.</p>
            <a href="{{ route('reports.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Eerste Melding Indienen
            </a>
        </div>
    @endif
</div>
@endsection