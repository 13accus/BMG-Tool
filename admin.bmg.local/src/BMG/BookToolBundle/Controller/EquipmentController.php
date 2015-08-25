<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\Equipment;
use BMG\BookToolBundle\Form\EquipmentType;

/**
 * Equipment controller.
 *
 */
class EquipmentController extends Controller
{

    /**
     * Lists all Equipment entities.
     *
     */
    public function indexAction()
    {	
    	$session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:Equipment')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'Equipment:index',
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
     * Creates a new Equipment entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Equipment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipment_show', array('id' => $entity->getEquipmentId())));
        }

        return $this->render('BMGBookToolBundle:Equipment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Equipment entity.
     *
     * @param Equipment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Equipment $entity)
    {
        $form = $this->createForm(new EquipmentType(), $entity, array(
            'action' => $this->generateUrl('equipment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Equipment entity.
     *
     */
    public function newAction()
    {
        $entity = new Equipment();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:Equipment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Equipment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
        }

        return $this->render('BMGBookToolBundle:Equipment:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Equipment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('BMGBookToolBundle:Equipment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Equipment entity.
    *
    * @param Equipment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Equipment $entity)
    {
        $form = $this->createForm(new EquipmentType(), $entity, array(
            'action' => $this->generateUrl('equipment_update', array('id' => $entity->getEquipmentId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Equipment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Equipment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipment entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('equipment_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:Equipment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
