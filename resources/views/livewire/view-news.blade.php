<div class="py-12 bg-gray-100" id="news-view">
    <div class="container mx-auto px-4">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-emerald-800 mb-4">{{ $news->title }}</h2>
            <p class="text-emerald-600">{{ $news->published_at->format('M d, Y') }}</p>
        </div>

        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            @if($news->image)
            <img
                src="{{ Storage::url($news->image) }}"
                alt="{{ $news->title }}"
                class="w-full h-64 object-cover" />
            @else
            <div class="w-full h-64 bg-emerald-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                </svg>
            </div>
            @endif
        </div>

        <div class="mt-8 prose prose-emerald max-w-none text-justify space-y-4 leading-relaxed">
            {!! $news->content !!}
        </div>

        @if($news->author)
        <div class="mt-8 flex items-center space-x-4 text-emerald-600">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ $news->author->name }}</span>
            </div>
        </div>
        @endif
    </div>
</div>