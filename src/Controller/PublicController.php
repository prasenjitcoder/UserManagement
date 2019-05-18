<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Psr\Log\LoggerInterface;

/**
 * Description of PublicController
 *
 * @author PrasenjitM
 */
//All the controller which will be used before login , need to extends it. Here we will not check any role
class PublicController extends CommonController {

    private $logger;
/**
 * 
 * @param LoggerInterface $logger
 */
    public function __construct(LoggerInterface $logger) {
        parent::__construct($logger);
        $this->logger = $logger;
        //All the controller which will be used before login , need to extends it. Here we can perform any action if required
    }

}
