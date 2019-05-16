<?php
namespace App\Session;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author PrasenjitM
 */
//THis is our session object. If we want to keep anything in seesion. We have to put here
class UserSession implements \Serializable {
    private $isLoged;
    private $userId;
    private $homePageData = array();

    //put your code here
    public function serialize() {
        return serialize(
                [
                    $this->isLoged,
                    $this->userId,
                    $this->homePageData,
                ]
        );
    }

    public function unserialize($serialized) {
        $data = unserialize($serialized);
        list(
                $this->isLoged,
                $this->userId,
                $this->homePageData,
                ) = $data;
    }
    
    public function getIsLoged() {
        return $this->isLoged;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getHomePageData() {
        return $this->homePageData;
    }

    public function setIsLoged($isLoged) {
        $this->isLoged = $isLoged;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setHomePageData($homePageData) {
        $this->homePageData = $homePageData;
    }



}
