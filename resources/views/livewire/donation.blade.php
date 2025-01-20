<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Support Our Mosque</h1>

    <form wire:submit.prevent="submitDonation" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <!-- Name Field -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your name"
            />
            @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter your email"
            />
            @error('email')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- Amount Field -->
        <div class="mb-6">
            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount (RM)</label>
            <input
                type="number"
                id="amount"
                wire:model="amount"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter donation amount"
            />
            @error('amount')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- Donation Type Field -->
        <div class="mb-6">
            <label for="donation_type" class="block text-gray-700 text-sm font-bold mb-2">Donation Type</label>
            <select
                id="donation_type"
                wire:model="donation_type"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Select Donation Type</option>
                <option value="sedekah">Sedekah</option>
                <option value="infaq">Infaq</option>
                <option value="ramadhan">Ramadhan</option>
            </select>
            @error('donation_type')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Donate Now
            </button>
        </div>
    </form>

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
</div>