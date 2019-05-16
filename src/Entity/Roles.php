<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles extends GenericEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100,unique=true)
     */
    private $roleName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roleDesc;
    
    /** @ORM\Column(type="datetime") */
    private $creationTime;
    
    /** @ORM\Column(type="datetime") */
    private $lastModTime;

    public function getId() {
        return $this->id;
    }

    public function getRoleName() {
        return $this->roleName;
    }

    public function getRoleDesc() {
        return $this->roleDesc;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRoleName($roleName) {
        $this->roleName = $roleName;
    }

    public function setRoleDesc($roleDesc) {
        $this->roleDesc = $roleDesc;
    }
    public function getCreationTime() {
        return $this->creationTime;
    }

    public function getLastModTime() {
        return $this->lastModTime;
    }

    public function setCreationTime($creationTime) {
        $this->creationTime = $creationTime;
    }

    public function setLastModTime($lastModTime) {
        $this->lastModTime = $lastModTime;
    }



}
