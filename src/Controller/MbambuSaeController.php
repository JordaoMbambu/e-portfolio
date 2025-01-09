<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MbambuSaeController extends AbstractController
{
    #[Route('/mbambu/sae', name: 'app_mbambu_sae')]
    public function index(): Response
    {
        return $this->render('mbambu_sae/index.html.twig', [
            'controller_name' => 'MbambuSaeController',
        ]);
    }
}
