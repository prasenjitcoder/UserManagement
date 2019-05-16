<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRolesRepository")
 */
class GroupRoles extends GenericEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roleId;
    
    /** @ORM\Column(type="datetime") */
    private $creationTime;
    
    /** @ORM\Column(type="datetime") */
    private $lastModTime;
    
     /**
    * @ORM\ManyToOne(
    *      targetEntity="AppGroup",
    *      inversedBy="groupRoles"
    * )
    * @ORM\JoinColumn(onDelete="CASCADE")
    */
    public $appGroup;
    
    public function getId() {
        return $this->id;
    }

    public function getRoleId() {
        return $this->roleId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }
    public function getAppGroup() {
        return $this->appGroup;
    }

    public function setAppGroup($appGroup) {
        $this->appGroup = $appGroup;
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
