<x-layout>
    <x-slot:heading>Ključi za obnovo</x-slot:heading>
    @foreach($codes as $code)
        <li>{{$code['code']}}</li>
    @endforeach
    <a href="/profile/{{Auth::id()}}">Naprej</a>
</x-layout>