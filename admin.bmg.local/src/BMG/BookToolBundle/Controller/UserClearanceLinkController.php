<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserClearanceLink;
use BMG\BookToolBundle\Form\UserClearanceLinkType;

/**
 * UserClearanceLink controller.
 *
 */
class UserClearanceLinkController extends Controller
{

    /**
     * Lists all UserClearanceLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'clearance');
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
    	$user = $session->get('user');
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository("BMGBookToolBundle:User")->find($user->getUserId());
    	
        
        if($user->getUserAdmin())
      		$id = 4756;
		else
			$id = $session->get('user')->getUserId();
        
        $entities = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->findby(array('user' => $em->getRepository('BMGBookToolBundle:User')->find($id)));

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserClearanceLink:index',
            'xcss'        => array (
            					'plugins/select2/select2.css',
            					'plugins/DataTables/media/css/DT_bootstrap.css'            
                            ),
        	'entities' => $entities,
        );

        return $this->render('BMGBookToolBundle:UserClearanceLink:index.html.twig', $data);
    }
    /**
     * Creates a new UserClearanceLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $entity = new UserClearanceLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserClearanceLinkDatetime(new \Datetime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('userclearancelink_show', array('id' => $entity->getUserClearanceLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserClearanceLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserClearanceLink entity.
     *
     * @param UserClearanceLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserClearanceLink $entity)
    {
        $form = $this->createForm(new UserClearanceLinkType(), $entity, array(
            'action' => $this->generateUrl('userclearancelink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserClearanceLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserClearanceLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserClearanceLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserClearanceLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserClearanceLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserClearanceLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserClearanceLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserClearanceLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserClearanceLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserClearanceLink entity.
    *
    * @param UserClearanceLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserClearanceLink $entity)
    {
        $form = $this->createForm(new UserClearanceLinkType(), $entity, array(
            'action' => $this->generateUrl('userclearancelink_update', array('id' => $entity->getUserClearanceLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserClearanceLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserClearanceLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userclearancelink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserClearanceLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserClearanceLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserClearanceLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserClearanceLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('userclearancelink'));
    }
    
    /**
     * Creates a form to delete a UserClearanceLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('userclearancelink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
   
}
