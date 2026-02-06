<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
// ...


class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_show', requirements: ['id' => '\d+'])]
    public function show(EntityManagerInterface $entityManager,  Request $request, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        return new Response('Check out this great user: '.$user->getUser());

        // or render a template
    }
}