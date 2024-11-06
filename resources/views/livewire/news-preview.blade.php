<div class="py-12" id="news-preview">
    <div class="container mx-auto px-4">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-emerald-800 mb-4">Latest News</h2>
            <p class="text-emerald-600">Stay updated with our latest news and announcements</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="relative">
                    @if($item->image)
                    <img
                        src="{{ Storage::url($item->image) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-48 object-cover" />
                    @else
                    <div class="w-full h-48 bg-emerald-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                    </div>
                    @endif

                    @if($item->featured)
                    <span class="absolute top-4 right-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-sm">
                        Featured
                    </span>
                    @endif
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-semibold text-emerald-800 mb-3 line-clamp-2">
                        {{ $item->title }}
                    </h3>

                    <p class="text-emerald-600 mb-4 line-clamp-3">
                        {{ strip_tags($item->content) }}
                    </p>

                    <div class="flex items-center justify-between text-sm text-emerald-500">
                        <div class="flex items-center space-x-4">
                            @if($item->author)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $item->author->name }}</span>
                            </div>
                            @endif

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $item->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <a
                        href="{{ route('news.view', $item->slug) }}"
                        class="mt-4 inline-flex items-center text-emerald-600 hover:text-emerald-700 transition-colors">
                        Read More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($news->hasPages())
        <div class="mt-8">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>