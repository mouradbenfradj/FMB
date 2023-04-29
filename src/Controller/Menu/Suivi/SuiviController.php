<?php
namespace App\Controller\Menu\Suivi;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SuiviController extends AbstractController
{
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->get('idparc') == null) {
            $processus = null;
            $parc = null;
        }
        else
        {
            $processus = $em->getRepository('SSFMBBundle:Processus')->findAll();
            $parc = $em->getRepository('SSFMBBundle:Magasins')->findOneByIdMagasin($request->get('idparc'));
        }
        return $this->render('SSFMBBundle:Default:suivit.html.twig', array('entity' => $parc, 'processus'=>$processus));
    }

}