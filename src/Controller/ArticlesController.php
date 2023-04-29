<?php

namespace App\Controller;

use App\Repository\ProcessusRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Articles;
use App\Entity\StocksPochesBS;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use App\Repository\StocksArticlesRepository;
use App\Repository\StocksArticlesSnRepository;
use App\Repository\StocksPochesBSRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Articles controller.
 *
 */
class ArticlesController  extends AbstractController
{
    public function articleCycle(
        Request $request,
        ArticlesRepository $articlesRepository,
         ProcessusRepository $processusRepository
         )
    {// Get the province ID
        $sarticle = $request->query->get('sarticle');
        $result = array();
        $repo = $processusRepository->findByArticleDebut($articlesRepository->findOneByLibArticle($sarticle));
        foreach ($repo as $stock) {
            $result[$stock->getId()] = $stock->getNomProcessus();
        }
        return new JsonResponse($result);
    }

    public function articleStocks(
        Request $request,
        StocksArticlesRepository $stocksArticlesRepository,
        StocksArticlesSnRepository $stocksArticlesSnRepository
    )
    {// Get the province ID
        $id = $request->query->get('stock_id');
        $article = $request->query->get('article');
        $result = array();
        if ($article != '')
            $stocks = $stocksArticlesRepository->findBy(array('idStock' => $id, 'refArticle' => $article));
        foreach ($stocks as $stock) {
            $sn = $stocksArticlesSnRepository->findByRefStockArticle($stock);
            foreach ($sn as $lot) {
                $result[$lot->getNumeroSerie()] = $lot->getSnQte();
            }
        }
        return new JsonResponse($result);
    }

    public function pocheArticle(
        Request $request,
    StocksPochesBSRepository $stocksPochesBSRepository,
    StocksArticlesSnRepository $stocksArticlesSnRepository)
    {
        $request->get('id');
        $pochearticle = $stocksPochesBSRepository->getPochePreparer(
            $stocksArticlesSnRepository->findOneBy(array('refStockArticle' => $request->get('ida'), 'numeroSerie' => $request->get('lot'))), $request->get('idl')
        );
        count($pochearticle);
        $tabEnsembles = array();
        $tabtest = array();
        $i = 0;
        foreach ($pochearticle as $e) { // transformer la réponse de la requete en tableau qui remplira le select pour ensembles
            if (!in_array($e->getQuantiter(), $tabtest)) {
                $tabEnsembles[$i]['id'] = $e->getId();
                $tabEnsembles[$i]['nombre'] = count($pochearticle);
                $tabEnsembles[$i]['qte'] = $e->getQuantiter();
                $tabtest[] = $e->getQuantiter();
            }
            $i++;
        }
        $response = new Response();
        $data = json_encode($tabEnsembles); // formater le résultat de la requête en json
        $response->headers->set('Content-Type', 'miseaeaupoche/json');
        $response->setContent($data);

        return $response;
    }


    public function articleStockslot(Request $request,
    StocksArticlesRepository $stocksArticlesRepository,
    StocksArticlesSnRepository $stocksArticlesSnRepository)
    {// Get the province ID
        $id = $request->query->get('stock_id');
        $article = $request->query->get('article');
        $lot = $request->query->get('lot');
        $result = array();
        $stocks = $stocksArticlesRepository->findBy(array('idStock' => $id, 'refArticle' => $article));

        foreach ($stocks as $stock) {
            $sn = $stocksArticlesSnRepository->findBy(array('refStockArticle' => $stock, 'numeroSerie' => $lot));
            foreach ($sn as $lot) {
                $result[$lot->getNumeroSerie() . $lot->getSnQte()] = $lot->getSnQte();
            }
        }
        return new JsonResponse($result);
    }

    public function nombrePocheArticle(
        Request $request,
        StocksPochesBSRepository $stocksPochesBSRepository,
    StocksArticlesSnRepository $stocksArticlesSnRepository
    )
    {
        $pochearticle = $stocksPochesBSRepository->getPochePreparer(
            $stocksArticlesSnRepository->findOneBy(array('refStockArticle' => $request->get('ida'), 'numeroSerie' => $request->get('lot')))
            , $request->get('idl')
        );
        count($pochearticle);
        $tabEnsembles = array();
        $tabtest = array();
        $i = 0;
        $tt = 1;
        foreach ($pochearticle as $e) { // transformer la réponse de la requete en tableau qui remplira le select pour ensembles
            if ($e->getQuantiter() == $request->get('qtech')) {
                $tabEnsembles[$i]['id'] = $e->getId();
                $tabEnsembles[$i]['nombre'] = $tt;
                $tabEnsembles[$i]['qte'] = $e->getQuantiter();
                $tabtest[] = $e->getQuantiter();
                $tt++;
            }
            $i++;
        }
        $response = new Response();
        $data = json_encode($tabEnsembles); // formater le résultat de la requête en json
        $response->headers->set('Content-Type', 'miseaeaupoche/json');
        $response->setContent($data);

        return $response;
    }

    /**
     * Lists all Articles entities.
     *
     */
    public function index(ArticlesRepository $articlesRepository)
    {
        $articles = $articlesRepository->findAll();

        return $this->render(
            'articles:index.html.twig',
            array(
                'articles' => $articles,
            )
        );
    }

    /**
     * Creates a new Articles entity.
     *
     */
    public function create()
    {
        $entity = new Articles();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('articles_show', array('id' => $entity->getRefArticle())));
        }

        return $this->render(
            'articles:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a Articles entity.
     *
     * @param Articles $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Articles $entity)
    {
        $form = $this->createForm(
            new ArticlesType(),
            $entity,
            array(
                'action' => $this->generateUrl('articles_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Articles entity.
     *
     */
    public function new()
    {
        $entity = new Articles();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'articles:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a Articles entity.
     *
     */
    public function show(int $id,ArticlesRepository $articlesRepository)
    {
        $entity = $articlesRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'articles:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to delete a Articles entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('articles_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    /**
     * Displays a form to edit an existing Articles entity.
     *
     */
    public function edit(int $id, ArticlesRepository $articlesRepository)
    {
        $entity = $articlesRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'articles:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a Articles entity.
     *
     * @param Articles $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Articles $entity)
    {
        $form = $this->createForm(
            new ArticlesType(),
            $entity,
            array(
                'action' => $this->generateUrl('articles_update', array('id' => $entity->getRefArticle())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Articles entity.
     *
     */
    public function update(Request $request,
    int $id,
    ArticlesRepository $articlesRepository
    )
    {

        $entity = $articlesRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Articles entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('articles_edit', array('id' => $id)));
        }

        return $this->render(
            'articles:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a Articles entity.
     *
     */
    public function delete(Request $request,int $id,ArticlesRepository $articlesRepository)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $articlesRepository->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Articles entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('articles'));
    }
}
