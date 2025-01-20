<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Event Details Section --}}
        <div class="p-6 bg-emerald-50">
            <div class="flex items-center mb-6">
                <div class="mr-6 text-emerald-600">
                    <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</p>
                    <p class="text-2xl font-bold">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</p>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-emerald-900">{{ $event->name }}</h1>
                    <p class="text-emerald-700 mt-2">{{ $event->time }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-xl font-semibold text-emerald-800 mb-2">Event Description</h2>
                <p class="text-emerald-700">{{ $event->description }}</p>
            </div>

            {{-- Additional Event Details --}}
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold text-emerald-800">Location</p>
                    <p class="text-emerald-700">{{ $event->location }}</p>
                </div>
                <div>
                    <p class="font-semibold text-emerald-800">Duration</p>
                    <p class="text-emerald-700">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} 
                        - 
                        {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}
                    </p>
                </div>
            </div>

            {{-- Participants Limit and Current Registrations --}}
            <div class="mt-6">
                <p class="font-semibold text-emerald-800">Participants</p>
                <p class="text-emerald-700">
                    @if ($event->participants_limit !== null)
                        {{ App\Models\EventParticipant::where('event_id', $event->id)->count() }} / {{ $event->participants_limit }} registered
                    @else
                        No limit ({{ App\Models\EventParticipant::where('event_id', $event->id)->count() }} registered)
                    @endif
                </p>
            </div>
        </div>

        {{-- Registration Section --}}
        <div class="p-6">
            @if(session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-emerald-900 mb-4">Event Registration</h2>

            @auth
                {{-- Check if the event has reached its participants limit --}}
                @if ($event->participants_limit !== null && App\Models\EventParticipant::where('event_id', $event->id)->count() >= $event->participants_limit)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        This event has reached its maximum number of participants.
                    </div>
                @else
                    {{-- Registration Button for Authenticated Users --}}
                    <button 
                        wire:click="registerForEvent" 
                        class="w-full bg-emerald-600 text-white py-2 rounded-md hover:bg-emerald-700 transition duration-300"
                    >
                        Register for Event
                    </button>
                @endif
            @else
                {{-- Prompt for Unauthenticated Users --}}
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <p>You must <a href="/panel/login" class="font-semibold underline">log in</a> to register for this event.</p>
                </div>
            @endauth
        </div>
    </div>
</div>