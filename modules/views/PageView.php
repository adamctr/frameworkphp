<?php

class PageView {
    public function __construct(private $content, private $title, private $description, private $jsFilesNames = null, private $cssFilesNames = null) {
    }

    /**
     * @return void
     */
    public function show() {
        $config = new PageConfig($this->jsFilesNames, $this->cssFilesNames);
        $cssPaths = $config->getCssPaths();
        $jsPaths = $config->getJsPaths();
        ?>
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <meta name="description" content="<?=$this->description?>">
                <?php foreach ($cssPaths as $cssPath): ?>
                    <link href="/<?= $cssPath ?>" rel="stylesheet" />
                <?php endforeach; ?>
                <link rel="shortcut icon" href="/assets/yfavicon.ico" type="image/x-icon"/>
                <title><?= $this->title ?></title>
            </head>
            <body>
                <main class="main">
                    <div class="postContainer">
                        <?= $this->content; ?>
                    </div>
                </main>

                <?php foreach ($jsPaths as $jsPath): ?>
                    <script src="/<?= $jsPath ?>"></script>
                <?php endforeach; ?>
            </body>
        </html>
<?php
    }
}
