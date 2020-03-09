<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {

        $form = $this->createForm(ContactType::class);
        // $currentPerformances = 
        $performances = $this->getDoctrine()->getRepository(Performance::class)->findAll();
        return $this->render('default/index.html.twig', [
            'performances' => $performances,
        ]);

        // return $this->render('default/index.html.twig', [
        //     'form' => $form->createView()
        //     // 'currentPerformances' => $currentPerformances
        // ]);
    }
}
