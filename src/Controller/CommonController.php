<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

    use Psr\Log\LoggerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use App\Helper\Stat;
/**
 * Description of CommonController
 *
 * @author PrasenjitM
 */
class CommonController  extends Controller{
    
        private $logger;/**
         * 
         * @param LoggerInterface $logger
         */
        public function __construct(LoggerInterface $logger)
        {
           $this->logger = $logger;
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
