<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

//ici nous avons une class BlogController qui herite d'une autre class //
class BlogController extends AbstractController
{
    //ici quand le navigateur va appeller mon site.com/blog voici la fonction que tu dois appeler//
    #[Route('/blog', name: 'blog')]

    //il doit repondre par l'index et on demande à symfony de nous injecter les dependances que j'ai besoin dans ma fonction//
    public function index(ArticleRepository $repo): Response
    {

        $articles = $repo->findAll();
        //ici il doit traiter la demande et de renvoiyer la view du fichier blog//
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' =>$articles
        ]);
    }
    //ici on va indiquer la route que le nagivateur doit prendre
    #[Route('/', name: 'home')]

    //la fonction home est la fonction que nous allons appeller quand on va taper mon site.com/
    public function home()
    {

        //ici dans mon fichier blog,je vais appeller le fichier home afficher la vue twig//
        return $this->render('blog/home.html.twig');
    }
    //ici je vais créer une route qui pointera sur un article
    #[Route('/blog/{id}', name: 'blog_show')]

    public function show(ArticleRepository $repo, $id) {

        $article = $repo->find($id);

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }

}
