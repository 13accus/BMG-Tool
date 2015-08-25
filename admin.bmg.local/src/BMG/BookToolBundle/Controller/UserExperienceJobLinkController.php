<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserExperienceJobLink;
use BMG\BookToolBundle\Form\UserExperienceJobLinkType;

/**
 * UserExperienceJobLink controller.
 *
 */
class UserExperienceJobLinkController extends Controller
{

    /**
     * Lists all UserExperienceJobLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'industries');

        $common = $this->get('Common');
        $common->checkSessionAction();

        $em = $this->getDoctrine()->getManager();
        $id = $session->get('user')->getUserId();

        $entities = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->findBy(array('user' => $em->getRepository('BMGBookToolBundle:User')->find($id)));

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserExperienceJobLink:index',
            'xcss'        => array (
            					'plugins/select2/select2.css',
            					'plugins/DataTables/media/css/DT_bootstrap.css'      
                            ),
        	'entities' => $entities,
        );
        
       return $this->render('BMGBookToolBundle:UserExperienceJobLink:index.html.twig', $data);
    }
    /**
     * Creates a new UserExperienceJobLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
    	$entity = new UserExperienceJobLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserExperienceJobLinkDatetime(new \DateTime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('UserExperienceJoblink_show', array('id' => $entity->getUserExperienceJobLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserExperienceJobLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserExperienceJobLink entity.
     *
     * @param UserExperienceJobLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserExperienceJobLink $entity)
    {
        $form = $this->createForm(new UserExperienceJobLinkType(), $entity, array(
            'action' => $this->generateUrl('UserExperienceJoblink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserExperienceJobLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserExperienceJobLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserExperienceJobLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserExperienceJobLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceJobLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('BMGBookToolBundle:UserExperienceJobLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserExperienceJobLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceJobLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserExperienceJobLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserExperienceJobLink entity.
    *
    * @param UserExperienceJobLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserExperienceJobLink $entity)
    {
        $form = $this->createForm(new UserExperienceJobLinkType(), $entity, array(
            'action' => $this->generateUrl('UserExperienceJoblink_update', array('id' => $entity->getUserExperienceJobLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserExperienceJobLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserExperienceJobLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('UserExperienceJoblink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserExperienceJobLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserExperienceJobLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserExperienceJobLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserExperienceJobLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('UserExperienceJoblink'));
    }
    
    /**
     * Creates a form to delete a UserExperienceJobLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('UserExperienceJoblink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
    
}
