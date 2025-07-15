<x-layout>
    <x-slot:heading>Prijava</x-slot:heading>
    <form method="POST" action="/login">
        @csrf

        <x-form-field>
            <x-form-label for="email">Email</x-form-label>
            <x-form-input type="email" name="email" id="email" :value="old('email')" placeholder="Npr.: janez.novak@gmail.com"></x-form-input>
            <x-form-error name="email">Napačni podatki!</x-form-error>
        </x-form-field>

        <x-form-field>
            <x-form-label for="password">Geslo</x-form-label>
            <x-form-input type="password" name="password" id="password"></x-form-input>
        </x-form-field>
        <br><hr>

        <div class="bottom">
            <a href="/" class="button">Prekliči</a>
            <x-form-button>Prijavi se</x-form-button>
        </div>
    </form>
</x-layout>
