<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends GenericEntity
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
    private $login;
    /**
     * @ORM\Column(type="string",length=150)
     */
    private $password;

    /**
     * @ORM\Column(type="string",length=150,unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=150)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string",length=150)
     */
    private $lastName;

     /**
    * @ORM\OneToMany(targetEntity="UserGroup", mappedBy="user", cascade={"all"}, fetch="LAZY")
    */
    public $userGroups; 
    
    
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

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setCreationTime($creationTime) {
        $this->creationTime = $creationTime;
    }

    public function setLastModTime($lastModTime) {
        $this->lastModTime = $lastModTime;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }  
    
    public function getUserGroups() {
        return $this->userGroups;
    }

   public function setUserGroups($userGroups) {
        $this->userGroups = $userGroups;
    }


}
