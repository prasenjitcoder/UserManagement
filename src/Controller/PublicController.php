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
    }
    /**
     * 
     * @param SessionInterface $session
     * @return type
     */
    public function checkLogin(SessionInterface $session) {
        if ($session != null && $session->get('myUserSession')!=null) {
            $myUserSession = $session->get('myUserSession');
            $isLogged = $myUserSession->getIsLoged();
            $homePageData = $myUserSession->getHomePageData();
            return $homePageData;
        }
    }
}
