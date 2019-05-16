<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use App\Session\UserSession;
        
    /**
     * This controller is a public controller to manage login
     */
    //I have not done exception handling in Controller
    class LoginController extends PublicController{ 

        /**
         * @Route("/", name="login")
         * @Method({"GET"})
         */
        public function login(SessionInterface $session){
            $startTime = parent::startFunction("UserManagementController","login");
            try{
                $homePageData = parent::checkLogin($session);
                if($homePageData!=null){
                    return $this->render('usermanagement/home.html.twig',$homePageData);
                }
                $myData=array('last_username' => null,'error' => null);
                return $this->render('usermanagement/index.html.twig',$myData);
            }catch(Exception $ex){

            }finally {
                parent::endFunction("UserManagementController","login",$startTime);
            }
        }
        
        /**
         * @Route("/logout", name="logout")
         * @Method({"GET"})
         */
        public function logout(SessionInterface $session){
            $startTime = parent::startFunction("UserManagementController","login");
            try{
                if($session!=null && $session->get('myUserSession')!=null){
                    $session->invalidate();
                }
                $myData=array('last_username' => null,'error' => null);
                return $this->render('usermanagement/index.html.twig',$myData);
            }catch(Exception $ex){

            }finally {
                parent::endFunction("UserManagementController","login",$startTime);
            }
        }
        /**
         * @Route("/authenticate", name="authenticate")
         * @Method({"POST"})
         */
        public function authenticate(Request $request,SessionInterface $session){
            $startTime = parent::startFunction("UserManagementController","authenticate");
            try{
                $homePageData = parent::checkLogin($session);
                if($homePageData!=null){
                    return $this->render('usermanagement/home.html.twig',$homePageData);
                }
                $error=null;
                $myUsermanagementservice = $this->get('app.usermanagementservice');
                $myUser = $myUsermanagementservice->checkUser($request->get('username'),$request->get('password'));
                if($myUser!=null){
                    $this->setSession($session,$myUsermanagementservice,$myUser);
                    return $this->render('usermanagement/home.html.twig',$this->setHomePageData($myUser,$myUsermanagementservice));
                }else{
                    $error="User Name or Password incorrect";
                }
                $myData=array('last_username' => $request->get('username'),'error' => $error);
                return $this->render('usermanagement/index.html.twig',$myData);
            }catch(Exception $ex){

            }finally {
                parent::endFunction("UserManagementController","authenticate",$startTime);
            }
        }
        /**
         * 
         * @param type $session
         * @param type $myUsermanagementservice
         * @param type $myUser
         */
        private function setSession($session,$myUsermanagementservice,$myUser){
            $myUserSession = new UserSession();
            $myUserSession->setIsLoged(true);
            $myUserSession->setUserId($myUser->getId());
            $myUserSession->setHomePageData($this->setHomePageData($myUser,$myUsermanagementservice));
            $session->set('myUserSession', $myUserSession);
        }
        
        /**
         * 
         * @param type $myUser
         * @param type $myUsermanagementservice
         * @return string
         */
        private function setHomePageData($myUser,$myUsermanagementservice){
            $homePageData=array();
            $myUserGroups = $myUser->getUserGroups();
            if($myUserGroups!=null){
                if($myUsermanagementservice->isAdminUser($myUserGroups)){
                    //Here I will get all the roles like 'Add User,Add group' from GroupRoles Entity 
                    //and then in home.html.twig, I will dipslay the the links according to roles
                    //Its a pending task
                    $homePageData = array('isAdmin'=>true,'message'=>null); 
                }else{
                    $homePageData = array('isAdmin'=>false,'message'=>'User is not a admin User'); 
                }
            }else{
               $homePageData = array('isAdmin'=>false,'message'=>'User doesnt belong to any group'); 
            }
            return $homePageData;
        }
     
    }

