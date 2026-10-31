@props(['label', 'name', 'type' => 'text', 'value' => null, 'upper' => false, 'hint' => null])
<div class="space-y-1.5">
    <label for="{{ $name }}"
        class="{{ $upper ? 'uppercase text-base text-ink' : 'text-base font-medium text-[#0F172A]' }}">{{ $label }}</label>
    <div class="relative">
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
            value="{{ $type === 'password' ? '' : old($name, $value) }}"
            {{ $attributes->class(['h-10 w-full rounded-lg border bg-white px-4 text-sm text-ink placeholder:text-mute/60 focus:outline-2 focus:outline-brand disabled:bg-soft', $errors->has($name) ? 'border-bad' : 'border-line']) }}>
        @if ($type === 'password')
            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2" aria-label="Tampilkan password"
                onclick="const i=document.getElementById('{{ $name }}');i.type=i.type==='password'?'text':'password'"><x-icon
                    name="eye" /></button>
        @endif
    </div>
    @if ($hint && !$errors->has($name))
        <p class="text-xs text-mute">{{ $hint }}</p>
    @endif
    @error($name)
        <p class="text-sm text-bad">{{ $message }}</p>
    @enderror
</div>
