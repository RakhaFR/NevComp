<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') — TrainTix</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans text-ink antialiased">
    <div class="grid min-h-screen lg:grid-cols-[650px_1fr]">
        <aside class="hidden flex-col bg-brand-line px-11 pt-36 lg:flex">
            <h1 class="text-[40px] font-bold leading-tight text-[#0F172A]">Pesan tiket kereta,<br>tanpa ribet.</h1>
            <p class="mt-6 text-sm text-[#334155]">Cari jadwal, pilih kursi, dan konfirmasi booking dalam beberapa
                langkah.</p>
            <img src="{{ asset('images/login-train.png') }}" alt="" class="mt-auto w-full"
                onerror="this.style.display='none'">
        </aside>
        <section class="grid place-items-center p-6">
            <form method="POST" action="@yield('action')" class="w-full max-w-[417px] space-y-6"
                onsubmit="this.querySelector('[type=submit]').disabled=true">
                @csrf
                <div class="text-center">
                    <p class="text-5xl font-bold text-brand">TRAINTIX</p>
                    <p class="mt-1 text-xl">@yield('heading')</p>
                </div>
                @yield('fields')
                <div class="text-center"><x-button type="submit" variant="dark"
                        class="w-[165px]">@yield('submit')</x-button></div>
                <p class="text-center text-xl">@yield('switch')</p>
            </form>
        </section>
    </div>
</body>

</html>
