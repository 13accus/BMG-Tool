<?php

namespace BMG\BookToolBundle\Controller;

use BMG\BookToolBundle\Entity\SocialNetwork;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BMG\BookToolBundle\Entity\User;
use BMG\BookToolBundle\Form\UserType;
use BMG\BookToolBundle\Form\UserPasswordType;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;
use BMG\BookToolBundle\Entity\UserSocialNetworkLink;
use BMG\BookToolBundle\Entity\UserRecoveryPasswordHash;
/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();

        $common = $this->get('Common');
        $common->checkSessionAction();

        //Getting current user information
        $user = $session->get('user');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("BMGBookToolBundle:User")->find($user->getUserId());

        //ONLY ADMINs :)
        if($user->getUserAdmin()) {

            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('BMGBookToolBundle:User')->findAll();

            $data = array (
                'site_name'   => $this->container->getParameter('site_name'),
                'page_title'  => 'User List',
                'view'        => 'User:index',
                'xcss'        => array (
                    'plugins/select2/select2.css',
                    'plugins/DataTables/media/css/DT_bootstrap.css'
                ),
                'xjs'         => array (

                    'plugins/bootbox/bootbox.min.js',
                    'plugins/jquery-mockjax/jquery.mockjax.js',
                    'plugins/select2/select2.min.js',
                    'plugins/DataTables/media/js/jquery.dataTables.min.js',
                    'plugins/DataTables/media/js/DT_bootstrap.js',
                    'js/table-data.js'
                ),
                'xjs_init'      => array (
                    'Main',
                    'TableData'
                ),
                'entities' => $entities,
            );

            return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);

        }
        else  return $this->redirect('profile');


    }

    public function profileAction(Request $request)
    {
        $session = $this->getRequest()->getSession();

    	$common = $this->get('Common');
        $common->checkSessionAction();

    	return $this->redirect($this->generateUrl("user_show", array('id' => $session->get('user')->getUserId())));

    }


    /**
     * Creates a new User entity.
     *
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("BMGBookToolBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getUserId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request, $id)
    {
        $session = $this->getRequest()->getSession();

    	$common = $this->get('Common');
        $common->checkSessionAction();

    	//Checking if the user is try to reach it own data otherwise will be a 500 error
    	$this->_checkIfThisIsMyProfile($id);

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $message_status = $message_title = $message_content = "";

        if($session->get('message_status')) {
        	$message_status = $session->get('message_status');
        	$message_title = $session->get('message_title');
        	$message_content = $session->get('message_content');
        }

        if($entity->getUserBirthdate()) {
            $_dob = $entity->getUserBirthdate()->format('Y-m-d');
            $_dob = explode("-", $_dob);
            $dob = array(
                'year' => $_dob[0],
                'month' => $_dob[1],
                'day' => $_dob[2]
            );
        }else {
            $dob = array(
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d')
            );
        }

        $social_networks = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findby(array('user' => $entity));

        $social = array();

        foreach($social_networks as $value) {
            $social[strtolower($value->getSocialNetwork()->getSocialNetworkName())] = $value->getUserSocialNetworkAccount();
        }

        $data = array (
        		'site_name'   => $this->container->getParameter('site_name'),
        		'page_title'  => $this->get('translator')->trans("profile", array(), "profile", $request->getLocale()),
        		'view'        => 'User:show',
        		'xcss'        => array (
        				'plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
        				'plugins/bootstrap-social-buttons/social-buttons-3.css',
        				'plugins/select2/select2.css',
        				'plugins/DataTables/media/css/DT_bootstrap.css'
        		),
        		'xjs'         => array (
        				'plugins/bootstrap-fileupload/bootstrap-fileupload.min.js',
        				'plugins/jquery.pulsate/jquery.pulsate.min.js',

        				'plugins/bootbox/bootbox.min.js',
        				'plugins/jquery-mockjax/jquery.mockjax.js',
        				'plugins/select2/select2.min.js',
        				'plugins/DataTables/media/js/jquery.dataTables.min.js',
        				'plugins/DataTables/media/js/DT_bootstrap.js',
        				'js/pages-user-profile.js',

        				'js/jquery.validate.min.js'

        		),
        		'xjs_init'    => array (
        				'Main','PagesUserProfile'
        		),
        		'entity'      => $entity,
        		'picture'     => $this->_getUserPicture($entity->getUserId()),
        		'dob'         => $dob,
                'social_networks' => $social,
        		'message_status' => $message_status,
        		'message_title' => $message_title,
        		'message_content' => $message_content

        );

        $session->remove('message_status');
        $session->remove('message_title');
        $session->remove('message_content');


        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);

    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Edits Bio an existing User entity.
     *
     * @Route("/{id}", name="user_update_bio")
     * @Method("PUT")
     * @Template("BMGBookToolBundle:User:edit.html.twig")
     */
    public function update_bioAction(Request $request, $id)
    {

    	$em = $this->getDoctrine()->getManager();

    	$entity = $em->getRepository('BMGBookToolBundle:User')->find($id);

    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}

    	if($request->request->get('editor2') != NULL) $entity->setUserBio($request->request->get('editor2'));
    	$em->persist($entity);
    	$em->flush();

    	return $this->redirect($this->generateUrl('user_show', array('id' => $id)));

    }

    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getUserId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}", name="user_update")
     * @Method("PUT")
     * @Template("BMGBookToolBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {

        $session = $this->getRequest()->getSession();
    	$common = $this->get('Common');

        if($_FILES) {

            $uploadOk = true;

            $file = $_FILES['upload_picture'];
            if ($file) {


                $imageFileType = pathinfo($file['name'], PATHINFO_EXTENSION);
                $target_dir = $this->container->getParameter('cdn_path') . "/" . $common->_getUserPicturePath($id);

                //Checking if the path exists
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Check file size
                if ($file["size"] > 500000) {
                    //$uploadOk = false;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = false;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == false) {
                    //echo "Sorry, your file was not uploaded.";

                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($file["tmp_name"], $target_dir . "/" . $id . '.' . $imageFileType)) {
                        //echo "The file ". basename( $file["name"]). " has been uploaded.";
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                    }
                }
            }

        };


        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        if($request->getMethod()=='POST') {

        	$email = $request->request->get('email');

        	//Start Email portion

        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        		$session->set('message_status', 'danger');
        		$session->set('message_title', $this->get('translator')->trans("invalid_email_address_title", array(), "email", $request->getLocale()));
        		$session->set('message_content', $this->get('translator')->trans("invalid_email_address_content", array(), "email", $request->getLocale()));

        	}else {

	        	$currentEmail = $entity->getUserEmail();

	        	//Lets check if the user is actually changing the email address
	        	if($email != $currentEmail) {
	        		//Yes, the user is trying to change the email address

	        		//Lets check first if the email is avaliable
	        		$user = $em->getRepository('BMGBookToolBundle:User')->findOneby(array('userEmail'=>$email));
	        		if($user) {

	        			$session->set('message_status', 'danger');
	        			$session->set('message_title', $this->get('translator')->trans("email_modified_error_title", array(), "email", $request->getLocale()));
	        			$session->set('message_content', $this->get('translator')->trans("email_modified_error_message", array(), "email", $request->getLocale()));

	        			return $this->redirect($this->generateUrl('user_show', array('id' => $id)));

	        		}else {
	        			//The email address is free to use!

	        			$entity->setUserEmail($request->request->get('email'));
	        			$entity->setStatus($em->getRepository('BMGBookToolBundle:Status')->find(7));
	        			$userRecoveryPassword = new UserRecoveryPasswordHash();
	        			$userRecoveryPassword->setUser($entity);
	        			$hash = password_hash($entity->getUserId() . $entity->getUserEmail(), PASSWORD_DEFAULT);
	        			$hash = str_replace("/", "*", $hash);
	        			$userRecoveryPassword->setUserRecoveryPasswordHashValue($hash);

	        			$em->persist($userRecoveryPassword);
	        			$em->flush();

	        			try{
	        				$parameters = array(
                    					'user_fullname' => $entity->getUserFirstname() . ' ' . $entity->getUserLastname(),
                   						'url' => $this->container->getParameter('site_url'),
                    					'hash' => $hash
               			 	);
	        				$common->sendMail($request->request->get('email'),
	        							$this->get('translator')->trans("email_verification_subject", array(), "email", $request->getLocale()),
	        							'BMGBookToolBundle:Email:email_verification.html.twig',
	        							null,
	        							true,
	        							$parameters);

	        				$session->set('message_status', 'success');
	        				$session->set('message_title', $this->get('translator')->trans("email_modified_success_title", array(), "email", $request->getLocale()));
	        				$session->set('message_content', $this->get('translator')->trans("email_modified_success_message", array(), "email", $request->getLocale()));
	        			}
	        			catch (\Exception $exc){
	        				echo("Error. Email not send" . $exc->getMessage());
	        			}
	        		}
	        	}
        	}

        	//End Email portion

        	if($request->request->get('firstname') != NULL) $entity->setUserFirstname($request->request->get('firstname'));
        	if($request->request->get('lastname') != NULL) $entity->setUserLastname($request->request->get('lastname'));

	        if($request->request->get('phone') != NULL) {
	        	$phone = preg_replace("/[^0-9]/","",$request->request->get('phone'));
	        	$entity->setUserMobile($phone);
	        }
	        if($request->request->get('address1') != NULL) $entity->setUserAddress1($request->request->get('address1'));
	        if($request->request->get('address2') != NULL) $entity->setUserAddress2($request->request->get('address2'));
	        if($request->request->get('city') != NULL) $entity->setCity($request->request->get('city'));
	        if($request->request->get('zipcode') != NULL) $entity->setUserZipcode($request->request->get('zipcode'));

            if($request->request->get('website') != NULL) $entity->setUserWebsite($request->request->get('website'));

            //Getting City/State based on zipcode
            $_city_state = $em->getRepository('BMGBookToolBundle:City')->findOneby(array('cityZipcode' => $request->request->get('zipcode')));
            if($_city_state) $entity->setCity($_city_state);

	        if($request->request->get('gender') != NULL) $entity->setUserGender($request->request->get('gender'));

	        if(($request->request->get('dd') != NULL) || ($request->request->get('mm') != NULL) | ($request->request->get('yyyy') != NULL) ){

	        	$_dob = $request->request->get('yyyy') . '-' . $request->request->get('mm') . '-' . $request->request->get('dd');
	        	$dob = new \DateTime($_dob);

	        	$entity->setUserBirthdate($dob);

	        }

	        if($request->request->get('password') != NULL){
				if($request->request->get('password') == $request->request->get('password_again'))
	        		$entity->setUserPassword(password_hash($request->request->get('password'), PASSWORD_DEFAULT));
	        }

	        $entity->setUserLastupdateDatetime(new \Datetime("now"));

            //Image
            if(@$imageFileType) $entity->setUserPhoto($id . '.' . $imageFileType);

	        $em->persist($entity);
			$em->flush();

	        //Adding the social network portion
	        if($request->request->get('twitter') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'Twitter'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('twitter'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }

	        if($request->request->get('facebook') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'Facebook'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('facebook'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }

	        if($request->request->get('linkedin') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'LinkedIn'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('linkedin'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }

	        if($request->request->get('imdb') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'IMDb'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('imdb'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }

	        if($request->request->get('skype') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'Skype'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('skype'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }

	        if($request->request->get('google') != NULL) {
	            $network = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneby(array('socialNetworkName' => 'Google'));

	            //Cleaning the house first
	            $link = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneby(array('socialNetwork' => $network, 'user' => $entity));
	            if($link) {
	                $em->remove($link);
	            }

	            $link = new UserSocialNetworkLink();
	            $link->setUser($entity);
	            $link->setSocialNetwork($network);
	            $link->setUserSocialNetworkAccount($request->request->get('google'));
	            $link->setUserSocialNetworkLinkDatetime(new \Datetime("now"));

	            $em->persist($link);
	        }


	        $em->flush();

	        $session->set('message_status', 'success');
	        $session->set('message_title', $this->get('translator')->trans("profile_update_success_title", array(), "email", $request->getLocale()));
	        $session->set('message_content', $this->get('translator')->trans("profile_update_success_message", array(), "email", $request->getLocale()));

        }


		return $this->redirect($this->generateUrl('user_show', array('id' => $id)));

    }

    public function changePasswordAction(Request $request)
    {
        $session = $this->getRequest()->getSession();

        $common = $this->get('Common');

        $em = $this->getDoctrine()->getManager();

        $id = $session->get('user')->getUserId();

        $entity = $em->getRepository('BMGBookToolBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        if($request->getMethod()=='POST') {

            $password = $_POST['bmg_booktoolbundle_user']['userPassword'];

            $password1 = isset($password['first']) ? $password['first'] : null;
            $password2 = isset($password['second']) ? $password['second'] : null;

            if($password1 && $password2 && ($password1 == $password2) && (strlen($password1)>=9) && (strlen($password1)<=30) && (strlen(trim($password1)) == strlen($password1)) ) {

                $passwordFromRequest = $password1;
                $passwordFromRequest = password_hash($passwordFromRequest, PASSWORD_DEFAULT);
                $entity->setUserPassword($passwordFromRequest);

                $em->persist($entity);
                $em->flush();

                $session->set('message_status', 'success');
                $session->set('message_title', $this->get('translator')->trans("change_password_success_title", array(), "password", $request->getLocale()));
                $session->set('message_content', $this->get('translator')->trans("change_password_success_message", array(), "password", $request->getLocale()));

            }else {

                $session->set('message_status', 'danger');
                $session->set('message_title', $this->get('translator')->trans("change_password_error_title", array(), "password", $request->getLocale()));
                $session->set('message_content', $this->get('translator')->trans("change_password_error_message", array(), "password", $request->getLocale()));

            }
        }

        $form = $this->createForm(new UserPasswordType(), $entity, array(
            'action' => $this->generateUrl('user_change_password'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        if($session->get('message_status')) {

            $message_status = $session->get('message_status');
            $message_title = $session->get('message_title');
            $message_content = $session->get('message_content');
        }else {
            $message_status = $message_title = $message_content = "";

        }

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => $this->get('translator')->trans("change_password", array(), "profile", $request->getLocale()),
            'view'        => 'User:password',
            'xcss'        => array (
                'plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
                'plugins/bootstrap-social-buttons/social-buttons-3.css',
                'plugins/select2/select2.css',
                'plugins/DataTables/media/css/DT_bootstrap.css'
            ),
            'xjs'         => array (
                'plugins/bootstrap-fileupload/bootstrap-fileupload.min.js',
                'plugins/jquery.pulsate/jquery.pulsate.min.js',

                'plugins/bootbox/bootbox.min.js',
                'plugins/jquery-mockjax/jquery.mockjax.js',
                'plugins/select2/select2.min.js',
                'plugins/DataTables/media/js/jquery.dataTables.min.js',
                'plugins/DataTables/media/js/DT_bootstrap.js',

                'js/jquery.validate.min.js'

            ),
            'xjs_init'    => array (
                'Main',
            ),
            'entity'      => $entity,
            'picture'     => $this->_getUserPicture($entity->getUserId()),
            'form'   => $form->createView(),
            'message_status' => $message_status,
            'message_title' => $message_title,
            'message_content' => $message_content

        );


        $session->remove('message_status');
        $session->remove('message_title');
        $session->remove('message_content');


        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);


    }

    private function _getUserPicture($userId) {

    	$common = $this->get('Common');
        $common->checkSessionAction();

    	$em = $this->getDoctrine()->getManager();
    	$user= $em->getRepository('BMGBookToolBundle:User')->find($userId);

		if($user->getUserPhoto()) {
			$picture = file_get_contents($this->container->getParameter('cdn_path') . "/" . $common->_getUserPicturePath($userId) . "/" . $user->getUserPhoto());
			return base64_encode($picture);
		}

		return false;

    }

    private function _checkIfThisIsMyProfile($dbId)
    {
    	$session = $this->getRequest()->getSession();

    	if($dbId != $session->get('user')->getUserId()) return $this->render('BMGBookToolBundle:Error:no-authorized.html.twig');
    	return true;
    }

    /*
     * This method is an initial attempt for handle the user session
    * This will be replace for Security once that part is finish
    *
    * Ask Mike for more information
    *
    */
    private function _common() {

    	//Generating $common service
    	$common = $this->get('Common');

    }}