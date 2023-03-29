<?php


namespace App\Security;

use App\Repository\MembresRepository;

class CustomAuth {

    private string $password;
    private string $email;
    private MembresRepository $membreRepository;

    public function __construct(string $password, string $email,  MembresRepository $mbRepo) 
    {
        $this->password = $password;
        $this->email = $email;
        $this->membreRepository = $mbRepo;
    }

    public function authentification() {
        $data = $this->membreRepository->findOne(['email' => $this->email]);
        return (password_verify($this->password, $data["password"]) && $this->email == $data["email"]) ? true : false;
    }

    private function getHashPassword(string $password):string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}