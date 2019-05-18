<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends GenericEntity implements UserInterface, \Serializable
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
    private $username;
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
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    
    public function getRoles(): array
    {
        $roles = null;
        // guarantees that a user always has at least one role for security
        if ($this->username=='Admin') {
            $roles[] = 'ROLE_ADMIN';
        }else{
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function getSalt(){
        
    }
    public function eraseCredentials(){
        
    }
     /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        return serialize([$this->id, $this->username, $this->password]);
    }
    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }

}
