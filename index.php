<?php

const API_URL = "https://whenisthenextmcufilm.com/api";

// Inicializar una nueva sesión de cURL
$ch = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición y que no la muestre en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Ejecutar la petición y guardar el resultado
$result = curl_exec($ch);

// Manejo de errores
if ($result === false) {
    $error = curl_error($ch);
    echo "Error en cURL: $error";
} else {
    $data = json_decode($result, true);

    // Verificar errores en la decodificación JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error en la decodificación JSON: " . json_last_error_msg();
    }
}

// Cerrar la sesión de cURL
curl_close($ch);
?>

<!-- html and css -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La proxima película de Marvel</title>
    <!-- Centered viewport --> 
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
/>
</head>

<body>
    <!-- <pre style="font-size: 8px; overflow: scroll; height: 250px;">
        <?php var_dump($data); ?>
    </pre> -->
<main>
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]?>" style="border-radius: 16px;">
    </section>

    <hgroup>
        <h3><?= $data["title"]?> se entrena en <?= $data["days_until"]?> dias</h3>
        <p>Fecha de estreno: <?= $data["release_date"]?></p>
        <p>La siguiente es: <?= $data["following_production"]["title"]?></p>
    </hgroup>
</main>


</body>
</html>

<style>
    :root{
        color-scheme: light dark;
    }

    body{
        display:grid;
        place-content: center;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
    img{
        margin: 0 auto;
    }
</style>
