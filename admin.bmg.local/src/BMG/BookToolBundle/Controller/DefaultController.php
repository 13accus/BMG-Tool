<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    var $missingFields;

    public function indexAction(Request $request)
    {    	

        $common = $this->get('Common');
        $common->checkSessionAction();

        $locale = $request->getLocale();
        return $this->redirect($this->generateUrl('bmg_book_tool_welcome'));
    	
    }

    public function welcomeAction()
    {
        $session = $this->getRequest()->getSession();

        global $missingFields;

        $common = $this->get('Common');
        $common->checkSessionAction();
        
        $profileCompletionPercentaje = $this->checkProfileCompletion($session->get('user'));

        $message_status = $message_title = $message_content = "";

        if($session->get('message_status')) {
            $message_status = $session->get('message_status');
            $message_title = $session->get('message_title');
            $message_content = $session->get('message_content');
        }

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Dashboard',
            'page_slogan' => 'Welcome !',
        	'profileCompletionPercentaje' => $profileCompletionPercentaje,
            'missing_fields' => $missingFields,
            'view'        => 'Dashboard:index',
            'xcss'        => array (

                            ),
            'xjs'         => array (

                            ),
            'xjs_init'      => array (
                                'Main',
                            ),
            'message_status' => $message_status,
            'message_title' => $message_title,
            'message_content' => $message_content

        );

        $session->remove('message_status');
        $session->remove('message_title');
        $session->remove('message_content');


        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);
    }

    public function dashboardAction()
    {
        $session = $this->getRequest()->getSession();

        $common = $this->get('Common');
        $common->checkSessionAction();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Dashboard',
            'page_slogan' => 'Welcome !',
            'view'        => 'Dashboard:dashboard',
            'xcss'        => array (
                                'plugins/fullcalendar/fullcalendar/fullcalendar.css',
                            ),
            'xjs'         => array (
                                'plugins/flot/jquery.flot.js',
                                'plugins/flot/jquery.flot.pie.js',
                                'plugins/flot/jquery.flot.resize.min.js',
                                'plugins/jquery.sparkline/jquery.sparkline.js',
                                'plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
                                'plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
                                'plugins/fullcalendar/fullcalendar/fullcalendar.js',
                                'js/index.js'
                            ),
            'xjs_init'      => array (
                                'Main',
                                'Index',
                            ),
        );


        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);
    }
    
    /*
     * This method will be move to another COMMON place later
     */
    
    public function checkProfileCompletion($userObj) {

        global $missingFields;

        $request = $this->getRequest();

    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository("BMGBookToolBundle:User")->find($userObj->getUserId());

    	//Setting elements needs to be filled in order to consider a profile 100% ready.
        //Check also

    	$user_fields_to_check = array(

    			//From the registration
    			array('getUserId', $this->get('translator')->trans("user_id", array(), "profile", $request->getLocale())),
                array('getUserEmail',$this->get('translator')->trans("email", array(), "profile", $request->getLocale())),
                array('getUserPassword',$this->get('translator')->trans("password", array(), "profile", $request->getLocale())),
                array('getUserFirstname',$this->get('translator')->trans("firstname", array(), "profile", $request->getLocale())),
                array('getUserLastname',$this->get('translator')->trans("lastname", array(), "profile", $request->getLocale())),
                array('getUserIp',$this->get('translator')->trans("ip", array(), "profile", $request->getLocale())),
                array('getUserCreateDatetime',$this->get('translator')->trans("create_date", array(), "profile", $request->getLocale())),
                array('getStatus',$this->get('translator')->trans("status", array(), "profile", $request->getLocale())),

    			//Real fields to be completed
                array('getUserGender',$this->get('translator')->trans("gender", array(), "profile", $request->getLocale())),
                array('getUserAddress1',$this->get('translator')->trans("address", array(), "profile", $request->getLocale())),
                array('getUserZipcode',$this->get('translator')->trans("zipcode", array(), "profile", $request->getLocale())),
                array('getUserMobile',$this->get('translator')->trans("mobile", array(), "profile", $request->getLocale())),
                array('getUserWebsite',$this->get('translator')->trans("website", array(), "profile", $request->getLocale())),
                array('getUserBio',$this->get('translator')->trans("biography", array(), "profile", $request->getLocale())),
                array('getUserPhoto',$this->get('translator')->trans("picture", array(), "profile", $request->getLocale())),
                array('getCity',$this->get('translator')->trans("city", array(), "profile", $request->getLocale())),
    	);

    	$link_tables = array (
     			#array('UserExperienceJobLink', $this->get('translator')->trans("Industries", array(), "profile", $request->getLocale())),
     			#array('UserExperienceLink', $this->get('translator')->trans("Experience", array(), "profile", $request->getLocale())),
     			#array('UserSocialNetworkLink', $this->get('translator')->trans("Social Networks", array(), "profile", $request->getLocale())),
     			#array('UserUnionLink', $this->get('translator')->trans("Unions", array(), "profile", $request->getLocale()))
    	);
    	 
    	$countMissingFields = 0;

    	//Checking user table first    	
    	foreach ($user_fields_to_check as $key => $value) {
    		$field = $value[0];
            if(!$user->$field()) {
                $countMissingFields++;
                $missingFields[] = $value[1];
            }
    	}
    	
    	
    	//Link tables
    	foreach ($link_tables as $key => $value) {
            $table = $value[0];
    		$link = $em->getRepository("BMGBookToolBundle:$table")->findby(array('user'=>$user));
    		if(!$link) {
                $countMissingFields++;
                $missingFields[] = $value[1];
            }
    	}

        sort($missingFields);
    	
    	//Getting the final value;
    	//Getting the number of fields/tables to check
    	$fields_to_complete = count($user_fields_to_check) + count($link_tables); //Manually entry for Other user values    	

    	//Getting the percentage of profile completion
    	$profileCompletion = ceil((($fields_to_complete-$countMissingFields)*100)/$fields_to_complete);
    	
    	return ceil($profileCompletion); 
    	 
    }

    public function feedbackAction() {

        $to = "mbarquero@GenEraStrategies.com";
        $subject = "BMG Tool | Feedback Form";

        if($_POST) {

            $message = $_POST['feedback'];

            $session = $this->getRequest()->getSession();
            $tab = $session->get('tab');

            $tab = isset($tab) ? $tab : 'None';

            $parameters = array(
                'message' => $message,
                'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
                'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
                'REQUEST_URI' => $_SERVER['REQUEST_URI'],
                'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'],
                'TAB'=> $tab
            );

            $common = $this->get('Common');

            try {
                $common->sendMail($to,
                    $subject,
                    'BMGBookToolBundle:Email:feedback.html.twig',
                    null,
                    true,
                    $parameters);
            } catch (\Exception $exc) {
                echo "Message Not Sent";
            }

            echo "Message Sent";

        }else {
            echo "Message Not Sent";
        }

        return new Response();
    }

}
