<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class autorController extends  AbstractController
{

    #[Route('/autor/new', name:'app_new_autor')]
    public function createAutor(EntityManagerInterface $entityManager): Response
    {
        $autor = new Autor();
        $autor->setName('Gabriel');
        $autor->setApellidoPaterno('García');
        $autor->setApellidoMaterno('Márquez');
        $autor->setFechaNac(new \DateTime('1927-03-06'));
        $entityManager->persist($autor);
        $entityManager->flush();

        return new Response('Se guardo con exito el autor con id '.$autor->getId());
    }

    #[Route('/autors/', name:'app_list_autors')]
    public function show(AutorRepository $autorRepository)
    {
        $data = $autorRepository->findAll();
        return $this->render('autor/autor.html.twig', [
            'autores' => $data
        ]);
    }

//    controlador que devuelve un autor por su id
    #[Route('/autor/{id}', name:'app_autor_by_id')]
    public function showAutorById(AutorRepository $autorRepository, int $id): Response
    {
            $findAutor= $autorRepository->find($id);
            if (!$findAutor) {
                return new Response('No se encontro el autor con id '.$id);
            } else {
                return new Response('El autor con id '.$id.' es '.$findAutor->getName().' '.$findAutor->getApellidoPaterno().' '.$findAutor->getApellidoMaterno().', nacido el '.$findAutor->getFechaNac()->format('d-m-Y'));
            }
    }

//    controlador que actualiza el autor por su id
    #[Route('/autor/update/{id}', name:'app_update_autor')]
    public function updateAutor(EntityManagerInterface$entityManager, int $id): Response
    {
        $findAutor= $entityManager->getRepository(Autor::class)->find($id);
        if (!$findAutor) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $findAutor->setName('Mario');
        $findAutor->setApellidoPaterno('Vargas');
        $findAutor->setApellidoMaterno('Llosa');
        $findAutor->setFechaNac(new \DateTime('1936-03-28'));

        $entityManager->flush();

        return new Response('Se actualizo con exito el autor con id '.$findAutor->getId());

    }

//    controller que elimina un autor por su id
    #[Route ('/autor/delete/{id}', name:'app_delete_autor')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $foundAutor = $entityManager->getRepository(Autor::class)->find($id);
        if (!$foundAutor) {
            throw $this->createNotFoundException(
                'No author found for id '.$id
            );
        }
            $entityManager->remove($foundAutor);
            $entityManager->flush();
            return new Response('Se elimino con exito el autor con id '.$id);

    }
}