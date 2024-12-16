<?php

class HomepageController {

    public function __construct() {
    }

    /**
     * @return void
     */
    public function execute() {
        $view = new HomepageView();
        $view->show();
    }
}
