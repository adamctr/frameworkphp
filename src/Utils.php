<?php
/**
 *
 */
class Utils
{

    /**
     * Fonction utilitaire pour envoyer une réponse JSON
     */
    static function sendResponse($success, $message, $data = null)
    {
        $response = ['status' => $success, 'message' => $message];

        if ($data) {
            $response['data'] = $data;
        }

        echo json_encode($response);
    }

    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
