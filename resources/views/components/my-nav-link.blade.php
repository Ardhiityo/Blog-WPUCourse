@props(['current', 'aria_current' => false, 'href'])

@php
    if ($current) {
        $current = 'bg-gray-900 text-white';
        $aria_current = true;
    } else {
        $current = 'text-gray-300 hover:bg-gray-700 hover:text-white';
    }
@endphp

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'rounded-md px-3 py-2 text-sm font-medium ' . $current]) }}
    {{ $aria_current ? 'aria-current=page' : '' }}>
    {{ $slot }}
</a>
