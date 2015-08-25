<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ProjectVendorClientLink;
use BMG\BookToolBundle\Form\ProjectVendorClientLinkType;

/**
 * ProjectVendorClientLink controller.
 *
 */
class ProjectVendorClientLinkController extends Controller
{

    /**
     * Lists all ProjectVendorClientLink entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ProjectVendorClientLink')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ProjectVendorClientLink:index',
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
     * Creates a new ProjectVendorClientLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProjectVendorClientLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('projectvendorclientlink_show', array('id' => $entity->getProjectVendorClientLinkId())));
        }

        return $this->render('BMGBookToolBundle:ProjectVendorClientLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProjectVendorClientLink entity.
     *
     * @param ProjectVendorClientLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProjectVendorClientLink $entity)
    {
        $form = $this->createForm(new ProjectVendorClientLinkType(), $entity, array(
            'action' => $this->generateUrl('projectvendorclientlink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProjectVendorClientLink entity.
     *
     */
    public function newAction()
    {
        $entity = new ProjectVendorClientLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ProjectVendorClientLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectVendorClientLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectVendorClientLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectVendorClientLink entity.');
        }


        return $this->render('BMGBookToolBundle:ProjectVendorClientLink:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ProjectVendorClientLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectVendorClientLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectVendorClientLink entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ProjectVendorClientLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProjectVendorClientLink entity.
    *
    * @param ProjectVendorClientLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProjectVendorClientLink $entity)
    {
        $form = $this->createForm(new ProjectVendorClientLinkType(), $entity, array(
            'action' => $this->generateUrl('projectvendorclientlink_update', array('id' => $entity->getProjectVendorClientLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProjectVendorClientLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectVendorClientLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectVendorClientLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('projectvendorclientlink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ProjectVendorClientLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
