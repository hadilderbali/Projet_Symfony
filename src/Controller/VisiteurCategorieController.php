<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\Categorie1Type;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/visiteur/categorie')]
class VisiteurCategorieController extends AbstractController
{
    #[Route('/', name: 'app_visiteur_categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('visiteur_categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }



#[Route('/{id}', name: 'app_visiteur_categorie_show', methods: ['GET'])]
public function show(Categorie $categorie): Response
{
    $articles = $categorie->getArticles();

    return $this->render('visiteur_categorie/show.html.twig', [
        'categorie' => $categorie, // corrected variable name
        'articles' => $articles,
    ]);
}}
