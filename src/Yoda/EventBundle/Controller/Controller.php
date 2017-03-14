<?php
namespace Yoda\EventBundle\Controller;

use Doctrine\ORM\Query\Expr\Base;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function getSecurityTokenStorage()
    {
        return $this->container->get('security.token_storage');
    }

}