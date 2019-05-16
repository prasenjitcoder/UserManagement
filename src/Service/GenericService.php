<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Exception\UserException;
/**
 * Description of GenericService
 *
 * @author PrasenjitM
 */
class GenericService {
    /**
     * 
     * @param \Exception $ex
     * @throws UserException
     */
    public function manageException(\Exception $ex){
        //We will log this exception here
        throw new UserException($ex->getMessage());
    }
}
