<?php

namespace App\Controller;
use App\Entity\Blogs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
class BlogController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/', name: 'app_blog')]
    public function index(): Response
    {
        $posts = $this->em->getRepository(Blogs::class)->FindAll();
        
        $images = array();
        foreach ($posts as $key => $entity) {
            $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
        }
        
        
        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
            'images' => $images,
        ]);
    }
}
