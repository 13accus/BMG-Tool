<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\SocialNetwork;
use BMG\BookToolBundle\Form\SocialNetworkType;

/**
 * SocialNetwork controller.
 *
 */
class SocialNetworkController extends Controller
{

    /**
     * Lists all SocialNetwork entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:SocialNetwork')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'SocialNetwork:index',
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
     * Creates a new SocialNetwork entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SocialNetwork();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('socialnetwork_show', array('id' => $entity->getSocialNetworkId())));
        }

        return $this->render('BMGBookToolBundle:SocialNetwork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SocialNetwork entity.
     *
     * @param SocialNetwork $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SocialNetwork $entity)
    {
        $form = $this->createForm(new SocialNetworkType(), $entity, array(
            'action' => $this->generateUrl('socialnetwork_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SocialNetwork entity.
     *
     */
    public function newAction()
    {
        $entity = new SocialNetwork();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:SocialNetwork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SocialNetwork entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:SocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetwork entity.');
        }


        return $this->render('BMGBookToolBundle:SocialNetwork:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing SocialNetwork entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:SocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetwork entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:SocialNetwork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SocialNetwork entity.
    *
    * @param SocialNetwork $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SocialNetwork $entity)
    {
        $form = $this->createForm(new SocialNetworkType(), $entity, array(
            'action' => $this->generateUrl('socialnetwork_update', array('id' => $entity->getSocialNetworkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SocialNetwork entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:SocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SocialNetwork entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('socialnetwork_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:SocialNetwork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
