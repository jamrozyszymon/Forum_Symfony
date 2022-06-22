<?php

namespace App\Core\Controller;

use App\Core\CreatePost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\PostLike;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    /**
     *  @Route ("/post", name="post")
     */
    /*
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        $post = new Post();
        $post->setContent("Tekst");
        $entityManagerInterface->persist($post);
        $entityManagerInterface->flush();

        return new Response("kontroller postu");
    }
    */
    /*
    //pobieranie
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        $postRepository = $entityManagerInterface->getRepository(Post::class);
        $posts = $postRepository->findAll();

        $html='';
        foreach($posts as $post)
        {
            $html.=$post->getContent(). '<br>';
        }
        return new Response($html);
    }
    */

    //edycja
    /*
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        $postRepository = $entityManagerInterface->getRepository(Post::class);
        $postOne = $postRepository->findOneBy(['id' => 1]);
        $postOne->setContent("zmiana tekstu");
        $entityManagerInterface->flush();
        return new Response("zmieniono");
    }
    */

    //natywne'
    /*
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        $sql = "SELECT id FROM post";
        $posts=$entityManagerInterface->getConnection()->executeQuery($sql)->fetchAllAssociative();
        $html='';
        foreach($posts as $post)
        {
            $html.=$post['id']. '<br>';
        }
        return new Response($html);
    }
    */

    /*
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        $postRepository = $entityManagerInterface->getRepository(Post::class);
        $postToAddLike = $postRepository->findOneBy(['id'=>1]);
        $postLike = new PostLike();
        $postLike->setPost($postToAddLike);
        $entityManagerInterface->persist($postLike);
        $entityManagerInterface->flush();

        return new Response('dodano like do'.$postToAddLike->getId());
    }
    */

    /*
    //querybuilder
    public function index(EntityManagerInterface $entityManagerInterface)
    {
        
        $postRepository=$entityManagerInterface->getRepository(Post::class);
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $posts=$postRepository->getByDates($startDate, $endDate);
        $html ='';
        foreach($posts as $post)
        {
            $html.=$post['id']. '<br>';
        }
        return new Response($html);

    }
    */

    
    //dodawanie z formularza
    public function create(CreatePost $createPost, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        if($request->isMethod('POST')) {
            try{
                $createPost->create($request->get('content'));
                $this->addFlash('success', "Post został dodany prawidłowo");
            } catch (Exception $ex) {
                $this->addFlash('danger', $ex->getMessage());
            }
        }
        $createPost->create('test CreatePost');
        $postRepository=$entityManagerInterface->getRepository(Post::class);
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $posts=$postRepository->getByDates($startDate, $endDate);
        $html ='';
        foreach($posts as $post) {
            $html .=count($post->getPostLike()). '.'. $post->getContent(). '</br>';
        }
        return $this->render('Post/posts.twig.html', ['html'=>$html]);
    }
    
}
