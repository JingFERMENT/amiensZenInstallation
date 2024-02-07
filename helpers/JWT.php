<?php

require_once __DIR__ . '/../config/init.php';

class JWT
{
    public static function set(array $payload)
    {
        $header = base64_encode(json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]));

        $payload = base64_encode(json_encode($payload));

        $signature = hash_hmac('sha256', $header . '.' . $payload, SECRET_KEY);

        $jwt = $header . '.' . $payload . '.' . $signature;
    }



    public static function check(string $jwt): object|false
    {
        $jwtArray = explode('.', $jwt);
        $header = $jwtArray[0];
        $payload = $jwtArray[1];
        $signatureOrignal = $jwtArray[2];
        $signatureToCheck = hash_hmac('sha256', $header . '.' . $payload, SECRET_KEY);
        
        if($signatureToCheck == $signatureOrignal) {
            
            return json_decode(base64_decode($payload));

        } else {
            return false;
        }
    }
}
