<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pain;
use Doctrine\ORM\EntityManagerInterface;



final class PainController extends AbstractController
{

    #[Route('/pains', name: 'pain_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pains = $entityManager->getRepository(Pain::class)->findAll();
        return $this->render('pain/pains_list.html.twig', [
            'pains' => $pains,
        ]);
    }

    #[Route('/pain/create', name: 'pain_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $pain = new Pain();
        $pain->setName('Pain rouge');

        // Persister et sauvegarder l'pain
        $entityManager->persist($pain);
        $entityManager->flush();

        return new Response('Pain créé avec succès !');
    }

    #[Route('/pain/list', name: 'pain_list', methods: ['GET', 'POST'])]
    public function list(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        $pains = $entityManager->getRepository(Pain::class)->findAll();
        $pain = new Pain();
        $form = $this->createForm(\App\Form\PainType::class, $pain);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pain);
            $entityManager->flush();
            $this->addFlash('success', 'Pain créé !');
            return $this->redirectToRoute('pain_list');
        }
        return $this->render('pain/index.html.twig', [
            'pains' => $pains,
            'form' => $form->createView()
        ]);
    }


}
