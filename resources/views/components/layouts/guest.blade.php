<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="md:hidden lg:hidden">
        <x-slot:brand>
            <img src="{{ asset('images/orange.png') }}" width="30" />
            <span
                class="font-bold text-3xl m-2 bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text text-transparent">
                orange
            </span>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>

    </x-nav>

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-nav mx-auto sticky full-width bg-base-100 border-gray-100 border-b top-0 z-10 class="hidden md:block lg:block">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <div class="flex-1 flex items-center">

                <a href="/" wire:navigate="">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('images/orange.png') }}" width="30" />
                        <span
                            class="font-bold text-3xl mr-3 bg-gradient-to-r from-amber-500 to-amber-300 bg-clip-text text-transparent">
                            Asibeza
                        </span>
                    </div>
                </a>

            </div>
        </x-slot:brand>


        {{-- Right side actions --}}
        <x-slot:actions>
            {{-- <x-button @click.stop="$dispatch('mary-search-open')" icon="o-magnifying-glass"
                class="btn-ghost rounded-2xl btn-sm bg-base-200/70">
                Search <kbd class="kbd kbd-xs">⊞ win + /</kbd>
            </x-button> --}}

            <x-button label="" icon="o-bell" link="###" class="btn normal-case btn-ghost btn-sm" responsive>
                {{--
                <x-badge value="3" class="badge-primary font-mono" /> --}}
            </x-button>

            <x-theme-toggle class="btn btn-circle" />
            @auth
                <x-dropdown right>
                    <x-slot:trigger>
                        <x-button label="" icon="o-user-circle" class="btn-ghost btn-sm" responsive>
                            {{ auth()->user()->name }}
                        </x-button>
                    </x-slot:trigger>

                    <x-menu-item title="Profile" icon="o-user" link="{{ route('users.profile') }}" />


                    <x-menu-separator />

                    <x-menu-item title="Logout" icon="o-power" link="{{ route('logout') }}" />
                </x-dropdown>
            @else
                <x-button label="Login" icon="o-user-circle" link="{{ route('login') }}"
                    class="btn normal-case btn-ghost btn-sm" type="button">
                </x-button>
            @endauth

        </x-slot:actions>
    </x-nav>

    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>

        {{-- The `$slot` goes here --}}
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
</body>

</html>
