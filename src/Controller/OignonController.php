<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Oignon;
use Doctrine\ORM\EntityManagerInterface;


final class OignonController extends AbstractController
{

    #[Route('/oignons', name: 'oignon_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $oignons = $entityManager->getRepository(Oignon::class)->findAll();
        return $this->render('oignon/oignons_list.html.twig', [
            'oignons' => $oignons,
        ]);
    }


    #[Route('/oignon/list', name: 'oignon_list', methods: ['GET', 'POST'])]
    public function list(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        $oignons = $entityManager->getRepository(Oignon::class)->findAll();
        $oignon = new Oignon();
        $form = $this->createForm(\App\Form\OignonType::class, $oignon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($oignon);
            $entityManager->flush();
            $this->addFlash('success', 'Oignon créé !');
            return $this->redirectToRoute('oignon_list');
        }
        return $this->render('oignon/index.html.twig', [
            'oignons' => $oignons,
            'form' => $form->createView()
        ]);
    }


}
