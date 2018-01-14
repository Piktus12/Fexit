<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        // replace this line with your own code!
        $session = new session();
        $session->start();


        return $this->render('index.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__), 'session' => $session ]);
    }
}
