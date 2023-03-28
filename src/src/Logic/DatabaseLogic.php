<?php
declare(strict_types=1);

namespace App\Logic;

use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;

class DatabaseLogic {

    /**
     * @date 24/03/2023 - 10h48
     * @author Sauvage Léo
     * @return bool
     */
    static public function envCheck():bool {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        if($_ENV["DATABASE_URL"] != "" || !$_ENV["DATABASE_URL"]) {
            return false;
        } else {
            return true;
        }
        return false;
    }

        /**
     * @date 28/03/2023 - 21h48
     * @author Sauvage Léo
     * @param ManagerRegistry $doctrine
     * @return bool
     */
    static public function isConnected(ManagerRegistry $doctrine):bool {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
            if($_ENV["DATABASE_URL"] == "" || !$_ENV["DATABASE_URL"]) {
                return true;
            }
        $connection = DriverManager::getConnection(['url' => $_ENV["DATABASE_URL"]]);
        try {
            $sql = 'SELECT 1';
            $stmt = $connection->executeQuery($sql);
            if ($stmt) {
                return false;
            } else {
                return true;
            }
        } catch (\Exception $e) {
           return true;
        }
        return true;
    }
    
}