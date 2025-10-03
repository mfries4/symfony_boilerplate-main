<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Form\BurgerType;
use App\Repository\BurgerRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class BurgerController extends AbstractController
{
    
    #[Route('/burger', name: 'burger_list')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $burgers = $entityManager->getRepository(Burger::class)->findAll();
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($burger);
            $entityManager->flush();
            $this->addFlash('success', 'Burger créée!');
            return $this->redirectToRoute('burger_list');
        }

        return $this->render('burger/burgers_list.html.twig', [
            'burgers' => $burgers,
            'form' => $form->createView()
        ]);
    }


    

    #[Route('/burgers/ingredient', name: 'burger_expensive')]
    public function burgersWithIngredient(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient(1, 1, 2);
        return $this->render('burger/burgers_with_ingredient.html.twig', [
            'burgers' => $burgers,
        ]);
    }

}
