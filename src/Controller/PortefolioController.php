<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Repository\PeintureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortefolioController extends AbstractController
{
    /**
     * @Route("/portefolio", name="portefolio")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('portefolio/portefolio.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }
        /**
     * @Route("/portefolio/{slug}", name="portefolio_categorie")
     */
    public function categorie(Categorie $categorie, PeintureRepository $peintureRepository): Response
    {
        $peintures = $peintureRepository->findAllPortefolio($categorie);
        
        return $this->render('portefolio/categorie.html.twig', [
            'categorie' => $categorie,
            'peintures'=> $peintures,
        ]);
    } 
}
