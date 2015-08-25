<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ProjectCrew;
use BMG\BookToolBundle\Form\ProjectCrewType;

/**
 * ProjectCrew controller.
 *
 */
class ProjectCrewController extends Controller
{

    /**
     * Lists all ProjectCrew entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ProjectCrew')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ProjectCrew:index',
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
     * Creates a new ProjectCrew entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProjectCrew();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('projectcrew_show', array('id' => $entity->getProjectCrewId())));
        }

        return $this->render('BMGBookToolBundle:ProjectCrew:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProjectCrew entity.
     *
     * @param ProjectCrew $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProjectCrew $entity)
    {
        $form = $this->createForm(new ProjectCrewType(), $entity, array(
            'action' => $this->generateUrl('projectcrew_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProjectCrew entity.
     *
     */
    public function newAction()
    {
        $entity = new ProjectCrew();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ProjectCrew:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectCrew entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectCrew')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectCrew entity.');
        }


        return $this->render('BMGBookToolBundle:ProjectCrew:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ProjectCrew entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectCrew')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectCrew entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ProjectCrew:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProjectCrew entity.
    *
    * @param ProjectCrew $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProjectCrew $entity)
    {
        $form = $this->createForm(new ProjectCrewType(), $entity, array(
            'action' => $this->generateUrl('projectcrew_update', array('id' => $entity->getProjectCrewId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProjectCrew entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectCrew')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectCrew entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('projectcrew_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ProjectCrew:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
 
        ));
    }
    
}
