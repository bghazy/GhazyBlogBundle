<?php

namespace Ghazy\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ghazy\BlogBundle\Entity\Comment;
use Ghazy\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setPost($blog);
	$comment->setIsActivated(false);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('GhazyBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();
        $comment->setPost($blog);
	$comment->setIsActivated(false);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($comment);
            $em->flush();
            $this->get('session')->setFlash('my_flash_key',"Your Comment is wating for moderation");
        }
	else{
	    $this->get('session')->setFlash('my_flash_key',"Your comment can not be submited! Looks like I have some problems to fix!");
	}        
	return $this->redirect($this->generateUrl('ghazy_blog_tutorial', array(
		'slug'  => $comment->getPost()->getTitleSlug(),
                'id'    => $comment->getPost()->getId()))
                
            );
    }

    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $blog = $em->getRepository('GhazyBlogBundle:Post')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }

}
