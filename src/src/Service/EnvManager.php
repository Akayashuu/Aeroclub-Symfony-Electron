<?php 

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;

class EnvManager
{

    public function updateEnv(string $host, string $port, string $username, string $password, string $databaseName): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        $envVariables = [
            'DATABASE_URL' => sprintf(
                'postgresql://%s:%s@%s:%s/%s',
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