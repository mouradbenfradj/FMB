<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Stockage;
use App\Form\StockageType;

/**
 * Stockage controller.
 *
 */
class StockageController  extends AbstractController
{

    /**
     * Lists all Stockage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('App/Stockage')->findAll();

        return $this->render(
            'App/Stockage:index.html.twig',
            array(
                'entities' => $entities,
            )
        );
    }

    /**
     * Creates a new Stockage entity.
     *
     */
    public function create()
    {
        $entity = new Stockage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stockage_show', array('id' => $entity->getId())));
        }

        return $this->render(
            'App/Stockage:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Stockage entity.
     *
     * @param Stockage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stockage $entity)
    {
        $form = $this->createForm(
            new StockageType(),
            $entity,
            array(
                'action' => $this->generateUrl('stockage_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Stockage entity.
     *
     */
    public function newAction()
    {
        $entity = new Stockage();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'App/Stockage:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Stockage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App/Stockage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stockage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'App/Stockage:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to delete a Stockage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stockage_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    /**
     * Displays a form to edit an existing Stockage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App/Stockage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stockage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'App/Stockage:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Stockage entity.
     *
     * @param Stockage $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Stockage $entity)
    {
        $form = $this->createForm(
            new StockageType(),
            $entity,
            array(
                'action' => $this->generateUrl('stockage_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Stockage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App/Stockage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stockage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stockage_edit', array('id' => $id)));
        }

        return $this->render(
            'App/Stockage:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Stockage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App/Stockage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stockage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stockage'));
    }
}
