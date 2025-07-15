@props(['active' => false])

<a {{ $attributes->merge(['style' => $active ? 'background-color: #292929 !important; border:1px solid #d40000': '{background-color: #393939;}:hover{}']) }}
    aria-current="{{ $active ? 'page' : 'false' }}"
>{{ $slot }}</a>
