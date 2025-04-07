<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

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

    #[Route('/hobbies', name: 'hobbies')]
    public function hobbies(): Response
    {
        return $this->render('mbambu_sae/hobbies.html.twig');
    }
    #[Route('/e-portfolio', name: 'e-portfolio')]
    public function portfolio(): Response
    {
        return $this->render('mbambu_sae/e-portfolio.html.twig');
    }
    
    #[Route('/rt1', name: 'rt1')]
    public function rt1(): Response
    {
        return $this->render('mbambu_sae/rt1.html.twig');
    }
    #[Route('/rt2', name: 'rt2')]
    public function rt2(): Response
    {
        return $this->render('mbambu_sae/rt2.html.twig');
    }
    #[Route('/rt3', name: 'rt3')]
    public function rt3(): Response
    {
        return $this->render('mbambu_sae/rt3.html.twig');
    }
    #[Route('/parcours', name: 'parcours')]
    public function parcours(): Response
    {
        return $this->render('mbambu_sae/choix.parcours.html.twig');
    }

    #[Route('/generate-cv', name: 'generate_cv', methods: ['POST'])]
    public function generateCv(Request $request): Response
    {
        // Récupérer les données du formulaire
        $name = $request->request->get('name', 'Nom inconnu');
        $email = $request->request->get('email', 'Email non fourni');
        $phone = $request->request->get('phone', 'Téléphone non fourni');
        $jobTitle = $request->request->get('jobTitle', 'Poste non spécifié');

        // Validation basique des données
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $phone = htmlspecialchars($phone);
        $jobTitle = htmlspecialchars($jobTitle);

        // Rendre le template Twig en HTML
        $html = $this->renderView('mbambu_sae/cvdownload.html.twig', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'jobTitle' => $jobTitle,
        ]);

        // Configurer Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial'); // Police par défaut
        $pdfOptions->setIsHtml5ParserEnabled(true); // Activer le parseur HTML5
        $pdfOptions->setIsRemoteEnabled(true); // Activer le chargement des images externes
        $dompdf = new Dompdf($pdfOptions);

        // Charger le contenu HTML dans Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // Format A4 en mode portrait
        $dompdf->render();

        // Générer le fichier PDF
        $pdfOutput = $dompdf->output();

        // Créer un nom de fichier sécurisé
        $safeFileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', "cv_{$name}.pdf");

        // Retourner le fichier PDF comme réponse
        return new Response($pdfOutput, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename={$safeFileName}",
        ]);
    }
}