<?php

class DynamicMessageView {

    static public function getDivMessage($type, $message) {
        ob_start();
        ?>

        <div role="alert" class="alert alert-<?= $type ?> dynamicMessage">
            <?php echo file_get_contents('assets/svg/' . $type . '.svg' ); ?>

            <p><?= $message ?></p>
        </div>

        <?php

        return ob_get_clean();
    }
}
