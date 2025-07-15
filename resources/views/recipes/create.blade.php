<x-layout>
    <x-slot:heading>Vnesi recept</x-slot:heading>
    <form method="POST" action="/recipes">
        @csrf

        <div class="container-2">
            <div style="grid-column: 1; grid-row: 1">
                <x-form-field>
                    <x-form-label for="name">Ime recepta</x-form-label>
                    <x-form-input name="name" id="name" placeholder="Npr.: Tiramisu" :value="old('name')"></x-form-input>
                    <x-form-error name="name">Mora vsebovati naslov, ki je dolg vsaj 3 črke!</x-form-error>
                </x-form-field>
            </div>

            <div style="grid-column: 2; grid-row: 1">
                <x-form-field>
                    <x-form-label for="category">Kategorija</x-form-label>
                    <x-form-select id="category" name="category"></x-form-select>
                </x-form-field>
            </div>
        </div>
        <br><hr>


        <x-form-label for="name">Sestavine</x-form-label>
        <div id="ingredients" class="ingredients-container">
        </div>
        <div class="center">
            <button class="center" type="button" id="new">Nova sestavina</button>
        </div>
        <x-form-field><x-form-error name="ingredients">Mora vsebovati vsaj eno sestavino!</x-form-error></x-form-field>
        <br><hr>


        <x-form-label for="recipe">Postopek</x-form-label>
        <div class="recipe-container">
            <textarea id="recipe" name="recipe" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{ old('recipe')}}</textarea>
            <x-form-field><x-form-error name="recipe">Mora vsebovati postopek!</x-form-error></x-form-field>
        </div>
        <br><hr>


        <div class="bottom">
            <a class="button" href="/recipes">Prekliči</a>
            <button type="submit">Ustvari</button>
        </div>
    </form>

    <script>
        document.getElementById('new').addEventListener('click', function() {
            let lastLi = document.querySelectorAll('li');
            let id = `0`;
            if (lastLi.length !== 0) {
                id = `${lastLi.length}`;
            }
            const ingredientsList = document.getElementById('ingredients');
            const newIngredient = Object.assign(document.createElement('li'), {id: id, className: 'no-bullets'});
            newIngredient.innerHTML = `<input type="text" id="${id}" name="ingredients[]" autocomplete="ingredient" style="width:100%" placeholder="Npr.: Sol">`;
            let button = document.createElement('button');
            button.name = id;
            button.type = "button";
            button.style = "border: none: padding: 0; margin-bottom: 20px;";
            button.className = "font-semibold";
            button.textContent = "ODSTRANI";
            button.setAttribute("onclick", "deleteE(name)");
            newIngredient.appendChild(button)
            ingredientsList.appendChild(newIngredient);
        });

        function deleteE (id) {
            document.getElementById(id).remove();
        }

    </script>
</x-layout>
