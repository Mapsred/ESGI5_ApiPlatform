<?php

namespace App\Controller;

use App\Entity\Ticket;
use Dompdf\Dompdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PDFController extends AbstractController
{
    public function __invoke(Ticket $data)
    {
        $domPDF = new Dompdf();
        $domPDF->loadHtml($this->renderView('pdf/index.html.twig', [
            'ticket' => $data,
        ]));

        $domPDF->render();

        $domPDF->stream('ticket.pdf');

        return new Response();
    }
}
