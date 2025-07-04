@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">🕉 Choose Your Pandit</h1>
    <p class="text-center text-gray-600 mb-12">
        Select a Pandit for your ritual. You can view their experience, reviews, and more details before making your choice. 
        All our Pandits are verified and highly rated!
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($pandits as $pandit)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
            <div class="relative">
                <img src="{{ $pandit['profile_picture'] }}" alt="{{ $pandit['name'] }}" class="w-full h-48 object-cover">
                <div class="absolute top-4 right-4">
                    <span class="bg-yellow-400 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $pandit['rating'] }} ⭐
                    </span>
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold mb-2">{{ $pandit['name'] }}</h2>
                <p class="text-gray-600 mb-2">{{ $pandit['title'] }}</p>
                <p class="text-sm text-gray-500 mb-4">{{ $pandit['specialization'] }}</p>

                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $pandit['experience_years'] }}+ years of experience</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $pandit['completed_pujas'] }} pujas completed</span>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Expertise Areas:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($pandit['expertise_areas'] as $area)
                        <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded">{{ $area }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Languages:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($pandit['languages_known'] as $language)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $language }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="tel:{{ $pandit['phone'] }}" class="inline-flex items-center text-orange-600 hover:text-orange-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contact
                    </a>
                    <a href="{{ route('pandits.show', $pandit['id']) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition duration-300">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 