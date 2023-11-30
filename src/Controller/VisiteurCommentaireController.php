<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\Commentaire1Type;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/visiteur/article/{id}/commentaire')]
class VisiteurCommentaireController extends AbstractController
{

    #[Route('/new', name: 'app_visiteur_commentaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request,Article $article ,EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setCreatedAt(new \DateTimeImmutable());
        $commentaire->setArticle($article);
        $form = $this->createForm(Commentaire1Type::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_visiteur_article_show', [
                'id' => $article->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('visiteur_commentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

}
