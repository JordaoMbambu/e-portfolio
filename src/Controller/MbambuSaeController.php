<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MbambuSaeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('mbambu_sae/index.html.twig');
    }

    #[Route('/cv', name: 'cv')]
    public function cv(): Response
    {
        return $this->render('mbambu_sae/cv.html.twig');
    }
    #[Route('/hobbies', name: 'cv')]
    public function hobbies(): Response
    {
        return $this->render('mbambu_sae/hobbies.html.twig');
    }


    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('/about.html.twig');
    }
}
