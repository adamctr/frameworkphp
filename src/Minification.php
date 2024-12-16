<?php

namespace src;

use MatthiasMullie\Minify;

class Minification
{
    public function minifyAssets()
    {
        $this->minifyCss();
        $this->minifyJs();
    }

    private function minifyCss()
    {
        // Définissez les fichiers CSS à minifier
        $cssFiles = [
            __DIR__ . '/../../public/style/style.css',
        ];
        $minifiedCss = new Minify\CSS();

        // Ajoutez chaque fichier CSS à minifier
        foreach ($cssFiles as $cssFile) {
            $minifiedCss->add($cssFile);
        }

        // Enregistrez le fichier minifié
        $minifiedCss->minify(__DIR__ . '/../../public/assets/minified/style.min.css');
    }

    private function minifyJs()
    {
        // Définissez les fichiers JS à minifier
        $jsFiles = [
            __DIR__ . '/../../public/scripts/index.js',
        ];
        $minifiedJs = new Minify\JS();

        // Ajoutez chaque fichier JS à minifier
        foreach ($jsFiles as $jsFile) {
            $minifiedJs->add($jsFile);
        }

        // Enregistrez le fichier minifié
        $minifiedJs->minify(__DIR__ . '/../../public/assets/minified/index.min.js');
    }
}
