<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeintureController extends AbstractController
{
    /**
     * @Route("/realisation", name="réalisations")
     */
    public function index(
        PeintureRepository $peintureRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $peintureRepository->findAll();

        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('peinture/realisations.html.twig', [
            'peintures' => $peintures,
        ]);
    }
    /**
     * @Route("realisations/{slug}", name="realisation_detail")
     */
    
    public function details(Peinture $peinture): Response
    {
        return $this->render('peinture/detail.html.twig', [
            'peinture' => $peinture,
        ]);
    }
}
