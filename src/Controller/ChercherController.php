<?php

namespace App\Controller;

use App\SearchHandler\SearchHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChercherController extends AbstractController
{
    #[Route('/chercher', name: 'app_chercher')]
    public function index(Request $request, SearchHandlerInterface $searchHandler): Response
    {
        $search = $request->query->get('search');
        $publishedAfter = $request->query->get('publishedAfter');

        $articles = $searchHandler->handleSearch($search, $publishedAfter);

        return $this->render('chercher/index.html.twig', [
            'controller_name' => 'ChercherController',
            'articles' => $articles,
        ]);
    }
}
