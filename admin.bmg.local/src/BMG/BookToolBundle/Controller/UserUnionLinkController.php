<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserUnionLink;
use BMG\BookToolBundle\Form\UserUnionLinkType;

/**
 * UserUnionLink controller.
 *
 */
class UserUnionLinkController extends Controller
{
	
    /**
     * Lists all UserUnionLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'union');

        $common = $this->get('Common');
        $common->checkSessionAction();

        $em = $this->getDoctrine()->getManager();
        $id = $session->get('user')->getUserId();

        $entities = $em->getRepository('BMGBookToolBundle:UserUnionLink')->findBy(array('user' => $em->getRepository('BMGBookToolBundle:User')->find($id)));

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserUnionLink:index',
            'xcss'        => array (
            					'plugins/select2/select2.css',
            					'plugins/DataTables/media/css/DT_bootstrap.css'            
                            ),
        	'entities' => $entities,
        );

        return $this->render('BMGBookToolBundle:UserUnionLink:index.html.twig', $data);
    }
    /**
     * Creates a new UserUnionLink entity.
     *
     */
    public function createAction(Request $request)
    {
    	$session = $this->getRequest()->getSession();
        $entity = new UserUnionLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserUnionLinkDatetime(new \Datetime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('userunionlink_show', array('id' => $entity->getUserUnionLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserUnionLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserUnionLink entity.
     *
     * @param UserUnionLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserUnionLink $entity)
    {
        $form = $this->createForm(new UserUnionLinkType(), $entity, array(
            'action' => $this->generateUrl('userunionlink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserUnionLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserUnionLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserUnionLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserUnionLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserUnionLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserUnionLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('BMGBookToolBundle:UserUnionLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserUnionLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserUnionLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserUnionLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('BMGBookToolBundle:UserUnionLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserUnionLink entity.
    *
    * @param UserUnionLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserUnionLink $entity)
    {
        $form = $this->createForm(new UserUnionLinkType(), $entity, array(
            'action' => $this->generateUrl('userunionlink_update', array('id' => $entity->getUserUnionLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserUnionLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserUnionLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserUnionLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userunionlink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserUnionLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserUnionLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserUnionLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserUnionLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('userunionlink'));
    }
    
    /**
     * Creates a form to delete a UserUnionLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('userunionlink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
   
}
