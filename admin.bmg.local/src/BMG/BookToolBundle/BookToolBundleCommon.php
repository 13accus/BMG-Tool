<?php

namespace BMG\BookToolBundle;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;


class BookToolBundleCommon {    

    private $container;
    public static $variable;
    
    public function __construct (Container $container)
    {
        $this->container = $container;
        $this->checkSessionAction();
    }
    
    public static function checkSessionAction()
    {     
    	
    	$allowedWithoutSession = array('forgot-password','login', 'feedback','doPasswordRecovery','create-password');

    	$allowed = false;
    	foreach ($allowedWithoutSession as $value) {
    		if(strstr($_SERVER['REQUEST_URI'], '/' . $value)) $allowed = true;
    	}


        if($allowed) return true;
    	
        $request = Request::createFromGlobals();

        @$session = new Session();

        if($session->get("user")) {

            //Yes!, we have an existing session ,lets just redirect to the dashboard
            // Lets check if the user even with an existing session is try to login, if so lets just redirect to the dashboard

            if(strstr($_SERVER['REQUEST_URI'], '/login')) {
                 // Welcome back, lets just redirect to the dashboard since you have an existing session

                $url = "/" . $request->getLocale() . "/";
                Header("Location: $url");
                exit;
            }
            
            return true;


        }else {

            //No session, lets redirect to the login page, except if we are already in the login page
			
            if(!strstr($_SERVER['REQUEST_URI'], '/login')) {

                // user not in the login page, lets redirect
                $url = "/" . $request->getLocale() . "/login";
                Header("Location: $url");
                exit;
            }

        }

        return self::$variable;
    }

    public static function  getAutoGeneratedCode($random_string_length=1)
    {
        //$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $characters = '0123456789';
        $string = '';

        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
    
    public static function generateGoogleShorURL($longUrl) {

        //This is the URL you want to shorten
        $apiKey = 'AIzaSyAJBstlR9q8hU87tiy5v1x4XvSap3G1zm0';

        //Get API key from : http://code.google.com/apis/console/
     
        $postData = array('longUrl' => $longUrl, 'key' => $apiKey);
        $jsonData = json_encode($postData);

        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        curl_setopt($curlObj, CURLOPT_POST, 1);
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($curlObj);

        //change the response json string to object
        $json = json_decode($response);

        curl_close($curlObj);

        return $json->id;
    } 
    
    public function sendMail($to, $subject, $body, $attachment = null, $renderTemplate = false, $renderParams = null) {

        $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setFrom($this->container->getParameter('mailer_email_from'), $this->container->getParameter('mailer_envelope_from'))
        ->setTo($to);
       // ->addBcc("mbarquero@broadcastmgmt.com");
        
        if($subject)
            $message->setSubject($subject);
        
        if ($attachment) {
            if (is_array($attachment)) {
                foreach ($attachment as $file) {
                    $message->attach(\Swift_Attachment::fromPath($file));
                }
            } else {
                $message->attach(\Swift_Attachment::fromPath($attachment));
            }
        }
        
        if ($renderTemplate) {

            $templating = $this->container->get('templating');

            if($templating->exists($body)) {

                $message->setBody($templating->render($body, $renderParams));
            } else {

        
            }

        } else {
            $message->setBody($body);
        }
        
        try {
            $this->container->get('mailer')->send($message);
        } catch (\Swift_TransportException $exc) {
            return false;
        }
        
        return true;
    }
    
    /*
     * This function will locate the image into the file structure
    * and convert it to base 64 in order to not use publicly paths
    * with user images.
    */
    public function _getUserPicturePath($userId) {
    	 
    	/*
    	 * To start we are going to support up to 999,999,999,999 users only
    	* The way we are going to store phisically the picture will be in
    	* a file structure like this one:
    	*
    	* 999,999,999,999
    	* 1,  2,  3,  4
    	*
    	* Where 1,2,3 and 4 are folders
    	*
    	* So each folder will contain only 999 images
    	*
    	* For instance userId 1999 picture will be stored like this:
    	*
    	* 000/000/001/999/
    	*
    	*/
    
    	$userId = str_pad($userId, 12, '0', STR_PAD_LEFT);
    	 
    	$depth = str_split($userId, 3);
    	$depth_count = count($depth)-1;
    	 
    	$path = "";
    	for ($i=0; $i<=$depth_count; $i++) {
    		$path .= $depth[$i] ."/";
    	}
    	 
    	return substr($path, 0, -1);
    }
    
}
