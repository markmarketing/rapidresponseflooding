<?php

class CSRF
{
    const CSRF_TOKEN_SECRET = '';

    public function createToken()
    {
        $seed = random_bytes(8);
        $time = time();
        session_id();
        $hash = hash_hmac('256', session_id() . $seed . $time, static::CSRF_TOKEN_SECRET, true);

        return $this->urlSafeEncode($hash . '|' . $seed . '|' . $time);
    }


    /**
     * 
     */
    public function validateToken($token)
    {
        $parts = explode('|', $this->urlSafeDecode($token));
        if (count($parts) === 3) {
            $hash = hash_hmac('256', session_id() . $parts[1] . $parts[2], static::CSRF_TOKEN_SECRET, true);
            if (hash_equals($hash, $parts[0])) {
                return true;
            }
        }
        return false;
    }


    /**
     * 
     */
    public function urlSafeEncode($message)
    {
        return rtrim(strtr(base64_encode($message), '+/', '-_'), '=');
    }


    /**
     * 
     */
    public function urlSafeDecode($message)
    {
        return base64_decode(strtr($message, '-_', '+/'));
    }
}
