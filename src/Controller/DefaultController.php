<?php

namespace App\Controller;

use App\Service\ConteneurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/{id<\d+>}", name="app_default", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function index(int $id = 0, ConteneurService $conteneurService): Response
    {
        return $this->render('default/index.html.twig', [
            'id' => $id,
            'conteneurs' => $conteneurService->getContainerList()
        ]);
    }

    /**
     * @Route("/alerte-de-travaille/{id<\d+>}", name="app_alerte_de_travaille", methods={"GET","HEAD"}, requirements={"id"="\d+"})
     */
    public function AlerteDeTravaille(int $id): Response
    {
        return $this->render('default/alerte-de-travaille.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/teste", name="teste")
     */
    public function testem(ConteneurService $conteneurService): Response
    {
        dd($conteneurService->getContainerList());
        /* 
        $context = new Context(new ConcreteStrategyA());
        dump("Client: Strategy is set to normal sorting.\n");
        $context->doSomeBusinessLogic();


        dump("Client: Strategy is set to reverse sorting.\n");
        $context->setStrategy(new ConcreteStrategyB());
        $context->doSomeBusinessLogic(); */
        die();

        /* dump($this->clientCode(new ConcreteFactory1()));
        dd($this->clientCode(new ConcreteFactory2())); */
    }/* 
    function clientCode(AbstractFactory $factory)
    {
        $productA = $factory->createProductA();
        $productB = $factory->createProductB();

        $productB->usefulFunctionB() . "\n";
        return  $productB->usefulFunctionB() . "\n" . $productB->anotherUsefulFunctionB($productA) . "\n";
    } */
}
