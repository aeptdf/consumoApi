<?php
if (isset($_GET['pokemonName'])) {
    $pokemonName = strtolower($_GET['pokemonName']);
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/" . $pokemonName;

    // Usar cURL para obtener la respuesta de la PokeAPI
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        header('Content-Type: application/json');
        echo $response;
    } else {
        echo json_encode(["error" => "Pokémon no encontrado"]);
    }
} else {
    echo json_encode(["error" => "No se ha proporcionado un nombre de Pokémon"]);
}
?>