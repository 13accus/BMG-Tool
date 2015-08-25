<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserRentalLink;
use BMG\BookToolBundle\Form\UserRentalLinkType;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * UserRentalLink controller.
 *
 */
class UserRentalLinkController extends Controller
{

    /**
     * Lists all UserRentalLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'rental');
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:UserRentalLink')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserRentalLink:index',
            'xcss'        => array (
                                
                            ),
            'xjs'         => array (
                                
                            ),
            'xjs_init'      => array (
                                'Main',
                            ),
        	'entities' => $entities,
        );

        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);
    }
    /**
     * Creates a new UserRentalLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $entity = new UserRentalLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserRentalLinkDatetime(new \Datetime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('userrentallink_show', array('id' => $entity->getRentalId())));
        }

        return $this->render('BMGBookToolBundle:UserRentalLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserRentalLink entity.
     *
     * @param UserRentalLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserRentalLink $entity)
    {
        $form = $this->createForm(new UserRentalLinkType(), $entity, array(
            'action' => $this->generateUrl('userrentallink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserRentalLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserRentalLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserRentalLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserRentalLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRentalLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRentalLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserRentalLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserRentalLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRentalLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRentalLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:UserRentalLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserRentalLink entity.
    *
    * @param UserRentalLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserRentalLink $entity)
    {
        $form = $this->createForm(new UserRentalLinkType(), $entity, array(
            'action' => $this->generateUrl('userrentallink_update', array('id' => $entity->getRentalId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserRentalLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRentalLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRentalLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userrentallink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserRentalLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserRentalLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserRentalLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserRentalLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('userrentallink'));
    }
    
    /**
     * Creates a form to delete a UserRentalLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('userrentallink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
   
}
