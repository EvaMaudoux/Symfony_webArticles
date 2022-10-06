<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Form\CategoryType;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function posts(PostRepository $repository): Response
    {
        $posts = $repository->findBy(
            [],
            ['createdAt' => 'DESC']
        );
        dump($posts);
        return $this->render('admin/admin.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('admin/delete/{id}', name: 'delete')]
    public function delete(Post $post, EntityManagerInterface $manager)
    {
        $manager->remove($post);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('admin/new', name:'new')]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $post = new Post;
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post->setCreatedAt(new \DateTimeImmutable())
                 ->setImage('default.png');
            $manager->persist($post);
            $manager->flush();
            return $this->redirectToRoute('admin'); //je dois repasser par un controller donc c'est redirectToRoute
        }

        return $this->renderForm('admin/new.html.twig', [
            'form' => $form
        ]);
    }


    #[Route('admin/newCategory', name:'newCategory')]
    public function newCategory(Request $request, EntityManagerInterface $manager) : Response
    {
        $cat = new Category;
        $form = $this->createForm(CategoryType::class, $cat);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($cat);
            $manager->flush();
            return $this->redirectToRoute('admin'); //je dois repasser par un controller donc c'est redirectToRoute
        }

        return $this->renderForm('admin/newCategory.html.twig', [
            'form' => $form
        ]);
    }

}
