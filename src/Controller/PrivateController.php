<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Description of PrivateController
 *
 * @author PrasenjitM
 */
////All the controller which will be used after login , need to extends it. Here we will will check any role
class PrivateController extends CommonController {

    private $logger;
    /**
     * 
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger) {
        parent::__construct($logger);
        $this->logger = $logger;
    }

    /**
     * 
     * @param \App\Controller\SessionInterface $session
     * @return type
     */
    public function checkLogin(SessionInterface $session) {

            //We have session. Here we willl check if the user has the rights to access the path or not

            //We will throw an exception and will handle in controller. have not done this part

    }

}
