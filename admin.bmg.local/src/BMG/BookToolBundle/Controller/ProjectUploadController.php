<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ProjectUpload;
use BMG\BookToolBundle\Form\ProjectUploadType;

/**
 * ProjectUpload controller.
 *
 */
class ProjectUploadController extends Controller
{

    /**
     * Lists all ProjectUpload entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ProjectUpload')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ProjectUpload:index',
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
     * Creates a new ProjectUpload entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProjectUpload();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('projectupload_show', array('id' => $entity->getProjectUploadId())));
        }

        return $this->render('BMGBookToolBundle:ProjectUpload:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProjectUpload entity.
     *
     * @param ProjectUpload $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProjectUpload $entity)
    {
        $form = $this->createForm(new ProjectUploadType(), $entity, array(
            'action' => $this->generateUrl('projectupload_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProjectUpload entity.
     *
     */
    public function newAction()
    {
        $entity = new ProjectUpload();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ProjectUpload:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectUpload entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectUpload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectUpload entity.');
        }

      

        return $this->render('BMGBookToolBundle:ProjectUpload:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ProjectUpload entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectUpload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectUpload entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ProjectUpload:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProjectUpload entity.
    *
    * @param ProjectUpload $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProjectUpload $entity)
    {
        $form = $this->createForm(new ProjectUploadType(), $entity, array(
            'action' => $this->generateUrl('projectupload_update', array('id' => $entity->getProjectUploadId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProjectUpload entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ProjectUpload')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProjectUpload entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('projectupload_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ProjectUpload:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
  
}
