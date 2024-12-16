<?php

class DynamicMessageController
{
    // Méthode pour afficher un message dynamique avec un type
    static public function showMessage($type, $message)
    {
        header('Content-Type: application/json');

        $divMessageHtml = DynamicMessageView::getDivMessage($type, $message);

        echo json_encode([
            'success' => $type,
            'divMessageHtml' => $divMessageHtml
        ]);
    }
}

?>
