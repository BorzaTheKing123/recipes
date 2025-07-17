<x-layout>
    <x-slot:heading>Generiraj ključ</x-slot:heading>
    {!! $qr_code !!}
    <br>
    {{$uri}}
    <br>
    {{$string}}
    <hr>
    <x-nav-link href="/profile/{{ Auth::id() }}/2fa/confirm">Preveri</x-nav-link>
</x-layout>
