<?php

class page404View {
    public static function show() {

        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page non trouvée</title>
        </head>
        <body>
        <div class="errorContainer">
            <h1>404</h1>
            <h2>Page non trouvée</h2>
            <p>Désolé, la page que vous cherchez n'existe pas.</p>

            <a href="/" class="btn">Retour à l'accueil</a>

        </div>
        </body>
        </html>

        <?php
    }
}
