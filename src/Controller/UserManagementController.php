<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\AppGroup;
use Psr\Log\LoggerInterface;
use App\Helper\Checker;

/**
 * Description of AuthenticateController
 *
 * @author PrasenjitM
 */
//I have not done exception handling in Controller
class UserManagementController extends PrivateController {

    /**
     * @Route("/adduser", name="adduser")
     * Method({"GET", "POST"})
     */
    public function adduser(Request $request) {
        $startTime = parent::startFunction("UserManagementController", "adduser");
        try {
            $myNewUser = new User();
            $form = $this->createUserForm($myNewUser);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $myNewUser = $form->getData();
                $myUsermanagementservice = $this->get('app.usermanagementservice');
                $myUsermanagementservice->addNewUser($myNewUser);
                return $this->redirectToRoute('userlist');
            }
            return $this->render('usermanagement/adduser.html.twig', array(
                        'form' => $form->createView(), 'error' => null
            ));
        } catch (\Exception $ex) {
            $errorMessage = $ex->getMessage();
            $myNewUser = new User();
            $form = $this->createUserForm($myNewUser);
            return $this->render('usermanagement/adduser.html.twig', array(
                        'form' => $form->createView(), 'error' => 'Error - Please check the provided details' . $errorMessage
            ));
        } finally {
            parent::endFunction("UserManagementController", "adduser", $startTime);
        }
    }

    /**
     * @Route("/addgroup", name="addgroup")
     * Method({"GET", "POST"})
     */
    public function addgroup(Request $request) {
        $startTime = parent::startFunction("UserManagementController", "addgroup");
        try {
            $myNewGroup = new AppGroup();
            $form = $this->createGroupForm($myNewGroup);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $myNewGroup = $form->getData();
                $myUsermanagementservice = $this->get('app.usermanagementservice');
                $myUsermanagementservice->addNewGroup($myNewGroup);
                return $this->redirectToRoute('grouplist');
            }
            return $this->render('usermanagement/addgroup.html.twig', array(
                        'form' => $form->createView(), 'error' => null
            ));
        } catch (\Exception $ex) {
            $errorMessage = $ex->getMessage();
            $myNewGroup = new AppGroup();
            $form = $this->createGroupForm($myNewGroup);
            return $this->render('usermanagement/addgroup.html.twig', array(
                        'form' => $form->createView(), 'error' => 'Error - Please check the provided details' . $errorMessage
            ));
        } finally {
            parent::endFunction("UserManagementController", "addgroup", $startTime);
        }
    }
     /**
     * @Route("/grouplist", name="grouplist")
     * Method({"GET", "POST"})
     */
    public function grouplist() {
        $startTime = parent::startFunction("UserManagementController", "grouplist");
        try {
             $myUsermanagementservice = $this->get('app.usermanagementservice');
             $myAllGroups = $myUsermanagementservice->findAllGroup();
             return $this->render('usermanagement/grouplist.html.twig', array('groups' => $myAllGroups));
        } catch (\Exception $ex) {

        } finally {
            parent::endFunction("UserManagementController", "grouplist", $startTime);
        }
    }
    
    
    /**
     * @Route("/deletegroup/{id}", name="deletegroup")
     * Method({"GET", "POST"})
     */
    public function deletegroupById($id) {
        $startTime = parent::startFunction("UserManagementController", "deletegroupById");
        try {
            $myUsermanagementservice = $this->get('app.usermanagementservice');
            $myUsermanagementservice->deleteGroupById($id);
            return $this->redirectToRoute('grouplist');
        } catch (\Exception $ex) {
            return $this->redirectToRoute('grouplist');
        } finally {
            parent::endFunction("UserManagementController", "deletegroupById", $startTime);
        }
    }
    
    
    
    /**
     * @Route("/deletegroups", name="deletegroups")
     * Method({"GET", "POST"})
     */
    public function unassignedgrouplist() {
        $startTime = parent::startFunction("UserManagementController", "deletegroups");
        try {
             $myUsermanagementservice = $this->get('app.usermanagementservice');
             $myAllGroups = $myUsermanagementservice->getGroupsWhichNotBelongsToUser();
             return $this->render('usermanagement/deletegrouplist.html.twig', array('groups' => $myAllGroups));
        } catch (\Exception $ex) {
        } finally {
            parent::endFunction("UserManagementController", "deletegroups", $startTime);
        }
    }

    /**
     * @Route("/userlist", name="userlist")
     * Method({"GET", "POST"})
     */
    public function userlist() {
        $startTime = parent::startFunction("UserManagementController", "userlist");
        try {
            $myUsermanagementservice = $this->get('app.usermanagementservice');
            $myUsers = $myUsermanagementservice->findAllUser();
            return $this->render('usermanagement/deleteuser.html.twig', array('users' => $myUsers));
        } catch (\Exception $ex) {
            
        } finally {
            parent::endFunction("UserManagementController", "userlist", $startTime);
        }
    }

    /**
     * @Route("/deleteuser/{id}", name="deleteuser")
     * Method({"GET", "POST"})
     */
    public function deleteuserById($id) {
        $startTime = parent::startFunction("UserManagementController", "deleteuserById");
        try {
            $myUsermanagementservice = $this->get('app.usermanagementservice');
            $myUsermanagementservice->deleteUserById($id);
            return $this->redirectToRoute('userlist');
        } catch (\Exception $ex) {
            
        } finally {
            parent::endFunction("UserManagementController", "deleteuserById", $startTime);
        }
    }

    /**
     * @Route("/edituser/{id}", name="edituser")
     * Method({"GET", "POST"})
     */
    public function editUseruserById($id, LoggerInterface $logger) {
        $startTime = parent::startFunction("UserManagementController", "editUseruserById");
        try {
            $myUsermanagementservice = $this->get('app.usermanagementservice');
            $myUser = $myUsermanagementservice->getUserById($id);
            if ($myUser != null) {
                $myUserExistingUserGrp = $myUser->getUserGroups();
                $myAllGrps = $myUsermanagementservice->findAllGroup();
                $userExistingGrps = array();
                $myUserNonExistingGrp = array();
                if (Checker::isFilledArray($myUserExistingUserGrp)) {
                    $userExistingGrps = $this->getUserGroups($myUserExistingUserGrp, $myAllGrps);
                    $myUserNonExistingGrp = $this->getGrpsNotAssignToUser($myUserExistingUserGrp, $myAllGrps);
                } else {
                    $myUserNonExistingGrp = $myAllGrps;
                }
                return $this->render('usermanagement/edituser.html.twig', array('user' => $myUser, 'userExistingGrps' => $userExistingGrps, 'myUserNonExistingGrps' => $myUserNonExistingGrp));
            } else {
                return $this->redirectToRoute('userlist');
            }
        } catch (\Exception $ex) {
            $logger->info("Message error - " . $ex->getMessage());
            return $this->redirectToRoute('userlist');
        } finally {
            parent::endFunction("UserManagementController", "editUseruserById", $startTime);
        }
    }

    /**
     * @Route("/updateuser", name="updateuser")
     * Method({"POST"})
     */
    public function updateuser(Request $request) {
        $startTime = parent::startFunction("UserManagementController", "updateuser");
        try {
            $myUsermanagementservice = $this->get('app.usermanagementservice');
            $userId = $request->get('userId');
            $removeUserGrps = $request->get('removeGrp');
            if (Checker::isFilledArray($removeUserGrps)) {
                $myUsermanagementservice->deleteUserGroupByIds($removeUserGrps);
            }
            $addGrps = $request->get('addGrp');
            if (Checker::isFilledArray($addGrps)) {
                $myUsermanagementservice->addUserToGroup($userId, $addGrps);
            }
            return $this->redirectToRoute('userlist');
        } catch (\Exception $ex) {
            return $this->redirectToRoute('userlist');
        } finally {
            parent::endFunction("UserManagementController", "updateuser", $startTime);
        }
    }

    /**
     * 
     * @param type $myUserExistingUserGrp
     * @param type $myAllGrps
     * @return type
     */
    private function getUserGroups($myUserExistingUserGrp, $myAllGrps) {
        $userGroups = array();
        foreach ($myUserExistingUserGrp as $myUserGroup) {
            foreach ($myAllGrps as $myGroup) {
                if ($myGroup->getId() == $myUserGroup->getGroupId()) {
                    $userGroups[] = array('userGroupId' => $myUserGroup->getId(), 'groupName' => $myGroup->getGroupName());
                    break;
                }
            }
        }
        return $userGroups;
    }

    /**
     * 
     * @param type $myUserExistingGrp
     * @param type $myAllGrps
     * @return type
     */
    private function getGrpsNotAssignToUser($myUserExistingGrp, $myAllGrps) {
        $groups = array();
        foreach ($myAllGrps as $myGroup) {
            $grpPresent = false;
            foreach ($myUserExistingGrp as $myUserGroup) {
                if ($myUserGroup->getGroupId() == $myGroup->getId()) {
                    $grpPresent = true;
                    break;
                }
            }
            if (!$grpPresent) {
                $groups[] = $myGroup;
            }
        }
        return $groups;
    }

    /**
     * 
     * @param type $myNewUser
     * @return type
     */
    private function createUserForm($myNewUser) {
        $form = $this->createFormBuilder($myNewUser)
                ->add('login', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('password', PasswordType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('email', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('firstName', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('lastName', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Add User',
                    'attr' => array('class' => 'btn btn-primary mt-3')
                ))
                ->getForm();
        return $form;
    }

    /**
     * 
     * @param type $myNewUser
     * @return type
     */
    private function createGroupForm($myNewUser) {
        $form = $this->createFormBuilder($myNewUser)
                ->add('groupName', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('groupDesc', TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Add Group',
                    'attr' => array('class' => 'btn btn-primary mt-3')
                ))
                ->getForm();
        return $form;
    }

}
