<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('blog/index.html.twig', [
            'entries' => $posts,
        ]);
    }

    #[Route('/blog/{slug:post}', name: 'blog_show')]
    public function show(Post $post): Response
    {
        return $this->render('blog/show.html.twig', [
            'entry' => $post,
        ]);
    }
}
