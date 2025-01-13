<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ $topic->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $topic->description }}</p>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Create Reply Form --}}
    @auth
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Post a Reply</h2>
            <form wire:submit.prevent="createReply">
                <div class="space-y-4">
                    <div>
                        <label for="content" class="block text-gray-700 font-medium mb-2">Reply</label>
                        <textarea
                            wire:model="content"
                            id="content"
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
                            Post Reply
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
            <p>Please <a href="/panel/login" class="font-semibold underline">log in</a> to post a reply.</p>
        </div>
    @endauth

    {{-- List of Replies --}}
    <div class="space-y-4">
        @foreach ($replies as $reply)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <p class="text-gray-600">{{ $reply->content }}</p>
                <p class="text-sm text-gray-500 mt-2">Posted by: {{ $reply->user->name }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $replies->links() }}
    </div>
</div>