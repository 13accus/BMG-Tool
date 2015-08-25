<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

class ProfileController extends Controller
{
    public function indexAction(Request $request)
    {    	

        $common = $this->get('Common');
        $common->checkSessionAction();

        $locale = $request->getLocale();
        return $this->redirect($this->generateUrl('bmg_book_tool_profile'));
    	
    }

	

}
