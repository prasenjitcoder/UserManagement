<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserGroupRepository")
 */
class UserGroup extends GenericEntity
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
     * @ORM\Column(type="integer")
     */
    private $groupId;
    
    
    /**
    * @ORM\ManyToOne(
    *      targetEntity="User",
    *      inversedBy="userGroups"
    * )
    * @ORM\JoinColumn(onDelete="CASCADE")
    */
    public $user;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }
    public function getCreationTime() {
        return $this->creationTime;
    }

    public function getLastModTime() {
        return $this->lastModTime;
    }

    public function getGroupId() {
        return $this->groupId;
    }

    public function setCreationTime($creationTime) {
        $this->creationTime = $creationTime;
    }

    public function setLastModTime($lastModTime) {
        $this->lastModTime = $lastModTime;
    }

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }
}
