<?php

class JWT {

    private $secretKey;

    public function __construct() {
        $this->secretKey = "eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTczNDM0NTY4MywiaWF0IjoxNzM0MzQ1NjgzfQ.AGJ4ZYWaJ9huIl8El2SaudJmk95m1fJ_o6HrHclQ44Q
";
    }

    public function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function generateJWT($header, $payload) {
        // 1. Encode le header en Base64Url
        $headerEncoded = self::base64UrlEncode(json_encode($header));

        // 2. Encode le payload en Base64Url
        $payloadEncoded = self::base64UrlEncode(json_encode($payload));

        // 3. Crée la signature (HMAC avec SHA256)
        $signature = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $this->secretKey, true);
        $signatureEncoded = self::base64UrlEncode($signature);

        // 4. Retourne le JWT complet (header.payload.signature)
        return $headerEncoded . '.' . $payloadEncoded . '.' . $signatureEncoded;
    }

    public function verifyJWT($jwt) {
        // Séparer les trois parties du JWT
        list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);

        // Recréer la signature
        $signatureToVerify = hash_hmac('sha256', $headerEncoded . '.' . $payloadEncoded, $this->secretKey, true);
        $signatureToVerifyEncoded = $this->base64UrlEncode($signatureToVerify);

        // Comparer les signatures
        if ($signatureToVerifyEncoded === $signatureEncoded) {
            return true;  // Le token est valide
        } else {
            return false; // Le token est invalide
        }
    }

}
