<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ScoreRepository;
use Dompdf\Dompdf;
use Dompdf\Options;

class CertificatController extends AbstractController
{
    /**
     * @Route("/certificat/{id}", name="app_certificat")
     */
    public function index(ScoreRepository $scoreRepository, $id): Response
    {
        $score = $scoreRepository->find($id);

        return $this->render('certificat/index.html.twig', [
            'score' => $score,
        ]);
    }
    /**
     * @Route("/certificat-pdf/{id}", name="pdf_certificat")
     */
    public function generatePdfAction(ScoreRepository $scoreRepository, $id)
    {
        $score = $scoreRepository->find($id);

        // Créez une instance de Dompdf
        $dompdf = new Dompdf();
        $options = new Options();
        $options->setDefaultFont('Arial');
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        // Générez le contenu HTML de la vue Twig
        $html = $this->renderView('certificat/index.html.twig', [
            'score' => $score,
        ]);

        // Appliquez les options à Dompdf

        // Chargez le contenu HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Créez les options de Dompdf
        $options = new Options();
        $options->setDefaultFont('Arial');

        // Appliquez les options à Dompdf
        $dompdf->setOptions($options);

        // Rendu du PDF
        $dompdf->render();

        // Générez un nom de fichier unique pour le PDF
        $filename = 'certificat_' . $id . '.pdf';

        // Enregistrez le PDF sur le serveur
        $output = $dompdf->output();
        file_put_contents($filename, $output);

        // Retournez une réponse de téléchargement du PDF
        return new Response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
