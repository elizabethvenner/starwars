<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require __DIR__.'/app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
//$container->enterScope('request');
$container->set('request', $request);

//my code goes here - what goes above is to allow me to play in the terminal

$em = $container->get('doctrine')->getManager();

$user = $em
    ->getRepository('UserBundle:User')
    ->findOneBy(array('username' => 'wayne'))
    ;

foreach ($user->getEvents() as $event) {
    var_dump($event->getName());
}


