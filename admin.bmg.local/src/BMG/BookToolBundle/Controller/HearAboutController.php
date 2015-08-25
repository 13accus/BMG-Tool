<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\HearAbout;
use BMG\BookToolBundle\Form\HearAboutType;

/**
 * HearAbout controller.
 *
 */
class HearAboutController extends Controller
{

    /**
     * Lists all HearAbout entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
    	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:HearAbout')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'HearAbout:index',
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
     * Creates a new HearAbout entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new HearAbout();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('hearabout_show', array('id' => $entity->getHearAboutId())));
        }

        return $this->render('BMGBookToolBundle:HearAbout:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a HearAbout entity.
     *
     * @param HearAbout $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(HearAbout $entity)
    {
        $form = $this->createForm(new HearAboutType(), $entity, array(
            'action' => $this->generateUrl('hearabout_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new HearAbout entity.
     *
     */
    public function newAction()
    {
        $entity = new HearAbout();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:HearAbout:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HearAbout entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:HearAbout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HearAbout entity.');
        }


        return $this->render('BMGBookToolBundle:HearAbout:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing HearAbout entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:HearAbout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HearAbout entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:HearAbout:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a HearAbout entity.
    *
    * @param HearAbout $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HearAbout $entity)
    {
        $form = $this->createForm(new HearAboutType(), $entity, array(
            'action' => $this->generateUrl('hearabout_update', array('id' => $entity->getHearAboutId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing HearAbout entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:HearAbout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HearAbout entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('hearabout_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:HearAbout:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
   
}
