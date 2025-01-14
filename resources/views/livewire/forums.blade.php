<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl text-center text-gray-800 font-bold mb-8">Forums</h1>

    <div class="space-y-4">
        @foreach ($forums as $forum)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-emerald-800">{{ $forum->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $forum->description }}</p>
                <p class="text-sm text-gray-500 mt-2">Created by: {{ $forum->user->name }}</p>
                <a href="{{ route('forums.show', $forum) }}" class="mt-4 inline-block text-emerald-600 hover:underline">
                    View Topics →
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $forums->links() }}
    </div>
</div>