<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\Book;
use BMG\BookToolBundle\Form\BookType;

use BMG\BookToolBundle\Entity\UserUnionLink;
use BMG\BookToolBundle\Entity\UserExperienceLink;
use BMG\BookToolBundle\Entity\UserExperienceJobLink;
use BMG\BookToolBundle\Entity\UserSocialNetworkLink;
use BMG\BookToolBundle\Entity\UserClearanceLink;
/**
 * Book controller.
 *
 */
class ApiController extends Controller 
{
	
	//private $apikey = $this->container->getParameter('api_key');
	private $apikey;
	private $app_version;
	private $action;
	private $post;
	private $debug;
    /**
     * index()
     *
     * purpose: Controls the API
     * Receives as params all the required values in order to process the different methods...
     * Validates everything before calling any action (private method).
     *
     * @author Michael Barquero <mike@websol.me>
     *
     * @param $vars
     *    required variables common to all api actions
     *
     * @version 1.0.0
     *
     * @return
     *    JSON-encoded array of data
     *
     */
    public function indexAction(Request $request)
    {
    	
    	// setup output and vars objects
    	$output = new \stdClass();
    	$vars = new \stdClass();
    	
    	//Lets assume all is ok
    	$output->result_code = 200;
    	
    	$_url = parse_url($this->container->getParameter('site_url'));

    	#@todo: check this

#    	echo $_url['host'];
#		if($_SERVER['HTTP_HOST'] != $_url['host']); {
#    		$output->result_code = 405;
#    	}
    
    	//Sending out for Logging the data request | For debug
    	openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    	syslog(LOG_NOTICE, "[" . $request->getMethod() . "]: " . json_encode($_REQUEST));

    	$_request = isset($_REQUEST) ? json_encode($_REQUEST) : null;

    	if ($_request && ($output->result_code==200)) { // && $request->getMethod() == "GET") {

			$this->post = $this->_object_2_array(json_decode($_request));
    		
    		// validate & setup required request vars common to every api function
    		$fields = array('action', 'apikey');

    		$validFields = $this->_validateMe($vars, $fields, TRUE);
    		
    		$vars = $validFields->vars;
    			
    		$output->result_code = $validFields->code;
    			
    		if($output->result_code==200) {
    			// validate the API key in order to do anything further with the API
    			if (isset($vars->apikey) && !$this->_validateAPIKey($vars->apikey)) {
    				$action = isset($vars->action) ? $vars->action : '';
    				$this->_watchdog($udid, $action, 'Invalid API key.', LOG_WARNING);
    				$output->result_code = 401;
    			}    			
    		} 
    	} else {
    
    		$output->result_code = 412;
    		$this->_watchdog('null', 'null', 'Invalid method Request (No Post)', LOG_WARNING);
    
    	}
    	
    	// if there were any errors, return the error code immediately...
    	// otherwise, proceed on to the requested action...
    	if ($output->result_code !== 200) {
    	} else {
    		// now...let's figure out what action we want to perform...
			
    		switch($vars->action) {
    			case 'getCityStateByZipCode' :
    				
    				$vars = $this->getCityStatebyZipcode($vars);
    				break;
    				
    			case 'addUserUnionLink':
    				$vars = $this->addUserUnionLink($vars);
    				break;
    				
    			case 'deleteUserUnionLink':
    				$vars = $this->deleteUserUnionLink($vars);
    				break;
    			
    			case 'addUserExperienceLink':
    				$vars = $this->addUserExperienceLink($vars);
    				break;
    				
    			case 'deleteUserExperienceLink':
    				$vars = $this->deleteUserExperienceLink($vars);
    				break;
    				
    			case 'addUserExperienceJobLink':
    				$vars = $this->addUserExperienceJobLink($vars);
    				break;
    				
    			case 'deleteUserExperienceJobLink':
    				$vars = $this->deleteUserExperienceJobLink($vars);
    				break;    				
    				
    			case 'addUserSocialNetworkLink':
    				$vars = $this->addUserSocialNetworkLink($vars);
    				break;
    				
    			case 'deleteUserSocialNetworkLink':
    				$vars = $this->deleteUserSocialNetworkLink($vars);
    				break;
    				
    			case 'addUserClearanceLink':
    				$vars = $this->addUserClearanceLink($vars);
    				break;
    						
    			case 'deleteUserClearanceLink':
    				$vars = $this->deleteUserClearanceLink($vars);
    				break;

    			// non-existent action was requested
    			// return 400
    			default :
    				$this->_watchdog('','Requested action "' . $vars->action . '" invalid.', LOG_ERR);
    				$output->result_code = 400;
    		}
    		
    		$output = $vars;    		
    	};
    
    	#$response = new JsonResponse($output);

    	#if($output->result_code==200) $response->setStatusCode(200);
    	#else $response->setStatusCode(500);
    	#header('Content-type: application/json');
    	
    	unset($output->result_code);
    	echo json_encode($output);
	
    	closelog();

    	exit;
    
    }
    
    /**
     * getCityStatebyZipcode()
     *
     * purpose: Returns City, State in a single string based on Zipcode
     *
     * @author Michael Barquero <mike@websol.me>
     *
     * @param $vars
     *    required variables common to all api actions
     *
     * @version 1.0.0
     *
     * @return
     *    JSON-encoded array of data
     */
	private function getCityStatebyZipcode($vars)
	{
		
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
		
    	$fields_required = array('zipcode');
    	$validFields = $this->_validateMe($vars, $fields_required, TRUE);
    	$vars = $validFields->vars;
		$output->result_code = $validFields->code;

    	if(200 == $output->result_code) {

    		$em = $this->getDoctrine()->getManager();
    		$em->getConnection()->beginTransaction(); // suspend auto-commit

    		$result = $em->getRepository('BMGBookToolBundle:City')->findOneBy( array("cityZipcode" => $vars->zipcode) );
    		if($result) {
				$output->city = $result->getCityName();
				$output->state = $result->getState()->getStateName();
				
    		}else $output->result_code = 404;
    
    	}
    	
    	return $output;
	}

	/**
	 * catalog()
	 *
	 * purpose: Controls the API Catalog
	 * Receives as params all the required values in order to process the different methods...
	 * Validates everything before calling any action (private method).
	 *
	 * @author Michael Barquero <mike@websol.me>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 *
	 */
	
	public function catalogAction($catalog)
	{
		// setup output and vars objects
		$output = array();
		$catalogOptions = array('unions','experience','socialNetwork','clearance','experience_job');
	
		//Sending out for Logging the data request | For debug
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Catalog: $catalog");
	
		if (in_array($catalog, $catalogOptions)) {

			switch($catalog) {
				case 'unions' :
					$response = new JsonResponse($this->getUnions());
					break;
					
				case 'experience' :
					$response = new JsonResponse($this->getExperience());
					break;

				case 'experience_job' :
					$response = new JsonResponse($this->getExperienceJob());
					break;					
					
				case 'socialNetwork' :
					$response = new JsonResponse($this->getSocialNetwork());
					break;
					
				case 'clearance' :
					$response = new JsonResponse($this->getClearance());
					break;
			}
				
			$response->setStatusCode(200);
			return $response;			
			
			exit;
				
		}
			
		closelog();
		exit;
	
	}
	
	
	/**
	 * getUnions()
	 *
	 * purpose: Returns Json with all the Unions
	 *
	 * @author Michael Barquero <mbarquero@generastrategies.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function getUnions()
	{
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('BMGBookToolBundle:Unions')->findAll();
		
		if($result) {
			
			foreach ($result as $key => $value) {

				$_return['unionId'] = $value->getUnionId();
				$_return['unionName'] = $value->getUnionName();
				
				$return[] = $_return;
				
			}
			
		}else return false;
		
		return $return;
	}
	/**
	 * getClearance()
	 *
	 * purpose: Returns Json with all the Clearances
	 *
	 * @author Michael Barquero <mbarquero@generastrategies.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function getClearance()
	{
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('BMGBookToolBundle:Clearance')->findAll();
	
		if($result) {
	
			foreach ($result as $key => $value) {
	
				$_return['clearanceId'] = $value->getClearanceId();
				$_return['clearanceDesc'] = $value->getClearanceDesc();
	
				$return[] = $_return;
	
			}
	
		}else return false;
	
		return $return;
	}	
	
	/**
	 * add userClearanceLink()
	 *
	 * purpose: Add user relation between user and clearance where clearance = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function addUserClearanceLink($vars)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('clearance');
			
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Add Clearance " . $vars->clearance . "for User #" . $user->getUserId());
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$clearance = $em->getRepository('BMGBookToolBundle:Clearance')->findOneBy( array('clearanceDesc' => $vars->clearance) );
	
			$entity = new UserClearanceLink();
			$entity->setUser($user);
			$entity->setClearance($clearance);
			$entity->setUserClearanceLinkDatetime(new \Datetime("now"));
			$em->persist($entity);
			$em->persist($user);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	/**
	 * delete userClearanceLink()
	 *
	 * purpose: Remove user relation between user and clearance where clearance = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function deleteUserClearanceLink($vars)
	{
	
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('clearance');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Delete Clearance " . $vars->clearance . "for User #" . $user->getUserId());
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$clearance = $em->getRepository('BMGBookToolBundle:Clearance')->findOneBy( array('clearanceDesc' => $vars->clearance) );
	
			$entity = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->findOneBy( array("clearance" => $clearance, "user" => $user) );
	
			if (!$entity) {
				$output->result_code = 404;
				throw $this->createNotFoundException('Unable to find entity #309');
			}
	
			$em->remove($entity);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	/**
	 * add userUnionLink()
	 *
	 * purpose: Add user relation between user and union where union = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function addUserUnionLink($vars)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('union');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Add Union " . $vars->union . "for User #" . $user->getUserId());
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$union = $em->getRepository('BMGBookToolBundle:Unions')->findOneBy( array('unionName' => $vars->union) );

			$entity = new UserUnionLink();
			$entity->setUser($user);
			$entity->setUnion($union);
			$entity->setUserUnionLinkDatetime(new \Datetime("now"));
			$em->persist($entity);
			$em->persist($user);
			$em->flush();
			
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	/**
	 * delete userUnionLink()
	 *
	 * purpose: Remove user relation between user and union where union = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function deleteUserUnionLink($vars)
	{
	
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('union');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    	syslog(LOG_NOTICE, "Delete Union " . $vars->union . "for User #" . $user->getUserId());
		
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$union = $em->getRepository('BMGBookToolBundle:Unions')->findOneBy( array('unionName' => $vars->union) );
			
			$entity = $em->getRepository('BMGBookToolBundle:UserUnionLink')->findOneBy( array("union" => $union, "user" => $user) );
			
			if (!$entity) {
				$output->result_code = 404;
				throw $this->createNotFoundException('Unable to find entity #309');
			}
			
			$em->remove($entity);
			$em->flush();

			return array('say'=>'ok');	
		}
			
		return $output;
	}
	/**
	 * getExperience()
	 *
	 * purpose: Returns Json with all the Experience
	 *
	 * @author Michael Barquero <mbarquero@generastrategies.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function getExperience()
	{
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('BMGBookToolBundle:Experience')->findAll();
		if($result) {
				
			foreach ($result as $key => $value) {
	
				$_return['experienceId'] = $value->getExperienceId();
				$_return['experienceName'] = $value->getExperienceName();
				$return[] = $_return;
	
			}
				
		}else return false;
	
		return $return;
	}
	
	/**
	 * getExperienceJob()
	 *
	 * purpose: Returns Json with all the Experience Job (Industries)
	 *
	 * @author Michael Barquero <mbarquero@generastrategies.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function getExperienceJob()
	{
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('BMGBookToolBundle:ExperienceJob')->findAll();
		if($result) {
	
			foreach ($result as $key => $value) {
	
				$_return['experienceJobId'] = $value->getExperienceJobId();
				$_return['experienceJobName'] = $value->getExperienceJobName();
				$return[] = $_return;
	
			}
	
		}else return false;
	
		return $return;
	}	

	/**
	 * add userExperienceLink()
	 *
	 * purpose: Add user relation between user and experience where experience = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function addUserExperienceLink($vars)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('experience','userExperienceLinkRate');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Add Experience {$vars->experience} Rate: {$vars->userExperienceLinkRate} for User # {$user->getUserId()}");
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$experience = $em->getRepository('BMGBookToolBundle:Experience')->findOneBy( array('experienceName' => $vars->experience) );
			
			$entity = new UserExperienceLink();
			$entity->setUser($user);
			$entity->setExperience($experience);
			$entity->setUserExperienceLinkRate($vars->userExperienceLinkRate);
			$entity->setUserExperienceLinkDatetime(new \Datetime("now"));
			$em->persist($entity);
			$em->persist($user);
			$em->flush();
				
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	/**
	 * delete userExperienceLink()
	 *
	 * purpose: Remove user relation between user and experience where experience = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function deleteUserExperienceLink($vars)
	{
	
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('experience');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Delete Experience " . $vars->experience . "for User #" . $user->getUserId());
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$experience = $em->getRepository('BMGBookToolBundle:Experience')->findOneBy( array('experienceName' => $vars->experience) );
			//$rate = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->findOneBy( array('userExperienceLinkRate' => $vars->userExperienceLinkRate) );
			$entity = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->findOneBy( array("experience" => $experience, "user" => $user) );
				
			if (!$entity) {
				$output->result_code = 404;
				throw $this->createNotFoundException('Unable to find entity #309');
			}
				
			$em->remove($entity);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}
	

	/**
	 * add userExperienceJobLink()
	 *
	 * purpose: Add user relation between user and experience where experience = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function addUserExperienceJobLink($vars)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('experience');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Add Experience {$vars->experience} for User # {$user->getUserId()}");
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$experience = $em->getRepository('BMGBookToolBundle:ExperienceJob')->findOneBy( array('experienceJobName' => $vars->experience) );
				
			$entity = new UserExperienceJobLink();
			$entity->setUser($user);
			$entity->setExperienceJob($experience);
			$entity->setUserExperienceJobLinkDatetime(new \Datetime("now"));
			$em->persist($entity);
			$em->persist($user);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	/**
	 * delete userExperienceJobLink()
	 *
	 * purpose: Remove user relation between user and experience where experience = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function deleteUserExperienceJobLink($vars)
	{
	
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('experience');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Delete Experience " . $vars->experience . "for User #" . $user->getUserId());
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			$experience = $em->getRepository('BMGBookToolBundle:ExperienceJob')->findOneBy( array('experienceJobName' => $vars->experience) );
			$entity = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->findOneBy( array("experienceJob" => $experience, "user" => $user) );
	
			if (!$entity) {
				$output->result_code = 404;
				throw $this->createNotFoundException('Unable to find entity #309');
			}
	
			$em->remove($entity);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}	
	
	/**
	 * getSocialNetwork()
	 *
	 * purpose: Returns Json with all the SocialNetwork
	 *
	 * @author Michael Barquero <mbarquero@generastrategies.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function getSocialNetwork()
	{
		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findAll();
		if($result) {
	
			foreach ($result as $key => $value) {
	
				$_return['socialNetworkId'] = $value->getSocialNetworkId();
				$_return['socialNetworkName'] = $value->getSocialNetworkName();
				$return[] = $_return;
	
			}
	
		}else return false;
	
		return $return;
	}
	
	/**
	 * add userSocialNetworkLink()
	 *
	 * purpose: Add user relation between user and socialNetwork where socialNetwork = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function addUserSocialNetworkLink($vars)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('userSocialNetworkAccount','socialNetworkName');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Add SocialNetwork {$vars->userSocialNetworkAccount} SocialNetworkName: {$vars->socialNetworkName} for User # {$user->getUserId()}");
	
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			
				
			$socialNetworkName = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneBy( array('socialNetworkName' => $vars->socialNetworkName) );
			
			$entity = new userSocialNetworkLink();
			$entity->setUser($user);
			$entity->setSocialNetwork($socialNetworkName);
			$entity->setuserSocialNetworkAccount($vars->userSocialNetworkAccount);
			$em->persist($entity);
			$em->persist($user);
			$em->flush();
			return array('say'=>'ok');
		}
			
		return $output;
	}

	/**
	 * delete userSocialNetworkLink()
	 *
	 * purpose: Remove user relation between user and SocialNetwork where SocialNetwork = param and user = session
	 *
	 * @author Michael Barquero <mbarquero@broadcastmgmt.com>
	 *
	 * @param $vars
	 *    required variables common to all api actions
	 *
	 * @version 1.0.0
	 *
	 * @return
	 *    JSON-encoded array of data
	 */
	private function deleteUserSocialNetworkLink($vars)
	{
	
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
	
		// setup output object
		$output = new \stdClass();
		$output->result_code = 200;
	
		$fields_required = array('socialNetworkName');
		$validFields = $this->_validateMe($vars, $fields_required, TRUE);
		$vars = $validFields->vars;
		$output->result_code = $validFields->code;
	
		openlog("BMG-Tool-API", LOG_PID | LOG_PERROR, LOG_LOCAL0);
		syslog(LOG_NOTICE, "Delete SocialNetwork .$vars->socialNetworkName. for User # ". $user->getUserId());
		
		if(200 == $output->result_code) {
	
			$em = $this->getDoctrine()->getManager();
	
			$user = $em->getRepository('BMGBookToolBundle:User')->find( $user->getUserId() );
			//$userSocialNetworkAccount = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneBy( array('userSocialNetworkAccount' => $vars->userSocialNetworkAccount) );
			$socialNetworkName = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findOneBy( array('socialNetworkName' => $vars->socialNetworkName) );
			$entity = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findOneBy( array("socialNetwork" => $socialNetworkName, "user" => $user) );
	
			if (!$entity) {
				$output->result_code = 404;
				throw $this->createNotFoundException('Unable to find entity #309');
			}
	
			$em->remove($entity);
			$em->flush();
	
			return array('say'=>'ok');
		}
			
		return $output;
	}
	
	
    // =====================================================================================
    // INTERNAL HELPER FUNCTIONS
    // =====================================================================================    
    
    private function _validateMe($vars, $fields, $required = TRUE)
    {

    	// setup result object
    	$result = new \stdClass();
    
    	// include existing vars to result
    	$result->vars = $vars;
    
    	if ($required) :
	    	// assume success
    		$result->code = 200;
    	endif;
    
    	// loop through the fields and validate
    	foreach ($fields as $key => $value) {
			
    		if ($this->post[$value] != '') {
    			$result->vars->$value = $this->post[$value];
				//echo "Found: $value: " . $this->post[$value] . '|';
    		}else {
				#echo "Missing: $value "; if(!$required) {echo ' ~ optional'; } echo '|';
    			if ($required) :
    				$result->code = 403;
    			endif;
    		}    
    	}
    	
    	return $result;
    }
    
    private function _validateAPIKey($apiKey)
    {
    	return TRUE;
    	
    	if ($apiKey !== $this->apikey) return FALSE;
    	else return TRUE;
    }
    
    private function _watchdog($action, $message, $type)
    {
    	if($this->debug == TRUE) {
    		syslog($type, "$action | $message");
    		#print("$type|$udid|$action|$message");
    	}
    }
    
    private function _json_to_post() {
    
    	return $this->_object_2_array($this->post);
    
    	// ////////////////////////////////
    	global $array;
    	$this->_object_2_array($this->post);
    	foreach ($array as $key => $value) {
    		if(is_array($value)) unset($array[$key]);
    	}
    
    	$this->post = $array;
    
    	return $this->post;
    }
    
    private function _object_2_array($result)
    {
    
    	$array = array();
    		
    	foreach ($result as $key=>$value):
    		
    	if (is_object($value)) :
    	$array[$key] = $this->_object_2_array($value);
    
    	elseif (is_array($value)) :
    
    	$array[$key] = $this->_object_2_array($value);
    	else :
    	$array[$key]=$value;
    	endif;
    	endforeach;
    
    	return $array;
    }
    
    private function _validateUDID($udid)
    {
    	return TRUE;
    	
    	if($this->get('custom_db')->getFactory('ApiCustom')->getDevice($udid, FALSE)) return TRUE;
    	else return FALSE;
    }
    
    private function _array_to_obj($array, &$obj)
    {
    	foreach ($array as $key => $value)
    	{
    		if (is_array($value))
    		{
    			$obj->$key = new \stdClass();
    			$this->_array_to_obj($value, $obj->$key);
    		}
    		else
    		{
    			$obj->$key = $value;
    		}
    	}
    	return $obj;
    }
    
    private function _arrayToObject($array)
    {
    	$object= new \stdClass();
    	return $this->_array_to_obj($array,$object);
    }
    
    private function _isJson($string) {
    	json_decode($string);
    	return (json_last_error() == JSON_ERROR_NONE);
    }
   
}
