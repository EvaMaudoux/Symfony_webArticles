<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /*
    #[Route('/posts', name: 'posts')]
    public function post(): Response
    {
        return $this->render('post/posts.html.twig', [
        ]);
    }


    Ca ne marche plus getDoctrine ->

    #[Route('/', name: 'posts')]
    public function posts()
    {
        $posts = $this->getDoctrine() // méthode permettant de communiquer avec Doctrine
                      ->getRepository(Post::class) // méthode permettant d'utiliser ou de créer des méthodes de type query. Il faut indiquer le nom de l'entité gérée par le Repository
                      ->findAll(); // méthode du Reposi tory permettant de récupérer tous les articles
            return $this->render('post/index.html.twig', [
                'posts' => $posts
                ]);
    }

    */

class PostController extends AbstractController
{
    #[Route('/', name: 'posts')]
    public function posts(PostRepository $repository): Response
    {
        $posts = $repository->findBy(
            ['isPublished'=>true], // premier array pour les criteres
            ['title'=> 'ASC'], // deuxieme tab
            10
        );
        return $this->render('post/posts.html.twig', [
            'posts' => $posts,
        ]);
    }
}