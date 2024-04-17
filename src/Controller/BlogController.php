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
        //$posts = $this->em->getRepository(Blogs::class)->FindAll();
        try{
            $posts = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'ASC'),
                5,
                0
            );
            
            $lists = $posts;
            $images = array();
            foreach ($posts as $key => $entity) {
                $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            }
            
            return $this->render('blog/index.html.twig', [
                'lists' => $lists,
                'posts' => $posts,
                'images' => $images,
            ]);
        }catch(\Exception $e){
            
            return $this->render('blog/404.html.twig', [
            ]);
        
        }
    }


    #[Route('/{page}', name: 'blogPick')]
    public function pickPage($page): Response
    {
        try{
            $lists = $this->em->getRepository(Blogs::class)->FindAll(
                array(),
                array('id' => 'ASC'),
                5,
                0
            );

            $TopLimit = $page * 5;
            $BottomLimit = ($page * 5)-4;

            $posts = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'ASC'),
                $TopLimit,
                $BottomLimit
            );
            
            $images = array();
            foreach ($posts as $key => $entity) {
                $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            }
            
            
            return $this->render('blog/index.html.twig', [
                'lists' => $lists,
                'posts' => $posts,
                'images' => $images,
            ]);
        }catch(\Exception $e){
            
            return $this->render('blog/404.html.twig', [
            ]);
        
        }    
    }
}
