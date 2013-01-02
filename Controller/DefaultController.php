<?php

namespace Ghazy\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('GhazyBlogBundle:Default:index.html.twig');
    }
    public function aboutmeAction()
    {
    	return $this->render('GhazyBlogBundle:Default:aboutme.html.twig');
    }
    public function tutorialsAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$tutos = $em->createQuery('SELECT j FROM GhazyBlogBundle:Post j WHERE j.is_activated = :param')->setParameter('param',true)->getResult();
    	return $this->render('GhazyBlogBundle:Default:tutorials.html.twig', array('tutos'=>$tutos));
    }
    public function tutorialAction($slug, $id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$tuto = $em->getRepository('GhazyBlogBundle:Post')->find($id);
		$comments = $em->createQuery('SELECT j FROM GhazyBlogBundle:Comment j WHERE j.is_activated = :param AND j.post =:post')->setParameters(array('param'=>true, 'post' => $tuto->getId()))->getResult();
    	return $this->render('GhazyBlogBundle:Default:tutorial.html.twig', array('tuto'=>$tuto, 'comments'=>$comments));
    }
    public function feedAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
        $articles = $em->createQuery('SELECT j FROM GhazyBlogBundle:Post j WHERE j.is_activated = :param')->setParameter('param',true)->getResult();

        $feed = $this->get('eko_feed.feed.manager')->get('article');
        $feed->addFromArray($articles);

        return new Response($feed->render('rss'));
    }
    public function tagAction($tagSlug)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$tag = $em->getRepository('GhazyBlogBundle:Tag')->findOneBySlug($tagSlug);
    	if (!$tag) {
    		throw $this->createNotFoundException('Unable to find Job entity.');
    	}
    	$tutos = $em->createQuery('SELECT j FROM GhazyBlogBundle:Post j WHERE j.is_activated = :param AND :tagparam MEMBER OF j.tags')->setParameters(array('param'=>true, 'tagparam'=>$tag->getId()))->getResult();
    	return $this->render('GhazyBlogBundle:Default:tutorials.html.twig', array('tutos'=>$tutos));
    	
    }
    
}
