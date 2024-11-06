<div id="prayer-times" class="bg-emerald-600/5 max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold text-emerald-900 text-center mb-8">
        Prayer Times
    </h2>

    <!-- Display Current Time -->
    <div class="flex justify-center mb-6">
        <div class="text-2xl font-bold text-emerald-800" id="live-clock">
            {{ $currentTime }}
        </div>
    </div>

    <!-- Prayer Times Grid -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        @foreach($prayerTimes as $prayer => $time)
        <div class="bg-white rounded-lg shadow-sm p-6 text-center transform transition duration-500 hover:scale-105 {{ $currentPrayer === $prayer ? 'border-4 border-emerald-600 bg-emerald-100' : '' }}">
            <h3 class="text-lg font-medium {{ $currentPrayer === $prayer ? 'text-emerald-700' : 'text-emerald-800' }}">
                {{ $prayer }}
            </h3>
            <p class="mt-2 text-2xl font-semibold {{ $currentPrayer === $prayer ? 'text-emerald-700' : 'text-emerald-600' }}">
                {{ $time }}
            </p>
        </div>
        @endforeach
    </div>

    <!-- Display Next Prayer Time -->
    @if($nextPrayer)
    <div class="mt-8 text-center">
        <div class="text-lg font-bold text-emerald-700">Next Prayer:</div>
        <div class="text-xl font-semibold text-emerald-600">{{ $nextPrayer }} at {{ $prayerTimes[$nextPrayer] }}</div>
    </div>
    @endif
</div>

<script>
    // Update clock every second
    function startLiveClock() {
        setInterval(() => {
            const clock = document.getElementById('live-clock');
            if (clock) {
                const now = new Date();
                clock.textContent = now.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });
            }
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', startLiveClock);
</script>