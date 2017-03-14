<?php
namespace Yoda\EventBundle\Controller;

use Doctrine\ORM\Query\Expr\Base;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Yoda\EventBundle\Entity\Event;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Controller extends BaseController
{
    public function getSecurityAuthorizationChecker()
    {
        return $this->container->get('security.authorization_checker');
    }

    public function getSecurityTokenStorage()
    {
        return $this->container->get('security.token_storage');
    }

    public function enforceOwnerSecurity(Event $event)
    {
        $user = $this->getUser();

        if ($user != $event->getOwner()) {
            throw $this->createAccessDeniedException("You are not the owner!");
        }
    }
}