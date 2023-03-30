<?php 

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Process\Process;

class EnvManager
{

    static public function updateEnv(string $host, string $port, string $username, string $password, string $databaseName): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        $envVariables = [
            'DATABASE_URL' => sprintf(
                'postgresql://%s:%s@%s:%s/%s?serverVersion=11&charset=utf8',
                $username,
                $password,
                $host,
                $port,
                $databaseName
            ),
        ];
            $envFile = fopen(__DIR__.'/../../.env', 'r');
            $envContent = fread($envFile, filesize(__DIR__.'/../../.env'));
            fclose($envFile);
            $envContent = str_replace('DATABASE_URL='.$_ENV["DATABASE_URL"], 'DATABASE_URL='.$envVariables["DATABASE_URL"], $envContent);
            $envFile = fopen(__DIR__.'/../../.env', 'w');
            fwrite($envFile, $envContent);
            fclose($envFile);
    }
}