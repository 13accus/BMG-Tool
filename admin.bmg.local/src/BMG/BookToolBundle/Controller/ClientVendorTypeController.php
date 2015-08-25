<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ClientVendorType;
use BMG\BookToolBundle\Form\ClientVendorTypeType;

/**
 * ClientVendorType controller.
 *
 */
class ClientVendorTypeController extends Controller
{

    /**
     * Lists all ClientVendorType entities.
     *
     */
    public function indexAction()
    {	
    	$session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ClientVendorType')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ClientVendorType:index',
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
     * Creates a new ClientVendorType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ClientVendorType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clientvendortype_show', array('id' => $entity->getClientVendorTypeId())));
        }

        return $this->render('BMGBookToolBundle:ClientVendorType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ClientVendorType entity.
     *
     * @param ClientVendorType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ClientVendorType $entity)
    {
        $form = $this->createForm(new ClientVendorTypeType(), $entity, array(
            'action' => $this->generateUrl('clientvendortype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ClientVendorType entity.
     *
     */
    public function newAction()
    {
        $entity = new ClientVendorType();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ClientVendorType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ClientVendorType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendorType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendorType entity.');
        }


        return $this->render('BMGBookToolBundle:ClientVendorType:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ClientVendorType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendorType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendorType entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ClientVendorType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ClientVendorType entity.
    *
    * @param ClientVendorType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ClientVendorType $entity)
    {
        $form = $this->createForm(new ClientVendorTypeType(), $entity, array(
            'action' => $this->generateUrl('clientvendortype_update', array('id' => $entity->getClientVendorTypeId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ClientVendorType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ClientVendorType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClientVendorType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clientvendortype_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ClientVendorType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
