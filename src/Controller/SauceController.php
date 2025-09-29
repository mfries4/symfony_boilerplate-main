<?php

namespace App\Controller;

use App\Entity\Sauce;
use App\Form\SauceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class SauceController extends AbstractController
{


    #[Route('/sauce/list', name: 'sauce_list', methods: ['GET', 'POST'])]
    public function list(Request $request, EntityManagerInterface $em): Response
    {
        $sauces = $em->getRepository(Sauce::class)->findAll();
        $sauce = new Sauce();
        $form = $this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sauce);
            $em->flush();
            $this->addFlash('success', 'Sauce créée!');
            return $this->redirectToRoute('sauce_list');
        }
        return $this->render('sauce/index.html.twig', [
            'sauces' => $sauces,
            'form' => $form->createView()
        ]);
    }

   

}
