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

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('Darth\'s surprise birthday party!');
$event->setLocation('Deathstar');
$event->setTime(new \DateTime('tomorrow noon'));
//$Event->setDetails('Ha! Darth HATES surprises!!!');

$em = $container->get('doctrine')->getManager();
$em->persist($event);
$em->flush();

