<?php


namespace App\Security;


class CustomPasswordEncoder {

    private string $password;
    private string $encryption = "AES-256-CBC";
    private string $secret_iv;
    private string $key;

    public function __construct(string $password)
    {
        $this->password = $password;
        $this->key = getenv("CUSTOM_PASSWORD_ENCODER_KEY");
        $this->secret_iv = getenv("SECRET_KEY_IV");
    }

    function encrypt() {
        $key = hash('sha256', $this->key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $this->secret_iv ), 0, 16);
        $output = openssl_encrypt($this->password, $this->encryption, $key, 0, $iv);
        return base64_encode($output);
    }
    
    function decrypt() {
        $key = hash('sha256', $this->key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($this->password), $this->encryption, $key, 0, $iv);
    }

}