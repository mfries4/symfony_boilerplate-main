<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Image;  
use Doctrine\ORM\EntityManagerInterface;



final class ImageController extends AbstractController
{

    #[Route('/images', name: 'image_list')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $images = $entityManager->getRepository(Image::class)->findAll();
        return $this->render('image/images_list.html.twig', [
            'images' => $images,
        ]);
    }
}
