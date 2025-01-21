<div id="clubs" class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-emerald-900 mb-8 text-center">Mosque Clubs</h2>

        {{-- Flash Messages --}}
        @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {!! session('error') !!}
        </div>
        @endif

        @if($clubs->isEmpty())
        {{-- Empty State --}}
        <div class="text-center py-12 px-4">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <h3 class="mt-2 text-xl font-semibold text-gray-900">No Active Clubs</h3>
            <p class="mt-1 text-gray-500">There are currently no active mosque clubs.</p>
        </div>
        @else
        {{-- Clubs Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
            @foreach($clubs as $club)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-emerald-800 mb-2">{{ $club->name }}</h3>

                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $club->location ?? 'Location Not Specified' }}
                    </div>

                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($club->description, 100, '...') }}
                    </p>

                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <span class="font-semibold">{{ $club->users_count }}</span> Members
                            @if ($club->participants_limit !== null || $club->participants_limit !== 0)
                            / {{ $club->participants_limit }} Limit
                            @endif
                        </div>

                        {{-- Join Button --}}
                        @if ($club->participants_limit !== null && $club->users_count >= $club->participants_limit)
                        <span class="text-sm text-red-500">Full</span>
                        @else
                        <button
                            wire:click="joinClub({{ $club->id }})"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm hover:bg-emerald-700 transition duration-300">
                            Join Club
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>