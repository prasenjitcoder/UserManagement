<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Exception\UserException;
use App\Helper\Stat;
use Psr\Log\LoggerInterface;
/**
 * Description of GenericService
 *
 * @author PrasenjitM
 */
class GenericService {
    private $logger;
    /**
     * 
     * @param \App\Service\LoggerInterface $logger
     */
     public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }
    
    /**
     * 
     * @param \Exception $ex
     * @throws UserException
     */
    public function manageException(\Exception $ex){
        //We will log this exception here
        throw new UserException($ex->getMessage());
    }
    
    /**
         * 
         * @param type $ControllerName
         * @param type $functionName
         * @return type
         */
        //TO print the start of method..We can later add here method argument
        public function startFunction($ControllerName,$functionName){
            $startTime = Stat::startFunction($ControllerName,$functionName,$this->logger);
            return $startTime;
        }
        /**
         * 
         * @param type $ControllerName
         * @param type $functionName
         * @param type $startTime
         */
         //TO print the end of method with total time taken to finish the execution.We can later add here method argument
         public function endFunction($ControllerName,$functionName,$startTime){
            Stat::endFunction($ControllerName,$functionName,$startTime,$this->logger);
        } 
}
