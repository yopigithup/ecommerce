<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
    {{-- NAVBAR mobile only --}}
    @yield('content')
    <x-nav sticky class="md:hidden lg:hidden">
        <x-slot:brand>
            <img src="{{ asset('images/orange.png') }}" width="30" />
            <span
                class="m-2 text-3xl font-bold text-transparent bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text">
                orange
            </span>
        </x-slot:brand>

        <x-slot:actions>
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-nav mx-auto sticky full-width bg-base-100 border-gray-100 border-b top-0 z-10 class="hidden md:block lg:block">
        <x-slot:brand>
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <div class="flex items-center flex-1">
                <a href="/" wire:navigate="">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('images/orange.png') }}" width="30" />
                        <span
                            class="mr-3 text-3xl font-bold text-transparent bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text">
                            Asbeza
                        </span>
                    </div>
                </a>
            </div>
        </x-slot:brand>

        <x-slot:actions>


            <livewire:cart-notification />
            <x-theme-toggle class="btn btn-circle" />

            @auth
                <x-dropdown right>


                    <x-slot:trigger>
                        <x-button label="" icon="o-user-circle" class="btn-ghost btn-sm" responsive>
                            {{ auth()->user()->name }}
                        </x-button>
                        @if (auth()->user()->name === 'admin')
                            <x-button link="{{ route('users.index') }}" label="" icon="o-squares-plus"
                                class="btn-ghost btn-sm" responsive>
                            </x-button>
                        @endif

                        @if (auth()->user()->name !== 'admin')
                            <x-button link="{{ route('orders.show') }}" label="" icon="o-squares-plus"
                                class="btn-ghost btn-sm" responsive>
                            </x-button>
                        @endif


                    </x-slot:trigger>
                    <x-menu-item title="Profile" icon="o-user" link="{{ route('users.profile') }}" />
                    <x-menu-item title="Profile" icon="o-user" link="{{ route('users.profile') }}" />

                    <x-menu-separator />
                    <x-menu-item title="Logout" icon="o-power" link="{{ route('logout') }}" />
                </x-dropdown>
            @else
                <x-button label="Login" icon="o-user-circle" link="{{ route('login') }}"
                    class="normal-case btn btn-ghost btn-sm" type="button">
                </x-button>
            @endauth
        </x-slot:actions>
    </x-nav>

    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- Theme toggle --}}
    <x-theme-toggle class="hidden" />

    {{-- TOAST area --}}
    <x-toast />

    {{-- SPOTLIGHT --}}
    <x-spotlight shortcut="meta.slash" search-text="search by title or category name ..." />

    {{-- Include Livewire Scripts --}}
    @livewireScripts
</body>

</html>
