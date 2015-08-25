<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserExperienceLink;
use BMG\BookToolBundle\Form\UserExperienceLinkType;

/**
 * UserExperienceLink controller.
 *
 */
class UserExperienceLinkController extends Controller
{

    /**
     * Lists all UserExperienceLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'experience');

        $common = $this->get('Common');
        $common->checkSessionAction();

        $em = $this->getDoctrine()->getManager();
        $id = $session->get('user')->getUserId();

        $entities = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->findBy(array('user' => $em->getRepository('BMGBookToolBundle:User')->find($id)));

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserExperienceLink:index',
            'xcss'        => array (
            					'plugins/select2/select2.css',
            					'plugins/DataTables/media/css/DT_bootstrap.css'      
                            ),
        	'entities' => $entities,
        );
        
       return $this->render('BMGBookToolBundle:UserExperienceLink:index.html.twig', $data);
    }
    /**
     * Creates a new UserExperienceLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
    	$entity = new UserExperienceLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserExperienceLinkDatetime(new \DateTime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('UserExperienceLink_show', array('id' => $entity->getUserExperienceLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserExperienceLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserExperienceLink entity.
     *
     * @param UserExperienceLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserExperienceLink $entity)
    {
        $form = $this->createForm(new UserExperienceLinkType(), $entity, array(
            'action' => $this->generateUrl('UserExperienceLink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserExperienceLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserExperienceLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserExperienceLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserExperienceLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('BMGBookToolBundle:UserExperienceLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserExperienceLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserExperienceLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserExperienceLink entity.
    *
    * @param UserExperienceLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserExperienceLink $entity)
    {
        $form = $this->createForm(new UserExperienceLinkType(), $entity, array(
            'action' => $this->generateUrl('UserExperienceLink_update', array('id' => $entity->getUserExperienceLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserExperienceLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('UserExperienceLink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserExperienceLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserExperienceLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserExperienceLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserExperienceLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('UserExperienceLink'));
    }
    
    /**
     * Creates a form to delete a UserExperienceLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('UserExperienceLink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
    
}
