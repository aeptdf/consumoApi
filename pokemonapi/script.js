document.getElementById('pokemonForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el recargo de la página

    const pokemonName = document.getElementById('pokemonName').value.toLowerCase();
    const apiUrl = `https://pokeapi.co/api/v2/pokemon/${pokemonName}`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Pokémon no encontrado');
            }
            return response.json();
        })
        .then(data => {
            displayPokemonData(data);
        })
        .catch(error => {
            document.getElementById('pokemonInfo').innerHTML = `<p class="error">${error.message}</p>`;
        });
});

function displayPokemonData(data) {
    const pokemonInfo = document.getElementById('pokemonInfo');
    pokemonInfo.innerHTML = `
        <img src="${data.sprites.front_default}" alt="${data.name}">
        <div class="pokemon-data">
            <h2>${data.name.toUpperCase()}</h2>
            <p><strong>Altura:</strong> ${data.height / 10} m</p>
            <p><strong>Peso:</strong> ${data.weight / 10} kg</p>
            <p><strong>Habilidades:</strong> ${data.abilities.map(ability => ability.ability.name).join(', ')}</p>
            <p><strong>Movimientos:</strong> ${data.moves.length}</p>
        </div>
    `;
}