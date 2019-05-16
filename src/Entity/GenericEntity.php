<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

/**
 * Description of GenericEntity
 *
 * @author PrasenjitM
 */
//All Entity must extends this class to have id,CreationTime and LastTime
abstract class GenericEntity {
    abstract public function getId();
    abstract public function setCreationTime($creationTime);
    abstract public function setLastModTime($lastModTime);
}
