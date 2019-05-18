<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;

/**
 * Description of UserManagementHelper
 *
 * @author PrasenjitM
 */
class UserManagementHelper {
     /**
     * 
     * @param type $myUserExistingUserGrp
     * @param type $myAllGrps
     * @return type
     */
    public static function getUserGroups($myUserExistingUserGrp, $myAllGrps) {
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
    public static function getGrpsNotAssignToUser($myUserExistingGrp, $myAllGrps) {
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
     * @param type $myUser
     * @param type $myUsermanagementservice
     * @return string
     */
    public static function validateNewUser($myUser,$myUsermanagementservice) {
        $errors = array();
        if($myUsermanagementservice->isUserNamePresent($myUser->getUsername())){
            $errors[] = "User Name Already Present";
        }
        if($myUsermanagementservice->isEmailPresent($myUser->getEmail())){
            $errors[] = "Email Already Present";
        }
        return $errors;
    }
    
    /**
     * 
     * @param type $myAppGroup
     * @param type $myUsermanagementservice
     * @return string
     */
    public static function validateNewGroup($myAppGroup,$myUsermanagementservice) {
        $errors = array();
        if($myUsermanagementservice->isGroupPresent($myAppGroup->getGroupName())){
            $errors[] = "Group Name Already Present";
        }
        return $errors;
    }
    
    /**
     * 
     * @param type $errors
     * @return string
     */
    public static function getErrors($errors){
        if(Checker::isFilledArray($errors)){
            $myErrors = "Errors : ";
             foreach($errors as $error) {
                 $myErrors = $myErrors."<br>".$error;
             }
             return $myErrors;
        }else{
            return null;
        }
    }
}
