<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Entity\User;
use BMG\BookToolBundle\Entity\UserRecoveryPasswordHash;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {

        $session = $this->getRequest()->getSession();

        $message_status = $message_title = $message_content = "";
        $firstname = $lastname = $gender = $email = "";

        if($session->get('message_status')) {
            $message_status = $session->get('message_status');
            $message_title = $session->get('message_title');
            $message_content = $session->get('message_content');
        }

        if($session->get('error') || $session->get('robot')) {
            $message_status = 'danger';
            $message_title = $this->get('translator')->trans("oops", array(), "common", $request->getLocale());
            if($session->get('robot'))
            {
            	$message_content = $this->get('translator')->trans("recaptcha_validation_content", array(), "register", $request->getLocale());
            }
            else
            {
            	$message_content = $this->get('translator')->trans("account_already_exist_content", array(), "register", $request->getLocale());
            }
            
            $firstname = $session->get('first_name');
            $lastname = $session->get('last_name');
            $gender = $session->get('gender');
            $email = $session->get('email');

            $view = "Login:index-register";
            $js_file = "register";
        }
        else
        {
            $view = "Login:index";
            $js_file = "login";
        }


        $data = array (
	    	'site_name'   => $this->container->getParameter('site_name'),
    		'site_title' => $this->container->getParameter('site_name') . ' - Login',
    		'username' => '',
            'firstname' => $firstname,
            'lastname' => $lastname,
            'gender' => $gender,
            'email' => $email,
            'message_status' => $message_status,
            'message_title' => $message_title,
            'message_content' => $message_content,
            'view' => $view,
            'js_file' => $js_file
    		
    	);

        $session->remove('message_status');
        $session->remove('message_title');
        $session->remove('message_content');

        $session->remove('robot');
        $session->remove('error');
        return $this->render("BMGBookToolBundle:Layout:skeleton_bmg.html.twig", $data);
    }
    
    public function securityCheckAction()
    {
    	echo "securityCheckAction:29";exit;
    	// The security layer will intercept this request
    }
    
    public function doLoginAction(Request $request){

    	$session = $this->getRequest()->getSession();
    	
    	$user = new User();
    	$em = $this->getDoctrine()->getManager();
    	
	    if($request->getMethod()=='POST') {
	    	
    		$user= $em->getRepository('BMGBookToolBundle:User')->findOneby(array('userEmail'=>$request->request->get('email')));
    		
    		if($user && $user->getUserId()) {
    			
    			$password = $user->getUserPassword();
    			$password_entered = $request->request->get('password');

    			if(password_verify($password_entered, $password)) {
                    $session->set('isAdmin', $user->getUserAdmin());
    				$session->set("user", $user);    				
    				return $this->redirect($this->generateUrl('bmg_book_tool_welcome'));
    			}else{
    				$session->set('message_status', 'danger');
    				$session->set('message_title', $this->get('translator')->trans("password_incorrect_title", array(), "login", $request->getLocale()));
    				$session->set('message_content', $this->get('translator')->trans("password_incorrect_message", array(), "login", $request->getLocale()));
    				return $this->redirect($this->generateUrl('login'));
    			}
    		}
    		$session->set('message_status', 'danger');
    		$session->set('message_title', $this->get('translator')->trans("account_not_found", array(), "login", $request->getLocale()));
    		$session->set('message_content', $this->get('translator')->trans("account_not_found_message", array(), "login", $request->getLocale()));
    		return $this->redirect($this->generateUrl('login'));
     
	    }else {
	    	
	    	return $this->redirect($this->generateUrl('login'));
	    }
	    	    	
    }
    
    public function logoutAction() {
    	
    	$session = $this->getRequest()->getSession();    	 
    	$session->remove('user');
    	
    	return $this->redirect($this->generateUrl('login'));
    	
    }
    
    public function forgotPasswordAction(Request $request){
    	
        $common = $this->get('Common');

    	$user = new User();
    	$em = $this->getDoctrine()->getManager();
    	 
    	if($request->getMethod()=='POST') {

    		$user = $em->getRepository('BMGBookToolBundle:User')->findOneby(array('userEmail'=>$request->request->get('email')));
    
    		if($user && $user->getUserEmail()) {

    			//Check if user already have a hash into table
    			$userHash = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findOneby(array('user'=>$user));
    			if($userHash) {
    				//User ALREADY have a hash, so lets delete and generate a new one
    				$em->remove($userHash);
					$em->flush();
    			}
    			
    			//Lets generate a hash for password recovery
    			$userRecoveryPassword = new UserRecoveryPasswordHash();
    			$userRecoveryPassword->setUser($user);    

    			$hash = password_hash($user->getUserId() . $user->getUserEmail(), PASSWORD_DEFAULT);
    			$hash = str_replace("/", "*", $hash);
       			$userRecoveryPassword->setUserRecoveryPasswordHashValue($hash);

                $user->setStatus($em->getRepository('BMGBookToolBundle:Status')->find(7));
                $em->persist($user);
                $em->persist($userRecoveryPassword);
    			$em->flush();

    			//Lets generate email with the password recovery instructions
    			
                $parameters = array(
                    'site_name'   => $this->container->getParameter('site_name'),
                    'user_fullname' => $user->getUserFirstname() . ' ' . $user->getUserLastname(),
                    'url' => $this->container->getParameter('site_url'), 
                    'hash' => $hash
                );

                try{
                    $common->sendMail($user->getUserEmail(),
                            $this->get('translator')->trans("email_reset_password", array(), "email", $request->getLocale()),
                            'BMGBookToolBundle:Email:recovery_password.html.twig',
                            null,
                            true,
                            $parameters);
                    } 
                    catch (\Exception $exc){
                        echo("Error. Email not send" . $exc->getMessage());            
                }

    			$data = array (
    				'site_title' => 'Password Recovery',
                    'view' => 'Login:password_recovery_confirmation'
    			);

                $session = $this->getRequest()->getSession();

                $session->set('message_status', 'success');
                $session->set('message_title', $this->get('translator')->trans("password_recovery_confirmation_title", array(), "login", $request->getLocale()));
                $session->set('message_content', $this->get('translator')->trans("password_recovery_confirmation_message", array(), "login", $request->getLocale()));
                return $this->redirect($this->generateUrl('login'));

        		return $this->render('BMGBookToolBundle:Layout:skeleton_bmg.html.twig', $data);
        
    		}else {
    		//perhaps shows an error indicating the account do not exists?
    			$data = array (
    					'site_title' => 'email not found',
    			);

                $session = $this->getRequest()->getSession();

                $session->set('message_status', 'danger');
                $session->set('message_title', $this->get('translator')->trans("attention", array(), "common", $request->getLocale()));
                $session->set('message_content', $this->get('translator')->trans("password_recovery_invalid_account_message", array(), "login", $request->getLocale()));
                return $this->redirect($this->generateUrl('login'));

    			return $this->render('BMGBookToolBundle:Login:email_not_found.html.twig', $data);
    			exit;
    		}
    		}
    		 
    		return $this->render('BMGBookToolBundle:Login:index.html.twig', $data);
    	}
    	
	public function recoveryPasswordAction(Request $request) {

		$session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        $hash = $_GET['token'];
		//Lets locate the row into UserRecoveryPasswordHash using this hash
	
		$userHash = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findOneBy(array('userRecoveryPasswordHashValue' => $hash));

        //Checking if this is a new account
        $newAccount = false;
        $site_title = $this->get('translator')->trans("password_recovery_title", array(), "login", $request->getLocale());
        if(8 == $userHash->getUser()->getStatus()->getStatusId()) {
            $newAccount = true;
            $site_title = $this->get('translator')->trans("create_password_title", array(), "login", $request->getLocale());
        }

        if($userHash) {
            $data = array (
                'site_name'   => $this->container->getParameter('site_name'),
                'site_title' => $site_title,
                'hash' => $hash,
                'username' => '',
                'view' => 'Login:create_password',
            );

            //Yes is a valid hash
            if($newAccount) return $this->render('BMGBookToolBundle:Layout:skeleton_bmg.html.twig', $data);
            else {
                $data['view'] = "Login:password_recovery";
                return $this->render('BMGBookToolBundle:Layout:skeleton_bmg.html.twig', $data);
            }

        }else {

            //Invalid token
        	$session->set('message_status', 'danger');
        	$session->set('message_title', $this->get('translator')->trans("title_invalid_token", array(), "login", $request->getLocale()));
        	$session->set('message_content', $this->get('translator')->trans("invalid_token_content", array(), "login", $request->getLocale()));
        	return $this->redirect($this->generateUrl('login'));
        }

	}

    public function doRecoveryPasswordAction(Request $request){

        $common = $this->get('Common');

        $em = $this->getDoctrine()->getManager();

        $hash = $request->request->get('token');

        $session = $this->getRequest()->getSession();

        if($request->getMethod()=='POST') {

            $userHash = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findOneBy(array('userRecoveryPasswordHashValue' => $hash));
            
            if($userHash) {
                $user = $em->getRepository('BMGBookToolBundle:User')->findOneBy(array('userId' => $userHash->getUser()->getUserId()));
           
                if($user && $user->getUserId()) {

                    //We found the user, lets reset the password
                    $password_entered1 = $request->request->get('password1');
                    $password_entered2 = $request->request->get('password2');

                    if($password_entered1==$password_entered2) {
                        
                        $user->setUserPassword(password_hash($password_entered1, PASSWORD_DEFAULT));
                        $user->setStatus($em->getRepository('BMGBookToolBundle:Status')->find(1));

                        $em->persist($user);
                        $em->remove($userHash);
                        $em->flush();

                        $parameters = array(
                            'site_name'   => $this->container->getParameter('site_name'),
                            'user_fullname' => $user->getUserFirstname() . ' ' . $user->getUserLastname(),
                            'url' => $this->container->getParameter('site_url'),
                        );

                        try{
                            $common->sendMail($user->getUserEmail(),
                                $this->get('translator')->trans("email_title_password_reset_success", array(), "email", $request->getLocale()),
                                'BMGBookToolBundle:Email:recovery_password_success.html.twig',
                                null,
                                true,
                                $parameters);
                        } catch (\Exception $exc){
                            die("Error. Email not send" . $exc->getMessage());
                        }
                    }
                }

            }

            $session->set('message_status', 'success');
            $session->set('message_title', $this->get('translator')->trans("password_recovery_success_title", array(), "login", $request->getLocale()));
            $session->set('message_content', $this->get('translator')->trans("password_recovery_success_message", array(), "login", $request->getLocale()));
            return $this->redirect($this->generateUrl('login'));

        }else {

            return $this->redirect($this->generateUrl('login'));
        }
                   
    }

    //for jQuery to validate the login email
    public function checkLoginEmailAction(Request $request) {
    	$session = $this->getRequest()->getSession();
    	 
    	$checkingUser = new User();
    
    	$em = $this->getDoctrine()->getManager();
    	 
    	if($request->getMethod()=='POST') {
    		$emailFromRequest = $_POST['email'];
    
    
    		$checkingUser = $em->getRepository('BMGBookToolBundle:User')->findOneBy(array('userEmail'=>$emailFromRequest));
    		 
    		if($checkingUser && $checkingUser->getUserEmail()) {
    			 
    			$userDBEmail = $checkingUser->getUserEmail();
    			 
    			// Check if user account already exist in Database
    			if ( $emailFromRequest == $userDBEmail ){
    				$data = "true";
    				header('Content-Type: application/json');
    				echo json_encode($data);
    				exit;
    			}else
    			{
    				$data = "";
    				header('Content-Type: application/json');
    				echo json_encode($data);
    				exit;
    			}
    		}else{
    			$data = "";
    			header('Content-Type: application/json');
    			echo json_encode($data);
    			exit;
    		}
    	}
    
    }
    
}
