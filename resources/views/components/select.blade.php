@props(['label', 'name', 'options', 'selected' => null, 'placeholder' => 'Pilih…'])
<div class="space-y-1.5">
    <label for="{{ $name }}" class="text-base font-medium text-[#0F172A]">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->class(['h-10 w-full rounded-lg border bg-white px-3 text-sm text-ink focus:outline-2 focus:outline-brand disabled:bg-soft', $errors->has($name) ? 'border-bad' : 'border-line']) }}>
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $v => $l)
            <option value="{{ $v }}" @selected((string) old($name, $selected) === (string) $v)>{{ $l }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-sm text-bad">{{ $message }}</p>
    @enderror
</div>
