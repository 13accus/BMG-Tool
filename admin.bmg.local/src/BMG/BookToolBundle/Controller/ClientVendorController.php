<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ClientVendor;
use BMG\BookToolBundle\Form\ClientVendorType;

/**
 * ClientVendor controller.
 *
 */
class ClientVendorController extends Controller
{

    /**
     * Lists all ClientVendor entities.
     *
     */
    public function indexAction()
    {	$session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ClientVendor')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ClientVendor:index',
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
     * Creates a new ClientVendor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ClientVendor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clientvendor_show', array('id' => $entity->getClientVendorId())));
        }

        return $this->render('BMGBookToolBundle:ClientVendor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ClientVendor entity.
     *
     * @param ClientVendor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ClientVendor $entity)
    {
        $form = $this->createForm(new ClientVendorType(), $entity, array(
            'action' => $this->generateUrl('clientvendor_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ClientVendor entity.
     *
     */
    public function newAction()
    {
        $entity = new ClientVendor();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ClientVendor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ClientVendor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendor entity.');
        }


        return $this->render('BMGBookToolBundle:ClientVendor:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ClientVendor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendor entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('BMGBookToolBundle:ClientVendor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ClientVendor entity.
    *
    * @param ClientVendor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ClientVendor $entity)
    {
        $form = $this->createForm(new ClientVendorType(), $entity, array(
            'action' => $this->generateUrl('clientvendor_update', array('id' => $entity->getClientVendorId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ClientVendor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clientvendor_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ClientVendor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
