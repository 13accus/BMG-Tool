<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\Clearance;
use BMG\BookToolBundle\Form\ClearanceType;

/**
 * Clearance controller.
 *
 */
class ClearanceController extends Controller
{

    /**
     * Lists all Clearance entities.
     *
     */
    public function indexAction()
    {	$session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:Clearance')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'Clearance:index',
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
     * Creates a new Clearance entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Clearance();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clearance_show', array('id' => $entity->getClearanceId())));
        }

        return $this->render('BMGBookToolBundle:Clearance:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Clearance entity.
     *
     * @param Clearance $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Clearance $entity)
    {
        $form = $this->createForm(new ClearanceType(), $entity, array(
            'action' => $this->generateUrl('clearance_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Clearance entity.
     *
     */
    public function newAction()
    {
        $entity = new Clearance();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:Clearance:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Clearance entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }


        return $this->render('BMGBookToolBundle:Clearance:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Clearance entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:Clearance:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Clearance entity.
    *
    * @param Clearance $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Clearance $entity)
    {
        $form = $this->createForm(new ClearanceType(), $entity, array(
            'action' => $this->generateUrl('clearance_update', array('id' => $entity->getClearanceId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Clearance entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Clearance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clearance entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clearance_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:Clearance:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
