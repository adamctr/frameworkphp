<?php

class HomepageView extends View {

    public function show() {
        ob_start();
        ?>

        <h1>Page d'accueil</h1>
        <form action="logout" method="post">
            <button type="submit">Déco</button>

            <?
            if (!empty($_COOKIE)) {
    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';
} else {
    echo 'Aucun cookie n\'est défini.';
}
            ?>
        </form>

        <?php
        $contentPage = ob_get_clean();
        (new PageView($contentPage, 'Accueil', "Ceci est la page d'accueil"))->show();
    }
}
