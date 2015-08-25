<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ProjectRole;
use BMG\BookToolBundle\Form\ProjectRoleType;

/**
 * ProjectRole controller.
 *
 */
class ProjectRoleController extends Controller
{

    /**
     * Lists all ProjectRole entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ProjectRole')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ProjectRole:index',
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
     * Creates a new ProjectRole entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProjectRole();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('projectrole_show', array('id' => $entity->getProjectRoleId())));
        }

        return $this->render('BMGBookToolBundle:ProjectRole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProjectRole entity.
     *
     * @param ProjectRole $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProjectRole $entity)
    {
        $form = $this->createForm(new ProjectRoleType(), $entity, array(
            'action' => $this->generateUrl('projectrole_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProjectRole entity.
     *
     */
    public function newAction()
    {
        $entity = new ProjectRole();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ProjectRole:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectRole entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectRole entity.');
        }


        return $this->render('BMGBookToolBundle:ProjectRole:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ProjectRole entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectRole entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ProjectRole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProjectRole entity.
    *
    * @param ProjectRole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProjectRole $entity)
    {
        $form = $this->createForm(new ProjectRoleType(), $entity, array(
            'action' => $this->generateUrl('projectrole_update', array('id' => $entity->getProjectRoleId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProjectRole entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectRole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectRole entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('projectrole_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ProjectRole:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
