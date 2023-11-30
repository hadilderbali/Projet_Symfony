<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Article1Type;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/visiteur/article')]
class VisiteurArticleController extends AbstractController
{


    #[Route('/{id}', name: 'app_visiteur_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
         $commentaire = $article->getComments();
        return $this->render('visiteur_article/show.html.twig', [
            'article' => $article,
            'commentaire' => $commentaire
        ]);
    }

}
