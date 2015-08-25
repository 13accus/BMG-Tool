<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\BookType;
use BMG\BookToolBundle\Form\BookTypeType;

/**
 * BookType controller.
 *
 */
class BookTypeController extends Controller
{

    /**
     * Lists all BookType entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
    	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:BookType')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'BookType:index',
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
     * Creates a new BookType entity.
     *
     */
    public function createAction(Request $request)
    {   
    	
        $entity = new BookType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('booktype_show', array('id' => $entity->getbookTypeId())));
        }

        return $this->render('BMGBookToolBundle:BookType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BookType entity.
     *
     * @param BookType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BookType $entity)
    {   
    	
    	
        $form = $this->createForm(new BookTypeType(), $entity, array(
            'action' => $this->generateUrl('booktype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BookType entity.
     *
     */
    public function newAction()
    {   
        $entity = new BookType();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:BookType:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BookType entity.
     *
     */
    public function showAction($id)
    {   
    	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:BookType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookType entity.');
        }

        return $this->render('BMGBookToolBundle:BookType:show.html.twig', array(
            'entity'      => $entity, 
        ));
    }

    /**
     * Displays a form to edit an existing BookType entity.
     *
     */
    public function editAction($id)
    {   
    	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:BookType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookType entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:BookType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BookType entity.
    *
    * @param BookType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BookType $entity)
    {   
    	
        $form = $this->createForm(new BookTypeType(), $entity, array(
            'action' => $this->generateUrl('booktype_update', array('id' => $entity->getbookTypeId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BookType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {   
    	
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:BookType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BookType entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('booktype_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:BookType:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
