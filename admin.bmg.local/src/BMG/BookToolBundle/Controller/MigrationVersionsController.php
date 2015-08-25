<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\MigrationVersions;
use BMG\BookToolBundle\Form\MigrationVersionsType;

/**
 * MigrationVersions controller.
 *
 */
class MigrationVersionsController extends Controller
{

    /**
     * Lists all MigrationVersions entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:MigrationVersions')->findAll();

         $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'MigrationVersions:index',
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
     * Creates a new MigrationVersions entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new MigrationVersions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('migrationversions_show', array('id' => $entity->getVersion())));
        }

        return $this->render('BMGBookToolBundle:MigrationVersions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a MigrationVersions entity.
     *
     * @param MigrationVersions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MigrationVersions $entity)
    {
        $form = $this->createForm(new MigrationVersionsType(), $entity, array(
            'action' => $this->generateUrl('migrationversions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MigrationVersions entity.
     *
     */
    public function newAction()
    {
        $entity = new MigrationVersions();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:MigrationVersions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MigrationVersions entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:MigrationVersions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MigrationVersions entity.');
        }


        return $this->render('BMGBookToolBundle:MigrationVersions:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing MigrationVersions entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:MigrationVersions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MigrationVersions entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('BMGBookToolBundle:MigrationVersions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a MigrationVersions entity.
    *
    * @param MigrationVersions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MigrationVersions $entity)
    {
        $form = $this->createForm(new MigrationVersionsType(), $entity, array(
            'action' => $this->generateUrl('migrationversions_update', array('id' => $entity->getVersion())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MigrationVersions entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:MigrationVersions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MigrationVersions entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('migrationversions_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:MigrationVersions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
