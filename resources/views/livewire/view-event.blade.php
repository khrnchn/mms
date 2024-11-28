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
        </div>

        {{-- Registration Form --}}
        <div class="p-6">
            @if(session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative pb-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative pb-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-emerald-900 mb-4">Event Registration</h2>
            <form wire:submit.prevent="registerForEvent">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-emerald-700 font-medium mb-2">Full Name</label>
                        <input 
                            type="text" 
                            wire:model="name" 
                            id="name" 
                            class="w-full px-3 py-2 border border-emerald-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required
                        >
                        @error('name') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-emerald-700 font-medium mb-2">Email Address</label>
                        <input 
                            type="email" 
                            wire:model="email" 
                            id="email" 
                            class="w-full px-3 py-2 border border-emerald-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required
                        >
                        @error('email') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-emerald-700 font-medium mb-2">Phone Number</label>
                        <input 
                            type="tel" 
                            wire:model="phone" 
                            id="phone" 
                            class="w-full px-3 py-2 border border-emerald-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required
                        >
                        @error('phone') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full bg-emerald-600 text-white py-2 rounded-md hover:bg-emerald-700 transition duration-300"
                        >
                            Register for Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>