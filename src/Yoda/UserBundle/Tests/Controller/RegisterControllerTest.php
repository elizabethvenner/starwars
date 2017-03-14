<?php

namespace Yoda\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{

    public function testRegister()
    {
        $client = static::createClient();

        $container = self::$kernel->getContainer();
        $em = $container->get('doctrine')->getManager();
        $userRepo = $em->getRepository('UserBundle:User');
        $userRepo->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute()
            ;

        $crawler = $client->request('GET', '/register');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Register',  $response->getContent());

        $usernameVal = $crawler
            ->filter('#register_form_username')
            ->attr('value')
        ;
        $this->assertEquals('Leia', $usernameVal);

        $form = $crawler->selectButton('Register!')->form();

        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/This value should not be blank/',
            $client->getResponse()->getContent());

        $form = $crawler->selectButton('Register!')->form();

        $form['register_form[username]'] = 'user5';
        $form['register_form[email]'] = 'user5@user.com';
        $form['register_form[plainPassword][first]'] = 'Password1';
        $form['register_form[plainPassword][second]'] = 'Password1';


        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();
        $this->assertContains('Welcome to the Death Star, have a magical day!', $client->getResponse()->getContent());

    }
}
