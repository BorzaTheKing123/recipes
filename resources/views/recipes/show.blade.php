<x-layout>
    <x-slot:heading>{{ $recipe->name }}</x-slot:heading>
    <br>
    <h2 style="display: flex;
    justify-content: center;">Sestavine</h2>
    <div class="ingredients-container">
        <?php $ingredients = explode("<", $recipe->ingredients); ?>
            @foreach($ingredients as $ingredient)
                <li style="padding: 20px">{{ $ingredient }}</li>
            @endforeach
    </div>
    <h2 class="center">Postopek</h2>
    <div class="recipe-container" style="display: block">
        <div class="recipe-card">
            <?php $lines = explode("\r\n", $recipe->recipe) ?>
            @foreach($lines as $line)
                {{ $line }}<br>
            @endforeach

        </div>

        @can("edit", $recipe)
            <p>
                <x-button style="font-weight: bold" href="/recipes/{{ $recipe->id }}/edit">UREDI</x-button>
            </p>
        @endcan
    </div>
</x-layout>
