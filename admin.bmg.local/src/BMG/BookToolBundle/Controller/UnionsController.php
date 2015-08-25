<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\Unions;
use BMG\BookToolBundle\Form\UnionsType;

/**
 * Unions controller.
 *
 */
class UnionsController extends Controller
{

    /**
     * Lists all Unions entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:Unions')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'Unions:index',
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
     * Creates a new Unions entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Unions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('unions_show', array('id' => $entity->getUnionId())));
        }

        return $this->render('BMGBookToolBundle:Unions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Unions entity.
     *
     * @param Unions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Unions $entity)
    {
        $form = $this->createForm(new UnionsType(), $entity, array(
            'action' => $this->generateUrl('unions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Unions entity.
     *
     */
    public function newAction()
    {
        $entity = new Unions();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:Unions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Unions entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Unions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unions entity.');
        }


        return $this->render('BMGBookToolBundle:Unions:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Unions entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Unions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unions entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:Unions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Unions entity.
    *
    * @param Unions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Unions $entity)
    {
        $form = $this->createForm(new UnionsType(), $entity, array(
            'action' => $this->generateUrl('unions_update', array('id' => $entity->getUnionId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Unions entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:Unions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unions entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('unions_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:Unions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
