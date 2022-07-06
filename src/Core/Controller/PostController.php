<?php

namespace App\Core\Controller;

use App\Core\CreatePost;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use DateTime;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    /**
     *  @Route ("/post", name="post")
     */
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
        $postRepository = $entityManagerInterface->getRepository(Post::class);
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', "2022-01-01 00:00:00");
        $posts=$postRepository->getByDates($startDate, $endDate);
        $html ='';
        foreach($posts as $post) {
            $html.= count($post->getPostLike()). '.'. $post->getContent(). '</br>';
        }
        return $this->render('Post/posts.twig.html', ['html'=>$html]);
    }
    
}
