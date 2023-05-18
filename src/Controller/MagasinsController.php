<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Magasins;
use App\Form\MagasinsType;
use App\Repository\CordeRepository;
use App\Repository\LanterneRepository;
use App\Repository\MagasinsRepository;
use App\Repository\PochesBSRepository;

/**
 * Magasins controller.
 *
 */
class MagasinsController  extends AbstractController
{
    public function parcStocks(MagasinsRepository $magasinsRepository, Request $request)
    {
        $result = array();
        $parc = $magasinsRepository->find($request->query->get('parc_id'));
        $stocks = $parc->getIdStock();
        $result[$stocks->getLibStock()] = $stocks->getIdStock();
        return new JsonResponse($result);
    }

    public function parcLanternes(LanterneRepository $lanterneRepository, Request $request)
    {// Get the province ID
        $id = $request->query->get('parc_id');
        $result = array();
        // Return a list of cities, based on the selected province
        $lanternes = $lanterneRepository->findByParc($id, array('parc' => 'asc'));
        foreach ($lanternes as $lanterne) {
            $result[$lanterne->getNomLanterne()]['nomLanterne'] = $lanterne->getNomLanterne();
            $result[$lanterne->getNomLanterne()]['nombreEnStocks'] = $lanterne->getNbrTotaleEnStock();
        }
        return new JsonResponse($result);
    }

    public function parcCordes(CordeRepository $cordeRepository, Request $request)
    {// Get the province ID
        $id = $request->query->get('parc_id');
        $result = array();
        // Return a list of cities, based on the selected province
        $cordes = $cordeRepository->findByParc($id, array('parc' => 'asc'));
        foreach ($cordes as $corde) {
            $result[$corde->getNomCorde()]['nomCorde'] = $corde->getNomCorde();
            $result[$corde->getNomCorde()]['nombreEnStocks'] = $corde->getNbrTotaleEnStock();
        }
        return new JsonResponse($result);
    }


    public function parcCorde(CordeRepository $cordeRepository, Request $request)
    {// Get the province ID
        $id = $request->query->get('parc_id');
        $result = array();
        $cordes = $cordeRepository->findByParc($id, array('parc' => 'asc'));
        foreach ($cordes as $corde) {
            $result[$corde->getId()]['nomCorde'] = $corde->getNomCorde();
            $result[$corde->getId()]['nombre'] = $corde->getNbrTotaleEnStock();
        }
        return new JsonResponse($result);
    }

    public function quantiterCordeEnStock(CordeRepository $cordeRepository)
    {// Get the province ID
        $id = $request->query->get('cordeId');
        $result = array();
        // Return a list of cities, based on the selected province
        $corde = $cordeRepository->find($id);
        $result[$corde->getId() . $corde->getNomCorde()] = $corde->getNbrTotaleEnStock();

        return new JsonResponse($result);
    }

    public function parcPoches(PochesBSRepository $pochesBSRepository, Request $request)
    {// Get the province ID
        $id = $request->query->get('parc_id');
        $result = array();
        // Return a list of cities, based on the selected province
        $poches = $$pochesBSRepository->findByParc($id, array('parc' => 'asc'));
        foreach ($poches as $poche) {
            $result[$poche->getId()] = $poche->getNomPoche();
            $result[$poche->getId() . $poche->getNbrTotaleEnStock()] = $poche->getNbrTotaleEnStock();
        }
        return new JsonResponse($result);
    }

    public function parcPoche(PochesBSRepository $pochesBSRepository, Request $request)
    {// Get the province ID
        $id = $request->query->get('parc_id');
        $result = array();
        // Return a list of cities, based on the selected province
        $poches = $$pochesBSRepository->findByParc($id, array('parc' => 'asc'));
        foreach ($poches as $poche) {
            $result[$poche->getId()]['poche'] = $poche->getNomPoche();
            $result[$poche->getId()]['quantiter'] = $poche->getNbrTotaleEnStock();
        }
        return new JsonResponse($result);
    }

    /**
     * Lists all Magasins entities.
     *
     */
    public function indexAction(MagasinsRepository $magasinsRepository)
    {
        $entities = $magasinsRepository->findAll();

        return $this->render('magasins/index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Magasins entity.
     *
     */
    public function create()
    {
        $entity = new Magasins();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('magasins_show', array('id' => $entity->getId())));
        }

        return $this->render('magasins/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Magasins entity.
     *
     * @param Magasins $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Magasins $entity)
    {
        $form = $this->createForm(new MagasinsType(), $entity, array(
            'action' => $this->generateUrl('magasins_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Magasins entity.
     *
     */
    public function newAction()
    {
        $entity = new Magasins();
        $form = $this->createCreateForm($entity);

        return $this->render('magasins/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Magasins entity.
     *
     */
    public function showAction(MagasinsRepository $magasinsRepository,$id)
    {
        $entity = $magasinsRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Magasins entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('magasins/show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Magasins entity.
     *
     */
    public function editAction(MagasinsRepository $magasinsRepository,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $magasinsRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Magasins entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('magasins/edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Magasins entity.
     *
     * @param Magasins $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Magasins $entity)
    {
        $form = $this->createForm(new MagasinsType(), $entity, array(
            'action' => $this->generateUrl('magasins_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Magasins entity.
     *
     */
    public function updateAction(Request $request,MagasinsRepository $magasinsRepository, $id)
    {
        $entity = $magasinsRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Magasins entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            //$em->flush();

            return $this->redirect($this->generateUrl('magasins_edit', array('id' => $id)));
        }

        return $this->render('magasins/edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Magasins entity.
     *
     */
    public function deleteAction(Request $request,MagasinsRepository $magasinsRepository, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $magasinsRepository->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Magasins entity.');
            }

            //$em->remove($entity);
            //$em->flush();
        }

        return $this->redirect($this->generateUrl('magasins'));
    }

    /**
     * Creates a form to delete a Magasins entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('magasins_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
