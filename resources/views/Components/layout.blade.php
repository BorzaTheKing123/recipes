<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recepti</title>
        @vite(['resources/css/app.css'])
    </head>

    <body>
        <nav>
            <div class="nav">
                <div>
                    <x-nav-link href="/" :active="request()->is('/')">DOMOV</x-nav-link>
                    <x-nav-link href="/recipes" :active="request()->is('recipes')">Recepti</x-nav-link>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Kontakti</x-nav-link>
                </div>
                <div class="login">
                    @guest
                        <x-nav-link href="/login" :active="request()->is('login')">Prijava</x-nav-link>
                        <p style="color:#d40000;">|</p>
                        <x-nav-link href="/register" :active="request()->is('register')">Registracija</x-nav-link>
                    @endguest

                    @auth
                        <x-nav-link href="/recipes/create">Ustvari recept</x-nav-link>
                        <form method="POST" action="/logout">
                            @csrf

                            <x-form-button>Odjavi se</x-form-button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>

        <div style="display: flex; justify-items: center; justify-content: center;">
            <header><h1>{{ $heading }}</h1></header>

        </div>
        <form action="/search" method="GET">
            <input class="searchbar" type="search" name="q" placeholder="Išči recepte">
        </form>
        <br><hr>

    <main>
        {{ $slot }}
    </main>

    </body>
</html>
