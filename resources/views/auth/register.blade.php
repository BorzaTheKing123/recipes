<x-layout>
    <x-slot:heading>Registracija</x-slot:heading>
    <form method="POST" action="/register">
        @csrf
        <x-form-field>
            <x-form-label for="name">Uporabniško ime</x-form-label>
            <x-form-input name="name" id="name" placeholder="Npr.: Janez Novak" :value="old('name')"></x-form-input>
            <x-form-error name="name">Mora vsebovati ime!</x-form-error>
        </x-form-field>

        <x-form-field>
            <x-form-label for="email">Email</x-form-label>
            <x-form-input type="email" name="email" id="email" placeholder="Npr.: janez.novak@gmail.com" :value="old('email')"></x-form-input>
            <x-form-error name="email">Napačen email!</x-form-error>
        </x-form-field>

        <x-form-field>
            <x-form-label for="password">Geslo</x-form-label>
            <x-form-input type="password" name="password" id="password"></x-form-input>
            <x-form-error name="password"></x-form-error>
        </x-form-field>

        <x-form-field>
            <x-form-label for="password_confirmation">Ponovi geslo</x-form-label>
            <x-form-input type="password" name="password_confirmation" id="password_confirmation"></x-form-input>
            <x-form-error name="password_confirmation"></x-form-error>
        </x-form-field>
        <br><hr>

        <div class="bottom">
            <a href="/" class="button">Prekliči</a>
            <x-form-button>Registriraj se</x-form-button>
        </div>
    </form>
</x-layout>
