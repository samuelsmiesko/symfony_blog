<?php

namespace App\Controller;
use App\Entity\Blogs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                15,
                0
            );
                    
            

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
                
                
            ]);
        }catch(\Exception $e){
            
            return $this->render('blog/404.html.twig', [
            ]);
        
        }    
    }

    
    #[Route("/student/ajax")]
    
    public function ajaxAction(Request $request) {  

        
        if(isset($_REQUEST)){
            $limit = $_REQUEST['get_variable'];
        }

        $TopLimit = $limit * 5;
        $BottomLimit = ($limit * 5)-4;
        
        $students = $this->em->getRepository(Blogs::class)->findBy(
            array(),
            array('id' => 'ASC'),
            $TopLimit,
            $BottomLimit
        ); 
        
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
        $jsonData = array();  
        $idx = 0;  
        foreach($students as $student) {  
            $temp = array(
                'title' => $student->getTitle(),  
                'article' => $student->getArticle(),  
                'id' => $student->getId(),
                
            );   
            $jsonData[$idx++] = $temp;  
        } 
        return new JsonResponse($jsonData); 
        } else { 
        return $this->render('base.html.twig'); 
        } 
    }    

    #[Route('/blog/{id}', name: 'blogPick')]
    public function gallery($id): Response
    {
        $posts = $this->em->getRepository(Blogs::class)->findBy(
            array(),
            array('id' => 'ASC'),
            
        );

        $images = array();
            foreach ($posts as $key => $entity) {
                $images[$key] = base64_encode(stream_get_contents($entity->getImage()));
            }

        return $this->render('blog/blog.html.twig', [
            
            'picked' => $id,
            'posts' => $posts,
            'images' => $images,
        ]);
    }
}
