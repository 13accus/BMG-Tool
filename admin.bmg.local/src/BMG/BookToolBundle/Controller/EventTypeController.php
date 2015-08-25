<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\EventType;
use BMG\BookToolBundle\Form\EventTypeType;

/**
 * EventType controller.
 *
 */
class EventTypeController extends Controller
{

    /**
     * Lists all EventType entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:EventType')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'EventType:index',
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
     * Creates a new EventType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new EventType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eventtype_show', array('id' => $entity->getEventTypeId())));
        }

        return $this->render('BMGBookToolBundle:EventType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EventType entity.
     *
     * @param EventType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventType $entity)
    {
        $form = $this->createForm(new EventTypeType(), $entity, array(
            'action' => $this->generateUrl('eventtype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EventType entity.
     *
     */
    public function newAction()
    {
        $entity = new EventType();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:EventType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EventType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:EventType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventType entity.');
        }


        return $this->render('BMGBookToolBundle:EventType:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing EventType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:EventType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventType entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:EventType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EventType entity.
    *
    * @param EventType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EventType $entity)
    {
        $form = $this->createForm(new EventTypeType(), $entity, array(
            'action' => $this->generateUrl('eventtype_update', array('id' => $entity->getEventTypeId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EventType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:EventType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventType entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventtype_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:EventType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
