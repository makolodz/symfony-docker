<?php

namespace App\Controller;

use App\Entity\Cours;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CourController extends AbstractController
{
    #[Route('/cours', name: 'app_salle')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $cours = new Cours();
        $cours->setName(" MVC");
        $cours->setNiveau("S6");
        $cours->setFns("jsplol");
        $cours->setVolume(18);

        $entityManager->persist($cours);

        $entityManager->flush();
        
        return new Response(content: 'Cours ajouté avec succès !');
    }

    #[Route('/view', name: 'app_cour_view')]
    public function view(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Cours::class);
        $id = 1;
        $value = $repository->find($id);
        //$name = $value->getNiveau();

        if(!$value) {
            return new Response('Cours introuvable');
        }

        return new Response(content: $value->getName());
    }
}
