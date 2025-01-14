<div class="sticky top-0 z-50">
    <header x-data="{ isOpen: false }" class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo and primary nav items -->
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" wire:navigate class="text-emerald-600 text-lg font-bold">MBTHO</a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-2">
                        @foreach($filteredMenuItems as $index => $item)
                        <a
                            href="{{ $item['route'] }}"
                            @if(!str_starts_with($item['route'], '#' )) wire:navigate @endif
                            @class([
                                'inline-flex items-center px-3 py-2 text-sm font-medium rounded-md transition my-3',
                                'text-white bg-emerald-600 border-b-0' => $item['active'],
                                'text-emerald-500 hover:text-emerald-700 hover:bg-emerald-100' => !$item['active'],
                            ])
                            {{ $item['active'] ? 'aria-current="page"' : '' }}>
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Login/Dashboard Button (Desktop) -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @if(auth()->check())
                    <a
                        href="{{ route('filament.admin.pages.dashboard') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="/panel/login"
                        wire:navigate
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Login
                    </a>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button
                        @click="isOpen = !isOpen"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-emerald-500 hover:text-emerald-600 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500"
                        aria-controls="mobile-menu"
                        :aria-expanded="isOpen">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg x-show="isOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="sm:hidden bg-white"
            id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                @foreach($filteredMenuItems as $index => $item)
                <a
                    href="{{ $item['route'] }}"
                    @if(!str_starts_with($item['route'], '#' )) wire:navigate @endif
                    @click="isOpen = false"
                    @class([
                        'block pl-3 pr-4 py-2 border-l-4 text-base font-medium',
                        'border-emerald-500 text-emerald-700 bg-emerald-50' => $item['active'],
                        'border-transparent text-emerald-500 hover:text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300' => !$item['active'],
                    ])
                    {{ $item['active'] ? 'aria-current="page"' : '' }}>
                    {{ $item['label'] }}
                </a>
                @endforeach
                <div class="mt-4 mx-4">
                    @if(auth()->check())
                        <a
                            href="{{ route('filament.admin.pages.dashboard') }}"
                            wire:navigate
                            @click="isOpen = false"
                            class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-md">
                            Dashboard
                        </a>
                    @else
                        <a
                            href="/panel/login"
                            wire:navigate
                            @click="isOpen = false"
                            class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-md">
                            Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>
</div>