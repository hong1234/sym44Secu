<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }

     /**
     * @Route("/admin/list", name="admin_list")
     */
    public function list()
    {
        return $this->render('default/list.html.twig', [
            //'number' => $number,
        ]);
    }

    /**
     * @Route("/set-session", name="set-session")
     */
    public function setSession(SessionInterface $session)
    {
        // stores an attribute for reuse during a later user request
        $session->set('foo', 'HELLO-FOO2');

        // gets an attribute by name
        //$foo = $session->get('foo');

        return $this->json([
            'message' => 'set foo : HELLO-FOO2',
            //'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    /**
     * @Route("/get-session", name="get-session")
     */
    public function getSession(SessionInterface $session)
    {
        // stores an attribute for reuse during a later user request
        //$session->set('foo', 'HELLO session !');

        // gets an attribute by name
        $value = $session->get('foo');

        return $this->json([
            'message' => 'get foo : '.$value,
            //'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    /**
     * @Route("/user", name="user")
     */
    public function user()
    {
        $username = 'No One';
        if($user = $this->getUser()){
            $username = $user->getEmail();
        }

        //return $this->render('brand_new/index.html.twig', [
        //    'username' => $username,
        //    'controller_name' => 'BrandNewController',
        //]);
        return $this->json([
            'user' => $username,
            //'path' => 'src/Controller/DefaultController.php',
        ]);
    }
}

    
