<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppGroupRepository")
 */
class AppGroup extends GenericEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** @ORM\Column(type="datetime") */
    private $creationTime;
    
    /** @ORM\Column(type="datetime") */
    private $lastModTime;

    /**
     * @ORM\Column(type="string",length=150,unique=true)
     */
    private $groupName;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $groupDesc;

    
    /**
    * @ORM\OneToMany(targetEntity="GroupRoles", mappedBy="appGroup", cascade={"all"}, fetch="LAZY")
    */
    public $groupRoles; 
    
    
    public function getId()
    {
        return $this->id;
    }

    public function getCreationTime() {
        return $this->creationTime;
    }

    public function getLastModTime() {
        return $this->lastModTime;
    }

    public function getGroupName() {
        return $this->groupName;
    }

    public function getGroupDesc() {
        return $this->groupDesc;
    }

    public function setCreationTime($creationTime) {
        $this->creationTime = $creationTime;
    }

    public function setLastModTime($lastModTime) {
        $this->lastModTime = $lastModTime;
    }

    public function setGroupName($groupName) {
        $this->groupName = $groupName;
    }

    public function setGroupDesc($groupDesc) {
        $this->groupDesc = $groupDesc;
    }
    public function getGroupRoles() {
        return $this->groupRoles;
    }

    public function setGroupRoles($groupRoles) {
        $this->groupRoles = $groupRoles;
    }


}
