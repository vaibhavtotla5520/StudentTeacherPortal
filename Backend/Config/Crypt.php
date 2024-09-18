<?php

class Crypt
{

    private $method;
    private $key;

    function __construct()
    {
        $this->method = "AES-256-CBC";
        $this->key = "9874-N6%kk?o9501";
    }
    public function encrypt($data)
    {
        if(empty($data)) {
            return "";
        }
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
        $encrypted = openssl_encrypt($data, $this->method, $this->key, 0, $iv);
        $encrypted = base64_encode($iv . $encrypted);
        return $encrypted;
    }

    public function decrypt($data)
    {
        if(empty($data)) {
            return "";
        }
        $decrypted = base64_decode($data);
        $iv = substr($decrypted, 0, openssl_cipher_iv_length($this->method));
        $decrypted = substr($decrypted, openssl_cipher_iv_length($this->method));
        $decrypted = openssl_decrypt($decrypted, $this->method, $this->key, 0, $iv);
        return $decrypted;
    }
}
