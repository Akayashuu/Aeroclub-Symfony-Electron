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
        foreach ($envVariables as $name => $value) {
            putenv(sprintf('%s=%s', $name, $value));
            $dotenv->populate([$name => $value]);
        }
    }
}