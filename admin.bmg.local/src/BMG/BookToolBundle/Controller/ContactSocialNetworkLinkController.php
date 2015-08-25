<?php

namespace BMG\BookToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use BMG\BookToolBundle\Controller\CommonController;

use BMG\BookToolBundle\Entity\ContactSocialNetworkLink;
use BMG\BookToolBundle\Form\ContactSocialNetworkLinkType;

/**
 * ContactSocialNetworkLink controller.
 *
 */
class ContactSocialNetworkLinkController extends Controller
{

    /**
     * Lists all ContactSocialNetworkLink entities.
     *
     */
    public function indexAction()
    {	
    	$session = $this->getRequest()->getSession();
    	
    	$common = $this->get('Common');
    	$common->checkSessionAction();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BMGBookToolBundle:ContactSocialNetworkLink')->findAll();

        $data = array (
            'site_name'   => $this->container->getParameter('site_name'),
            'page_title'  => 'Hello <b>' . $session->get('user')->getUserFirstName() . '</b>',
            'page_slogan' => 'Welcome !',
            'view'        => 'ContactSocialNetworkLink:index',
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
     * Creates a new ContactSocialNetworkLink entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ContactSocialNetworkLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contactsocialnetworklink_show', array('id' => $entity->getContactSocialNetworkLinkId())));
        }

        return $this->render('BMGBookToolBundle:ContactSocialNetworkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ContactSocialNetworkLink entity.
     *
     * @param ContactSocialNetworkLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ContactSocialNetworkLink $entity)
    {
        $form = $this->createForm(new ContactSocialNetworkLinkType(), $entity, array(
            'action' => $this->generateUrl('contactsocialnetworklink_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ContactSocialNetworkLink entity.
     *
     */
    public function newAction()
    {
        $entity = new ContactSocialNetworkLink();
        $form   = $this->createCreateForm($entity);

        return $this->render('BMGBookToolBundle:ContactSocialNetworkLink:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ContactSocialNetworkLink entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ContactSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactSocialNetworkLink entity.');
        }


        return $this->render('BMGBookToolBundle:ContactSocialNetworkLink:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing ContactSocialNetworkLink entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ContactSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactSocialNetworkLink entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BMGBookToolBundle:ContactSocialNetworkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ContactSocialNetworkLink entity.
    *
    * @param ContactSocialNetworkLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ContactSocialNetworkLink $entity)
    {
        $form = $this->createForm(new ContactSocialNetworkLinkType(), $entity, array(
            'action' => $this->generateUrl('contactsocialnetworklink_update', array('id' => $entity->getContactSocialNetworkLinkId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ContactSocialNetworkLink entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BMGBookToolBundle:ContactSocialNetworkLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactSocialNetworkLink entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contactsocialnetworklink_edit', array('id' => $id)));
        }

        return $this->render('BMGBookToolBundle:ContactSocialNetworkLink:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
    
}
