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
            $lists = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'DESC'),
                10,
                0
            );
                    
            $currentPage = 1;

            $posts = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'ASC'),
                
            );

            $images = array();
            foreach ($lists as $key => $entity) {
                $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            }
            
            return $this->render('blog/index.html.twig', [
                'lists' => $lists,
                'posts' => $posts,
                'images' => $images,
                'currentPage' => $currentPage,
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
            $lists = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'ASC'),
                10,
                0
            );

            $TopLimit = $page * 5;
            $BottomLimit = ($page * 5)-4;

            $previousPage = $page - 1;
            $nextPage = $page + 1;

            $posts = $this->em->getRepository(Blogs::class)->findBy(
                array(),
                array('id' => 'ASC'),
                $TopLimit,
                $BottomLimit
            );
            
            $images = array();
            foreach ($lists as $key => $entity) {
                $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            }
            
            
            return $this->render('blog/index.html.twig', [
                'lists' => $lists,
                'posts' => $posts,
                'images' => $images,
                'previousPage' => $previousPage,
                'nextPage' => $nextPage,
            ]);
        }catch(\Exception $e){
            
            return $this->render('blog/404.html.twig', [
            ]);
        
        }    
    }
}
