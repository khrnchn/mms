<div class="min-h-screen bg-emerald-50">
    <livewire:hero-section />

    <!-- Prayer Times Section -->
    <div id="prayer-times" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-emerald-900 text-center mb-8">
            Prayer Times
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($prayerTimes as $prayer => $time)
            <div class="bg-white rounded-lg shadow-sm p-6 text-center transform transition duration-500 hover:scale-105">
                <h3 class="text-lg font-medium text-emerald-800">{{ $prayer }}</h3>
                <p class="mt-2 text-2xl font-semibold text-emerald-600">{{ $time }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Events Section -->
    <div id="events" class="bg-emerald-600/5 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-emerald-900 text-center mb-8">
                Upcoming Events
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($upcomingEvents as $event)
                <div class="bg-white rounded-lg shadow-sm p-6 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                    <h3 class="text-xl font-semibold text-emerald-800">{{ $event['title'] }}</h3>
                    <div class="mt-2 text-emerald-600">
                        <p class="text-sm">{{ $event['date'] }}</p>
                        <p class="font-medium">{{ $event['time'] }}</p>
                    </div>
                    <p class="mt-4 text-emerald-700">This is a testing description.</p>
                    <a href="#" class="mt-4 inline-flex items-center text-emerald-600 hover:text-emerald-700">
                        Learn More
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <livewire:contact-us />

    <livewire:newsletter />

    <livewire:footer />
</div>