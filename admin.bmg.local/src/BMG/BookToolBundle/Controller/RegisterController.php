<?php

namespace BMG\BookToolBundle\Controller;

use BMG\BookToolBundle\Entity\User;
use BMG\BookToolBundle\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Entity\UserRecoveryPasswordHash;

class RegisterController extends Controller
{
	
    public function registerAction()
    {
        $data = array (
            'site_title' => 'Register',
            'username' => '',
        );

        return $this->render('@BMGBookTool/Register/register.html.twig', $data);
    }

    public function doRegisterAction (Request $request){
    	
    	$session = $this->getRequest()->getSession();

        $checkingUser = new User();
        $creatingUser = new User();
        $em = $this->getDoctrine()->getManager();
        
        $firsNameFromRequest = $request->request->get('first_name');
        $lastNameFromRequest = $request->request->get('last_name');
        $genderFromRequest = $request->request->get('gender');
        $emailFromRequest = $request->request->get('registerEmail');
        $passwordFromRequest = $request->request->get('password');
        $passwordFromRequest = password_hash($passwordFromRequest, PASSWORD_DEFAULT);
        $ipFromRequest = $request->server->get('REMOTE_ADDR');
		
        $creatingUser->setUserFirstname($firsNameFromRequest);
        $creatingUser->setUserLastname($lastNameFromRequest);
        $creatingUser->setUserEmail($emailFromRequest);
        $creatingUser->setUserPassword($passwordFromRequest);
        $creatingUser->setUserGender($genderFromRequest);
        $creatingUser->setUserIp($ipFromRequest);
        $creatingUser->setUserCreateDatetime(new \DateTime("now"));
        $creatingUser->setUserAdmin(0);
        $creatingUser->setStatus($em->getRepository('BMGBookToolBundle:Status')->find(7));
        
        $secret = "6Le2bgUTAAAAAHYoz7KwOKqr6KOY19S29fUkiP6Y";
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        
        
        if($request->getMethod()=='POST') {              	
        	if($_POST['g-recaptcha-response'] == null)
        	{      
        		$session->set('robot', true);
        		
        		$session->set('first_name',$firsNameFromRequest);
        		$session->set('last_name',$lastNameFromRequest);
        		$session->set('gender',$genderFromRequest);
        		$session->set('email',$emailFromRequest);
        		
        		return $this->redirect($this->generateUrl('login'));
        	}
        	/*$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        	
        	if (!$resp->isSuccess())
        	{
        		die("failed!");
        	}*/
        	$checkingUser = $em->getRepository('BMGBookToolBundle:User')->findOneBy(array('userEmail'=>$emailFromRequest));

            if($checkingUser && $checkingUser->getUserEmail()) {

                $userDBEmail = $checkingUser->getUserEmail();

                // Check if user account already exist in Database
                if ( $emailFromRequest == $userDBEmail ){
//                    echo "Your account already exist";

                 /*   $accountExistData = array (
                        'site_title' => 'Your Account Exist',
                        'email' => $emailFromRequest,
                    );*/
                   
                    
                    $data = array (
                    		'site_name'   => $this->container->getParameter('site_name'),
                    		'site_title' => $this->container->getParameter('site_name') . ' - Login',
                    		'username' => '',
                    		'message_status' => 'danger',
                    		'message_title' => $this->get('translator')->trans("email_already_in_use_error_title", array(), "profile", $request->getLocale()),
                    		'message_content_register' => $this->get('translator')->trans("email_already_in_use_error__message", array(), "profile", $request->getLocale())
                    
                    );
                    
                    
                    #return $this->render('@BMGBookTool/Register/account_alreaday_exist.html.twig', $accountExistData);
                    $session->set('error', true);

                    $session->set('first_name',$firsNameFromRequest);
                    $session->set('last_name',$lastNameFromRequest);
                    $session->set('gender',$genderFromRequest);
                    $session->set('email',$emailFromRequest);

                    return $this->redirect($this->generateUrl('login'));

                    #return $this->render('@BMGBookTool/Login/index.html.twig', $data);
                    exit;
                }
            }

           
            $em->persist($creatingUser);
            $em->flush();
                                   
            $session->set("user", $creatingUser);
            $common = $this->get('Common');
            
            $userRecoveryPassword = new UserRecoveryPasswordHash();
            $userRecoveryPassword->setUser($creatingUser);
            
			$hash = password_hash($creatingUser->getUserId() . $creatingUser->getUserEmail(), PASSWORD_DEFAULT);
    		$hash = str_replace("/", "*", $hash);
    		
    		$userRecoveryPassword->setUserRecoveryPasswordHashValue($hash);
    		
    		$em->persist($userRecoveryPassword);
    		$em->flush();
    		
            $parameters = array(
                    'user_fullname' => $creatingUser->getUserFirstname() . ' ' . $creatingUser->getUserLastname(),
                    'url' => $this->container->getParameter('site_url'), 
                    'hash' => $hash
                );

           try{
                    $common->sendMail($creatingUser->getUserEmail(),
                    $this->get('translator')->trans("activate_account", array(), "email", $request->getLocale()),
                    'BMGBookToolBundle:Email:BMG-tool-ActivateEmail.html.twig',
                    null,
                    true,
                    $parameters);
              } catch (\Exception $exc){
                    echo("Error. Email not send" . $exc->getMessage()); 
                    exit;           
              }

            $session->set('message_status', 'success');
            $session->set('message_title', $this->get('translator')->trans("activate_account_notice_title", array(), "register", $request->getLocale()));
            $session->set('message_content', $this->get('translator')->trans("activate_account_notice_message", array(), "register", $request->getLocale()));
            return $this->redirect($this->generateUrl('bmg_book_tool_welcome'));
            exit;
//            echo "Your account is Created";

        }
/*
        $accountCreatData = array (
            'site_title' => 'Account Created',
            'first_name' => $firsNameFromRequest,
            'last_name' => $lastNameFromRequest,
            'email' => $emailFromRequest,
            'username' => '',
        );

        return $this->render('@BMGBookTool/Register/account_created_confirmation.html.twig', $accountCreatData);
        exit;
*/
    }
    
    public function activateAccountAction(Request $request) {
    	
        $session = $this->getRequest()->getSession();
    	$user = new User();
    	$em = $this->getDoctrine()->getManager();
    	 
    	$hash = $_GET['token'];
    	   
    	$userHash = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findOneBy(array('userRecoveryPasswordHashValue' => $hash));
   
    	if($userHash) {
    		$user = $userHash->getUser();
    		$user->setStatus($em->getRepository('BMGBookToolBundle:Status')->find(1));
    		$em->persist($user);
    		$em->remove($userHash);
    		$em->flush();
    		
    		$data = array (
    				'site_title' => 'Account Activation',   				
    				'username' => '',
    		);

            $session->set('message_status', 'success');
            $session->set('message_title', $this->get('translator')->trans("profile_register_success_title", array(), "register", $request->getLocale()));
            $session->set('message_content', $this->get('translator')->trans("profile_register_success_message", array(), "register", $request->getLocale()));

            return $this->redirect($this->generateUrl('bmg_book_tool_welcome'));
    
    		//Yes is a valid hash
    	//return $this->render('BMGBookToolBundle:Register:account_activated.html.twig', $data);
    
    	}else {
    
    		$url = "/" . $request->getLocale() . "/";
            Header("Location: $url");
            exit;
    	}
    
    	#$user->setUserPassword(NEW_PASSWORD);
    	#$em->persist($password);
    	#$em->flush();
    
    	#exit;
    }
    public function validateEmailAction(Request $request) {
    	$session = $this->getRequest()->getSession();
    	
        $checkingUser = new User();
      
        $em = $this->getDoctrine()->getManager();
       
    	if($request->getMethod()=='POST') {
    		$emailFromRequest = $_POST['registerEmail'];
    		
    		
    		$checkingUser = $em->getRepository('BMGBookToolBundle:User')->findOneBy(array('userEmail'=>$emailFromRequest));
    	
    		if($checkingUser && $checkingUser->getUserEmail()) {
    	
    			$userDBEmail = $checkingUser->getUserEmail();
    	
    			// Check if user account already exist in Database
    			if ( $emailFromRequest == $userDBEmail ){
    				$data = "";
    				header('Content-Type: application/json');
    				echo json_encode($data);
    				exit;
    			}else
    			{
    				$data = "true";
    				header('Content-Type: application/json');
    				echo json_encode($data);
    				exit;
    			}
    		}else{
    			$data = "true";
    			header('Content-Type: application/json');
    			echo json_encode($data);
    			exit;
    		}
    	}
   	
    }
}