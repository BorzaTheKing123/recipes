<x-layout>
    <x-slot:heading>Recepti</x-slot:heading>
    <div class="container">
        @foreach($recipes as $recipe)
            <a href="/recipes/{{ $recipe['id'] }}">
                <div class ="card">
                    @if (isset($recipe->tags[0]['name']))
                        <i>{{ $recipe->tags[0]['name'] }}</i>
                    @else
                        {{ 'none' }}
                    @endif
                    <hr />
                    <br>
                    <div>
                    <strong>{{ $recipe->name }}</strong><br>{{ $user->find($recipe->user_id)->name }}
                    </div>
                </div>
            </a>

        @endforeach
    </div>
</x-layout>
