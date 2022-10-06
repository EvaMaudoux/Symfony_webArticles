<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @param PostRepository $repository
     * @return Response
     */
    #[Route('/', name: 'posts')]
    public function posts(PostRepository $repository): Response
    {
        $posts = $repository->findBy( // méthode magique
            ['isPublished'=>true], // premier array pour les criteres
            ['title'=> 'ASC'] // deuxieme tab pour le order by
            //10 : limit. Ce n'est plus un array donc aps de parenthèse
        );
        return $this->render('post/posts.html.twig', [
            'posts' => $posts,
        ]);
    }


    /**
     * @param Post $post
     * @return Response
     */
    #[Route('post/{id}', name: 'post')]
    public function post(Post $post) : Response
    {
        return $this->render('post/post.html.twig', [
            'post' => $post,
            ]);
    }
}
















