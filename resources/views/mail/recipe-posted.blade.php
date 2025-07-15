<h2>{{ $recipe->name }}</h2>

<p>
    Bravo ustvaril si nov recept!
</p>

<a href="{{ url('/recipes/'. $recipe->id) }}">Tukaj si lahko pogledaš svoj recept</a>
