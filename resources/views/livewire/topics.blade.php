<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ $forum->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $forum->description }}</p>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Create Topic Form --}}
    @auth
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Create a New Topic</h2>
            <form wire:submit.prevent="createTopic">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                        <input
                            type="text"
                            wire:model="title"
                            id="title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            required
                        >
                    </div>
                    <div>
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea
                            wire:model="description"
                            id="description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                            rows="4"
                            required
                        ></textarea>
                    </div>
                    <div>
                        <button
                            type="submit"
                            class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 transition duration-300"
                        >
                            Create Topic
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
            <p>Please <a href="{{ route('login') }}" class="font-semibold underline">log in</a> to create a topic.</p>
        </div>
    @endauth

    {{-- List of Topics --}}
    <div class="space-y-4">
        @foreach ($topics as $topic)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-emerald-800">{{ $topic->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $topic->description }}</p>
                <p class="text-sm text-gray-500 mt-2">Posted by: {{ $topic->user->name }}</p>
                <a href="{{ route('topics.show', $topic) }}" class="mt-4 inline-block text-emerald-600 hover:underline">
                    View Replies →
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $topics->links() }}
    </div>
</div>