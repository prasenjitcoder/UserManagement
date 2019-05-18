<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * This controller is a public controller to manage login
 */
//I have not done exception handling in Controller
class LoginController extends PublicController {

    /**
     * @Route("/", name="login")
     * @Method({"GET"})
     */
    public function login(Security $security, AuthenticationUtils $helper) {
        $startTime = parent::startFunction("UserManagementController", "login");
        try {
            if ($security->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('home');
            }

            if ($security->isGranted('ROLE_USER')) {
                return $this->redirectToRoute('home');
            }

            $last_username = $helper->getLastUsername();
            $error = $helper->getLastAuthenticationError();
            if($error!=null){
                $error = "User/Password incorrect";
            }
            return $this->render('usermanagement/index.html.twig', ['last_username' => $last_username,'error' => $error]);
        } catch (Exception $ex) {
            
        } finally {
            parent::endFunction("UserManagementController", "login", $startTime);
        }
    }

    /**
     * @Route("/logout", name="logout")
     * @Method({"GET"})
     */
    public function logout() {
        $startTime = parent::startFunction("UserManagementController", "login");
        try {

        } catch (Exception $ex) {
            
        } finally {
            parent::endFunction("UserManagementController", "login", $startTime);
        }
    }

    /**
     * @Route("/home", name="home")
     * @Method({"POST"})
     */
    public function home() {
        $startTime = parent::startFunction("UserManagementController", "authenticate");
        try {
            return $this->render('usermanagement/home.html.twig');
        } catch (Exception $ex) {
            
        } finally {
            parent::endFunction("UserManagementController", "authenticate", $startTime);
        }
    }

}
