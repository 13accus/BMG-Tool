<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\VendorSocialNetwork;
use BMG\BookToolBundle\Form\VendorSocialNetworkType;

/**
 * VendorSocialNetwork controller.
 *
 */
class VendorSocialNetworkController extends Controller
{

    /**
     * Lists all VendorSocialNetwork entities.
     *
     */
    public function indexAction()
    {
        $session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	 
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:VendorSocialNetwork')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'VendorSocialNetwork:index',
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
     * Creates a new VendorSocialNetwork entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new VendorSocialNetwork();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vendorsocialnetwork_show', array('id' => $entity->getVendorSocialNetworkId())));
        }

        return $this->render('BMGBookToolBundle:VendorSocialNetwork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a VendorSocialNetwork entity.
     *
     * @param VendorSocialNetwork $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VendorSocialNetwork $entity)
    {
        $form = $this->createForm(new VendorSocialNetworkType(), $entity, array(
            'action' => $this->generateUrl('vendorsocialnetwork_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VendorSocialNetwork entity.
     *
     */
    public function newAction()
    {
        $entity = new VendorSocialNetwork();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:VendorSocialNetwork:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VendorSocialNetwork entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:VendorSocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorSocialNetwork entity.');
        }


        return $this->render('BMGBookToolBundle:VendorSocialNetwork:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing VendorSocialNetwork entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:VendorSocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorSocialNetwork entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:VendorSocialNetwork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a VendorSocialNetwork entity.
    *
    * @param VendorSocialNetwork $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VendorSocialNetwork $entity)
    {
        $form = $this->createForm(new VendorSocialNetworkType(), $entity, array(
            'action' => $this->generateUrl('vendorsocialnetwork_update', array('id' => $entity->getVendorSocialNetworkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VendorSocialNetwork entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:VendorSocialNetwork')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorSocialNetwork entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vendorsocialnetwork_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:VendorSocialNetwork:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
