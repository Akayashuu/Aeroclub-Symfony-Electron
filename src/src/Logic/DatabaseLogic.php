<?php
declare(strict_types=1);

namespace App\Logic;

use App\Repository\AvionsRepository;

class DatabaseLogic {

    /**
     * @date 24/03/2023 - 10h48
     * @author Sauvage Léo
     * @param AvionsRepository $avionsRepository
     * @return bool
     */
    static public function isConnected(AvionsRepository $avionsRepository):bool {
        $k = $avionsRepository->findAll();
        if(is_array($k)) {
            return true;
        } 
        return false;
    }
    
}