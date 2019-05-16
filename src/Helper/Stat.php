<?php
namespace App\Helper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stat
 *
 * @author PrasenjitM
 */
class Stat {
    /**
     * 
     * @param type $controllerName
     * @param type $functionName
     * @param type $logger
     * @return type
     */
    public static  function startFunction($controllerName,$functionName,$logger) {
        $milliseconds = round(microtime(true) * 1000);
        $message = $controllerName." - Function ".$functionName." started";
        $logger->info($message);
        return $milliseconds;          
    }
    /**
     * 
     * @param type $controllerName
     * @param type $functionName
     * @param type $startTime
     * @param type $logger
     */
     public static function endFunction($controllerName,$functionName,$startTime,$logger){
        $milliseconds = round(microtime(true) * 1000);
        $endTime = $milliseconds - $startTime;
        $message = $controllerName." - Function ".$functionName." done in ".$endTime." Millisecond";
         $logger->info($message);
    }
    
}
