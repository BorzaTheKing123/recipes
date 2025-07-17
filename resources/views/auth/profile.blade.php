<x-layout>
    <x-slot:heading>Profil</x-slot:heading>
    <form method="POST" action="/profile/{{ $user->id }}">
        @csrf
        @method('PATCH')

        <div class="container-2">
            <div style="grid-row: 1">
                <a href="/profile/{{ $user->id }}/2fa">2fa</a>
            </div>
            <div style="grid-column: 1; grid-row: 2">
                <x-form-field>
                    <x-form-label for="name">Uporabniško ime</x-form-label>
                    <x-form-input name="name" id="name" placeholder="Npr.: Tiramisu" value="{{ $user->name }}"></x-form-input>
                    <x-form-error name="name">Mora vsebovati naslov, ki je dolg vsaj 3 črke!</x-form-error>
                </x-form-field>
            </div>
            <div style="grid-column: 2; grid-row: 2">
                <x-form-field>
                    <x-form-label for="name">Email</x-form-label>
                    <x-form-input name="name" id="name" placeholder="Npr.: Tiramisu" value="{{ $user->email }}"></x-form-input>
                    <x-form-error name="name">Nepravilen email!</x-form-error>
                </x-form-field>
            </div>
        </div>
        <br><hr>

        <div class="center" style="display: block;">
            <h2 style="text-align: center">Spremeni geslo</h2>
            <x-form-field>
                <x-form-label for="oldPassword">Trenutno geslo</x-form-label>
                <x-form-input name="oldPassword" id="oldPassword"></x-form-input>
            </x-form-field>
            <x-form-field>
                <x-form-label for="newPassword">Novo geslo</x-form-label>
                <x-form-input type="password" name="newPassword" id="newPassword"></x-form-input>
            </x-form-field>
        </div>
        <br><hr>


        <div class="bottom">
            <button form="delete-form" >DELETE</button>

            <div style="display: flex;">
                <a class="button" href="/">Prekliči</a>
                <button type="submit">Posodobi</button>
            </div>
        </div>
    </form>

    <form method="POST" action="/profile/{{ $user->id }}" id="delete-form" class="hidden">
        @csrf
        @method("DELETE")

    </form>
</x-layout>
