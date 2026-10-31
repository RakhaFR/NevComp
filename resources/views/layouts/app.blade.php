<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TrainTix')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-white font-sans text-ink antialiased flex flex-col justify-between">
    <div>
        <header class="relative z-10 shadow-md bg-white">
            <div class="mx-auto flex h-16 max-w-[1440px] items-center justify-between px-4 sm:px-6 lg:h-17 lg:px-12">
                <a href="{{ route('schedules.index') }}"
                    class="flex items-center gap-1.5 text-xl font-bold text-brand sm:text-2xl">
                    <x-icon name="train" class="size-6 text-ink sm:size-7" /> TRAINTIX
                </a>

                <div class="flex items-center gap-4 text-base sm:gap-8">
                    <a href="{{ route('schedules.index') }}" aria-label="Jadwal"
                        class="flex items-center gap-2 hover:text-brand transition {{ request()->routeIs('schedules.*') ? 'text-brand font-semibold' : '' }}">
                        <x-icon name="calendar" /><span class="hidden sm:inline">Jadwal</span>
                    </a>

                    @auth
                        <span class="hidden items-center gap-2 md:flex font-medium">
                            <x-icon name="user" /> {{ auth()->user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <x-button type="submit" class="h-9 px-4 sm:w-[115px]">Keluar</x-button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-brand">Masuk</a>
                        <x-button :href="route('register')" class="h-9 px-4 sm:w-[115px]">Daftar</x-button>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-[1440px] px-4 pb-16 sm:px-6 lg:px-12">
            <x-flash />
            @yield('content')
        </main>
    </div>

    <footer class="border-t border-line py-6 text-center text-xs text-mute mt-auto">
        &copy; 2026 TrainTix NevComp
    </footer>
</body>

</html>
