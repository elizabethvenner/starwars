<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');
        $event = $repo->findOneBy(['name' => 'Darth\'s surprise birthday party!']);

        return $this->render(
            'EventBundle:Default:index.html.twig',
            ['Event' => $event]
        );
    }
}
