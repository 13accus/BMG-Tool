<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\UserRecoveryPasswordHash;
use BMG\BookToolBundle\Form\UserRecoveryPasswordHashType;

/**
 * UserRecoveryPasswordHash controller.
 *
 */
class UserRecoveryPasswordHashController extends Controller
{

    /**
     * Lists all UserRecoveryPasswordHash entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'UserRecoveryPasswordHash:index',
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
     * Creates a new UserRecoveryPasswordHash entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new UserRecoveryPasswordHash();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('userrecoverypasswordhash_show', array('id' => $entity->getUserRecoveryPasswordHashId())));
        }

        return $this->render('BMGBookToolBundle:UserRecoveryPasswordHash:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a UserRecoveryPasswordHash entity.
     *
     * @param UserRecoveryPasswordHash $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserRecoveryPasswordHash $entity)
    {
        $form = $this->createForm(new UserRecoveryPasswordHashType(), $entity, array(
            'action' => $this->generateUrl('userrecoverypasswordhash_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserRecoveryPasswordHash entity.
     *
     */
    public function newAction()
    {
        $entity = new UserRecoveryPasswordHash();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:UserRecoveryPasswordHash:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a UserRecoveryPasswordHash entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRecoveryPasswordHash entity.');
        }


        return $this->render('BMGBookToolBundle:UserRecoveryPasswordHash:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing UserRecoveryPasswordHash entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRecoveryPasswordHash entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:UserRecoveryPasswordHash:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a UserRecoveryPasswordHash entity.
    *
    * @param UserRecoveryPasswordHash $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserRecoveryPasswordHash $entity)
    {
        $form = $this->createForm(new UserRecoveryPasswordHashType(), $entity, array(
            'action' => $this->generateUrl('userrecoverypasswordhash_update', array('id' => $entity->getUserRecoveryPasswordHashId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserRecoveryPasswordHash entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:UserRecoveryPasswordHash')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserRecoveryPasswordHash entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('userrecoverypasswordhash_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:UserRecoveryPasswordHash:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
