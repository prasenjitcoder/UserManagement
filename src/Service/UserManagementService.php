<?php

namespace App\Service;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\UserGroup;
use App\Helper\Checker;
use App\Entity\User;
use App\Entity\AppGroup;

/**
 * Description of UserManagementService
 *
 * @author PrasenjitM
 */
//I have not done exception handling in Controller
//This class will be used to call DB for user related operation. We should not directly call DB from Controller    
class UserManagementService extends GenericService {

    private $em;

    /**
     * 
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * 
     * @param type $userName
     * @param type $password
     * @return type
     */
    public function checkUser(string $userName, string $password):User{
        try {
            $repository = $this->em->getRepository(User::class);
            $myUser = $repository->findOneBy([
                'login' => $userName,
                'password' => $password,
            ]);
            return $myUser;
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }
    /**
     * 
     * @param string $userName
     * @return bool
     */
    public function isUserNamePresent(string $userName):bool{
        try {
            //$repository = $this->em->getRepository(User::class);
           // $myUser = $repository->findOneBy([
              // 'upper(username)' => strtoupper($userName)
            //]);
            
             $query = $this->em->createQuery(
                    'select count(u.id) from \App\Entity\User u where upper(u.username)=?1'
            );
            $query->setParameter(1, strtoupper($userName));
            $myUserCount = $query->getSingleScalarResult();
            
            if($myUserCount!=null && $myUserCount>0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }
    /**
     * 
     * @param string $email
     * @return bool
     */
    public function isEmailPresent(string $email):bool{
        try {
            $query = $this->em->createQuery(
                    'select count(u.id) from \App\Entity\User u where upper(u.email)=?1'
            );
            $query->setParameter(1, strtoupper($email));
            $myUserCount = $query->getSingleScalarResult();
            
            if($myUserCount!=null && $myUserCount>0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }
    /**
     * 
     * @param string $groupName
     * @return bool
     */
    public function isGroupPresent(string $groupName):bool{
        try {
            $query = $this->em->createQuery(
                    'select count(u.id) from \App\Entity\AppGroup u where upper(u.groupName)=?1'
            );
            $query->setParameter(1, strtoupper($groupName));
            $myGroupCount = $query->getSingleScalarResult();
            
            if($myGroupCount!=null && $myGroupCount>0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }
    
    /**
     * 
     * @param type $myUserGroups
     * @return boolean
     */
    public function isAdminUser($myUserGroups): bool {
        try {
            $repository = $this->em->getRepository(AppGroup::class);
            $groupIds[] = null;
            foreach ($myUserGroups as $myUserGroup) {
                $groupIds[] = $myUserGroup->getGroupId();
            }
            $myGroups = $repository->findById($groupIds);
            if (Checker::isFilledArray($myGroups)) {
                return $this->isAdmin($myGroups);
            } else {
                return false;
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $myNewUser
     */
    public function addNewUser(User $myNewUser) {
        try {
            $myNewUser->setCreationTime(new \DateTime());
            $myNewUser->setLastModTime(new \DateTime());
            $this->em->persist($myNewUser);
            $this->em->flush();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $myNewGroup
     */
    public function addNewGroup(AppGroup $myNewGroup) {
        try {
            $myNewGroup->setCreationTime(new \DateTime());
            $myNewGroup->setLastModTime(new \DateTime());
            $this->em->persist($myNewGroup);
            $this->em->flush();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @return type
     */
    public function findAllUser() {
        try {
            $repository = $this->em->getRepository(User::class);
            return $repository->findAll();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $id
     */
    public function deleteUserById(int $id) {
        try {
            $repository = $this->em->getRepository(User::class);
            $myUser = $repository->find($id);
            $this->em->remove($myUser);
            $this->em->flush();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $id
     */
    public function deleteGroupById(int $id) {
        try {
            $repository = $this->em->getRepository(AppGroup::class);
            $myGroup = $repository->find($id);
            $this->em->remove($myGroup);
            $this->em->flush();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getUserById(int $id): User {
        try {
            return $this->findUserById($id);
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @return type
     */
    public function findAllGroup() {
        try {
            $repository = $this->em->getRepository(AppGroup::class);
            return $repository->findAll();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $groupIds
     * @return type
     */
    public function getGroupsByIds($groupIds) {
        try {
            $repository = $this->em->getRepository(AppGroup::class);
            return $repository->findById($groupIds);
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $ids
     */
    public function deleteUserGroupByIds($ids) {
        try {
            $repository = $this->em->getRepository(UserGroup::class);
            if ($ids != null) {
                foreach ($ids as $id) {
                    $myUserGroup = $repository->find($id);
                    $this->em->remove($myUserGroup);
                    $this->em->flush();
                }
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $userId
     * @param type $groupIds
     */
    public function addUserToGroup($userId, $groupIds) {
        try {
            $myUser = $this->findUserById($userId);
            if ($groupIds != null) {
                foreach ($groupIds as $groupId) {
                    $myUserGroup = new UserGroup();
                    $myUserGroup->setGroupId($groupId);
                    $myUserGroup->setCreationTime(new \DateTime());
                    $myUserGroup->setLastModTime(new \DateTime());
                    $myUserGroup->setUser($myUser);
                    $this->em->persist($myUserGroup);
                    $this->em->flush();
                }
            }
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @return type
     */
    public function getGroupsWhichNotBelongsToUser() {
        try {
            $query = $this->em->createQuery(
                    'select a from \App\Entity\AppGroup a where a.id not in (select DISTINCT u.groupId from \App\Entity\UserGroup u)'
            );
            // returns an array of app_group objects
            return $query->execute();
        } catch (Exception $ex) {
            parent::manageException($ex);
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    private function findUserById(int $id) {
        $repository = $this->em->getRepository(User::class);
        return $repository->find($id);
    }
    /**
     * 
     * @param AppGroup $myGroups
     * @return bool
     */
     private function isAdmin($myGroups): bool {
        foreach ($myGroups as $myGroup) {
            if ($myGroup->getGroupName() == 'Admin') {
                return true;
            }
        }
    }
}
