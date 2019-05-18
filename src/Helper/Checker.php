<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;

/**
 * Description of Checker
 *
 * @author PrasenjitM
 */
//Our checker class to check null and any other things like date validation etc.
class Checker {
    /**
     * 
     * @param type $myArray
     * @return boolean
     */
    public static function isFilledArray($myArray) : bool {
        if ($myArray != null && count($myArray) > 0) {
            return true;
        }
        return false;
    }

}
