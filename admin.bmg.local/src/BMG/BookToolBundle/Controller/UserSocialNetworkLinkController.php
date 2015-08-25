<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserSocialNetworkLink;
use BMG\BookToolBundle\Form\UserSocialNetworkLinkType;

/**
 * UserSocialNetworkLink controller.
 *
 */
class UserSocialNetworkLinkController extends Controller
{

    /**
     * Lists all UserSocialNetworkLink entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
        $session->set('tab', 'socialnetwork');
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->findAll();

		$data = array (
						'site_name'   => $this->container->getParameter('site_name'),
						'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
						'page_slogan' => 'Welcome !',
						'view'        => 'UserSocialNetworkLink:index',
						'xcss'        => array (
								'plugins/select2/select2.css',
								'plugins/DataTables/media/css/DT_bootstrap.css'
						),
						'xjs'         => array (
								'plugins/bootbox/bootbox.min.js',
								'plugins/jquery-mockjax/jquery.mockjax.js',
								'plugins/select2/select2.min.js',
								'plugins/DataTables/media/js/jquery.dataTables.min.js',
								'plugins/DataTables/media/js/DT_bootstrap.js',
								'js/pages-user-social-network-link.js'
				
						),
						'xjs_init'      => array (
								'Main',
								'TableData'
						),
						'entities' => $entities,
            );

        return $this->render('BMGBookToolBundle:Layout:skeleton.html.twig', $data);
           
    }
    /**
     * Creates a new UserSocialNetworkLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $entity = new UserSocialNetworkLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $_user = $session->get('user');
            $user = $em->getRepository('BMGBookToolBundle:User')->find($_user->getUserId());
            $entity->setUser($user);
            $entity->setUserSocialNetworkDatetime(new \Datetime("now"));
            $em->persist($entity);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('usersocialnetworklink_show', array('id' => $entity->getUserSocialNetworkLinkId())));
        }

        return $this->render('BMGBookToolBundle:UserSocialNetworkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserSocialNetworkLink entity.
     *
     * @param UserSocialNetworkLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserSocialNetworkLink $entity)
    {
        $form = $this->createForm(new UserSocialNetworkLinkType(), $entity, array(
            'action' => $this->generateUrl('usersocialnetworklink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserSocialNetworkLink entity.
     *
     */
    public function newAction()
    {
        $entity = new UserSocialNetworkLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserSocialNetworkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserSocialNetworkLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserSocialNetworkLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('BMGBookToolBundle:UserSocialNetworkLink:show.html.twig', array(
            'entity'      => $entity,
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UserSocialNetworkLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserSocialNetworkLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BMGBookToolBundle:UserSocialNetworkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserSocialNetworkLink entity.
    *
    * @param UserSocialNetworkLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserSocialNetworkLink $entity)
    {
        $form = $this->createForm(new UserSocialNetworkLinkType(), $entity, array(
            'action' => $this->generateUrl('usersocialnetworklink_update', array('id' => $entity->getUserSocialNetworkLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserSocialNetworkLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserSocialNetworkLink entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usersocialnetworklink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserSocialNetworkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        	'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a UserSocialNetworkLink entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
    	$form = $this->createDeleteForm($id);
    	$form->handleRequest($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$entity = $em->getRepository('BMGBookToolBundle:UserSocialNetworkLink')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find UserSocialNetworkLink entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	return $this->redirect($this->generateUrl('usersocialnetworklink'));
    }
    
    /**
     * Creates a form to delete a UserSocialNetworkLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('usersocialnetworklink_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete'))
    	->getForm()
    	;
    }
   
}
