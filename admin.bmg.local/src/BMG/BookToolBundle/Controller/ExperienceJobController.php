<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ExperienceJob;
use BMG\BookToolBundle\Form\ExperienceJobType;

/**
 * ExperienceJob controller.
 *
 */
class ExperienceJobController extends Controller
{

    /**
     * Lists all ExperienceJob entities.
     *
     */
    public function indexAction()
    {
    	$session = $this->getRequest()->getSession();
    	 
    	$common = $this->get('Common');
    	$common->checkSessionAction();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ExperienceJob')->findAll();

$data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ExperienceJob:index',
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
     * Creates a new ExperienceJob entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ExperienceJob();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('experiencejob_show', array('id' => $entity->getExperienceJobId())));
        }

        return $this->render('BMGBookToolBundle:ExperienceJob:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ExperienceJob entity.
     *
     * @param ExperienceJob $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ExperienceJob $entity)
    {
        $form = $this->createForm(new ExperienceJobType(), $entity, array(
            'action' => $this->generateUrl('experiencejob_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ExperienceJob entity.
     *
     */
    public function newAction()
    {
        $entity = new ExperienceJob();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ExperienceJob:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ExperienceJob entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ExperienceJob')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ExperienceJob entity.');
        }


        return $this->render('BMGBookToolBundle:ExperienceJob:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ExperienceJob entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ExperienceJob')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ExperienceJob entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ExperienceJob:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ExperienceJob entity.
    *
    * @param ExperienceJob $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ExperienceJob $entity)
    {
        $form = $this->createForm(new ExperienceJobType(), $entity, array(
            'action' => $this->generateUrl('experiencejob_update', array('id' => $entity->getExperienceJobId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ExperienceJob entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ExperienceJob')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ExperienceJob entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('experiencejob_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ExperienceJob:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }
   
}
