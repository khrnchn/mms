<div id="events" class="bg-emerald-600/5 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-emerald-900 text-center mb-8">
            Upcoming Events
        </h2>

        @if($upcomingEvents->isEmpty())
        <!-- Message when no events are available -->
        <div class="text-center text-emerald-700">
            <p class="text-xl font-semibold">No upcoming events at the moment.</p>
            <p class="mt-2">Please check back later for updates.</p>
        </div>
        @else
        <!-- Display events when available -->
        <div class="space-y-6 max-h-96 overflow-y-auto scrollbar-thin">
            @foreach($upcomingEvents as $event)
            <div class="bg-white rounded-lg shadow-sm p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-start">
                    <div class="mr-6 text-emerald-600">
                        <p class="text-sm font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</p>
                        <p class="text-2xl font-bold">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-emerald-800">{{ $event->name }}</h3>
                        <p class="mt-2 text-emerald-700">{{ $event->time }}</p>
                        <p class="mt-4 text-emerald-700">{{ $event->description }}</p>
                        <a href="{{ route('events.view', ['eventId' => $event->id]) }}" class="mt-4 inline-flex items-center text-emerald-600 hover:text-emerald-700">
                            Register
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>