<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\City;
use BMG\BookToolBundle\Form\CityType;

/**
 * City controller.
 *
 */
class CityController extends Controller
{

    /**
     * Lists all City entities.
     *
     */
    public function indexAction()
    {   $session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();
		$entities = $em->getRepository('BMGBookToolBundle:City')->findAll();
        $data = array (
        		'site_name'   => $this->container->getParameter('site_name'),
        		'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
        		'page_slogan' => 'Welcome !',
        		'view'        => 'City:index',
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
     * Creates a new City entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new City();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('city_show', array('id' => $entity->getCityId())));
        }

        return $this->render('BMGBookToolBundle:City:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a City entity.
     *
     * @param City $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(City $entity)
    {
        $form = $this->createForm(new CityType(), $entity, array(
            'action' => $this->generateUrl('city_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new City entity.
     *
     */
    public function newAction()
    {
        $entity = new City();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:City:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a City entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:City')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }
        return $this->render('BMGBookToolBundle:City:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing City entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:City')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:City:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
         
        ));
    }

    /**
    * Creates a form to edit a City entity.
    *
    * @param City $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(City $entity)
    {
        $form = $this->createForm(new CityType(), $entity, array(
            'action' => $this->generateUrl('city_update', array('id' => $entity->getCityId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing City entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:City')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('city_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:City:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
