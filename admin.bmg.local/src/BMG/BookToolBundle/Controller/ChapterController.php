<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\Chapter;
use BMG\BookToolBundle\Form\ChapterType;

/**
 * Chapter controller.
 *
 */
class ChapterController extends Controller
{

    /**
     * Lists all Chapter entities.
     *
     */
    public function indexAction()
    {   $session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:Chapter')->findAll();
        $data = array (
        		'site_name'   => $this->container->getParameter('site_name'),
        		'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
        		'page_slogan' => 'Welcome !',
        		'view'        => 'Chapter:index',
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
     * Creates a new Chapter entity.
     *
     */
    public function createAction(Request $request)
    {	
        $entity = new Chapter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chapter_show', array('id' => $entity->getChapterId())));
        }

        return $this->render('BMGBookToolBundle:Chapter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Chapter entity.
     *
     * @param Chapter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Chapter $entity)
    {
        $form = $this->createForm(new ChapterType(), $entity, array(
            'action' => $this->generateUrl('chapter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Chapter entity.
     *
     */
    public function newAction()
    {
        $entity = new Chapter();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:Chapter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Chapter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Chapter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chapter entity.');
        }

        return $this->render('BMGBookToolBundle:Chapter:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Chapter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Chapter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chapter entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:Chapter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Chapter entity.
    *
    * @param Chapter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Chapter $entity)
    {
        $form = $this->createForm(new ChapterType(), $entity, array(
            'action' => $this->generateUrl('chapter_update', array('id' => $entity->getChapterId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Chapter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Chapter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chapter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('chapter_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:Chapter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
