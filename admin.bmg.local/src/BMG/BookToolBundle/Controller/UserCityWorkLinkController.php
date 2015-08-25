<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserCityWorkLink;
use BMG\BookToolBundle\Form\UserCityWorkLinkType;

/**
 * UserCityWorkLink controller.
 *
 */
class UserCityWorkLinkController extends Controller
{

    /**
     * Lists all UserCityWorkLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'city-work');

        $common = $this->get('Common');
        $common->checkSessionAction();

        $em = $this->getDoctrine()->getManager();
        $id = $session->get('user')->getUserId();

        $entities = $em->getRepository('BMGBookToolBundle:UserCityWorkLink')->findBy(array('user' => $em->getRepository('BMGBookToolBundle:User')->find($id)));

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserCityWorkLink:index',
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
     * Creates a new UserCityWorkLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $entity = new UserCityWorkLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
              
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserCityWorkLinkDatetime(new \Datetime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('usercityworklink_show', array('id' => $entity->getUserCityWorkLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserCityWorkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserCityWorkLink entity.
     *
     * @param UserCityWorkLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserCityWorkLink $entity)
    {
        $form = $this->createForm(new UserCityWorkLinkType(), $entity, array(
            'action' => $this->generateUrl('usercityworklink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserCityWorkLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserCityWorkLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserCityWorkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserCityWorkLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserCityWorkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserCityWorkLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('BMGBookToolBundle:UserCityWorkLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserCityWorkLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserCityWorkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserCityWorkLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:UserCityWorkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        		
        ));
    }

    /**
    * Creates a form to edit a UserCityWorkLink entity.
    *
    * @param UserCityWorkLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserCityWorkLink $entity)
    {
        $form = $this->createForm(new UserCityWorkLinkType(), $entity, array(
            'action' => $this->generateUrl('usercityworklink_update', array('id' => $entity->getUserCityWorkLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserCityWorkLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserCityWorkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserCityWorkLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usercityworklink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserCityWorkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserCityWorkLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserCityWorkLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserCityWorkLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('usercityworklink'));
    }
    
    /**
     * Creates a form to delete a UserCityWorkLinkk entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('usercityworklink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
    
}
