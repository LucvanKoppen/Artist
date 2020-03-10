<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\ContactType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $performances = $this->getDoctrine()->getRepository(Performance::class)->findAll();
        $performancesNearbyFuture = $this->getDoctrine()->getRepository(Performance::class)->getByPeriodPerformances(new DateTime("sunday this week"), new DateTime());
        $performancesHistory = $this->getDoctrine()->getRepository(Performance::class)->getByPeriodPerformances(new DateTime(), new DateTime("-99999 year"));
        return $this->render('default/index.html.twig', [
            'performances' => $performances,
            'performancesNearbyFuture' => $performancesNearbyFuture,
            'performancesHistory' => $performancesHistory,
        ]);
    }

        /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {

        $form = $this->createForm(ContactType::class);

        return $this->render('default/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
