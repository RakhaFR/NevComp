@extends('layouts.app')
@section('title', 'Jadwal — TrainTix')
@section('content')
    <section
        class="-mx-4 sm:-mx-6 lg:-mx-12 flex items-center justify-between overflow-hidden bg-gradient-to-r from-brand-line via-brand-tint to-white px-6 lg:px-14">
        <div class="py-10 sm:py-16">
            <h1 class="text-2xl font-bold uppercase sm:text-4xl text-ink">Selamat datang di TrainTix</h1>
            <p class="mt-2 text-lg sm:text-3xl text-mute">Pesan tiket kereta dengan mudah dan cepat</p>
        </div>
        <img src="{{ asset('images/banner-train.png') }}" alt="" class="hidden h-48 md:block object-contain"
            onerror="this.style.display='none'">
    </section>

    <h2 class="mt-10 text-2xl font-semibold sm:mt-12 sm:text-3xl">Cari Jadwal Kereta</h2>
    <form method="GET" action="{{ route('schedules.index') }}" class="mt-6 flex flex-col gap-4 md:flex-row md:items-end">
        <div class="flex-1 space-y-1">
            <label for="origin_id" class="text-base font-medium">Stasiun Asal</label>
            <select name="origin_id" id="origin_id"
                class="h-10 w-full rounded-lg border border-line bg-white px-3 text-sm focus:outline-2 focus:outline-brand">
                <option value="">Semua Stasiun Asal</option>
                @foreach ($stations as $st)
                    <option value="{{ $st->id }}" @selected($originId == $st->id)>{{ $st->name }}
                        ({{ $st->code }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 space-y-1">
            <label for="destination_id" class="text-base font-medium">Stasiun Tujuan</label>
            <select name="destination_id" id="destination_id"
                class="h-10 w-full rounded-lg border border-line bg-white px-3 text-sm focus:outline-2 focus:outline-brand">
                <option value="">Semua Stasiun Tujuan</option>
                @foreach ($stations as $st)
                    <option value="{{ $st->id }}" @selected($destinationId == $st->id)>{{ $st->name }}
                        ({{ $st->code }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 space-y-1">
            <label for="date" class="text-base font-medium">Tanggal Berangkat</label>
            <input type="date" name="date" id="date" value="{{ $date }}"
                class="h-10 w-full rounded-lg border border-line bg-white px-3 text-sm focus:outline-2 focus:outline-brand">
        </div>

        <div class="flex gap-2">
            <x-button type="submit" class="h-10 px-6 text-base">Cari Jadwal</x-button>
            @if ($originId || $destinationId || $date)
                <x-button variant="ghost" :href="route('schedules.index')" class="h-10 px-4 text-base">Reset</x-button>
            @endif
        </div>
    </form>

    <div class="mt-8 space-y-6">
        @forelse ($schedules as $s)
            @php
                $isPast = $s->isDeparted();
                $seatsLeft = $s->remainingSeatsCount();
            @endphp
            <article
                class="flex flex-col items-center gap-8 rounded-lg border border-line px-5 py-6 sm:px-12 sm:py-8 md:flex-row {{ $isPast ? 'opacity-60 bg-gray-50' : 'bg-white' }}">
                <div class="flex w-28 flex-col items-center gap-2">
                    <x-icon name="armchair" class="size-16 text-brand" />
                    <span class="text-xl font-medium">{{ $s->train->class }}</span>
                </div>

                <div class="w-full flex-1 space-y-3">
                    <h3 class="text-2xl font-medium uppercase">{{ $s->train->name }}</h3>
                    <div class="flex items-center gap-2 text-sm font-semibold sm:gap-3 sm:text-xl">
                        <span>{{ $s->departure_time->format('H:i') }} {{ $s->originStation->code }}</span>
                        <span class="h-px flex-1 bg-ink"></span>
                        <span>{{ $s->duration }}</span>
                        <span class="h-px flex-1 bg-ink"></span>
                        <span>
                            {{ $s->arrival_time->format('H:i') }} {{ $s->destinationStation->code }}
                            @if ($s->crossesNextDay())
                                <sup class="text-xs text-bad font-semibold">+1</sup>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-base text-mute">
                        <span>{{ $s->originStation->name }}</span>
                        <span>{{ $s->destinationStation->name }}</span>
                    </div>
                    <p class="text-xl font-bold text-brand">
                        Rp. {{ number_format($s->price, 0, ',', '.') }} <span class="text-base font-normal text-ink">/ Per
                            kursi</span>
                    </p>
                </div>

                <div class="flex w-full flex-col items-center gap-3 md:w-48">
                    <img src="{{ $s->train->logo_url ?? asset('images/kai-logo.png') }}" alt="Logo Kereta"
                        class="h-10 object-contain" onerror="this.style.display='none'">
                    @if ($isPast)
                        <x-badge kind="gray" class="w-36">Sudah berangkat</x-badge>
                        <x-button variant="off" class="w-36">Tidak tersedia</x-button>
                    @elseif ($seatsLeft <= 0)
                        <x-badge kind="bad" class="w-36">Habis</x-badge>
                        <x-button variant="off" class="w-36">Habis</x-button>
                    @else
                        <x-badge :kind="$seatsLeft <= 5 ? 'bad' : 'ok'" class="w-36">Sisa {{ $seatsLeft }} kursi</x-badge>
                        <x-button :href="route('schedules.seats', $s->id)" class="w-36">Pilih Kursi</x-button>
                    @endif
                </div>
            </article>
        @empty
            <p class="py-12 text-center text-mute">Tidak ada jadwal kereta ditemukan.</p>
        @endforelse
    </div>

    @if ($schedules->hasPages())
        <div class="mt-8">
            {{ $schedules->links() }}
        </div>
    @endif
@endsection
