<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Repository\BibliotecaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class bibliotecaController extends AbstractController
{
    #[Route('/biblioteca/new', name:'app_new_biblioteca')]
    public function createBiblioteca(EntityManagerInterface $entityManager): Response
    {
        $biblioteca = new Biblioteca();
        $biblioteca->setNombre('Biblioteca Central');
        $biblioteca->setCalle('Av. Siempre Viva');
        $biblioteca->setColonia('Springfield');
        $biblioteca->setNo('123');
        $biblioteca->setCP('54321');
        $biblioteca->setTel('555-1234');
        $entityManager->persist($biblioteca);
        $entityManager->flush();
        return new Response('Se guardo con exito la biblioteca con id '.$biblioteca->getId());

    }

//    controlador que devuelve una lista de bibliotecas
    #[Route('/bibliotecas/', name:'app_list_bibliotecas')]
    public function showBibliotecas(BibliotecaRepository $bibliotecaRepository):Response
    {
        $bibliotecas = $bibliotecaRepository->findAll();
        return $this->render('biblioteca/bibliotecas.html.twig', [
            'bibliotecas' => $bibliotecas
        ]);
    }

//    controlador que devuelve una biblioteca por su id
    #[Route('/biblioteca/{id}', name:'app_biblioteca_by_id')]
    public function showBibliotecaById(BibliotecaRepository $bibliotecaRepository, int $id):Response
    {
        $findBiblioteca = $bibliotecaRepository->find($id);
        if (!$findBiblioteca) {
            return new Response('No se encontro la biblioteca con id '.$id);
        } else {
            return new Response('La biblioteca con id '.$id.' es '.$findBiblioteca->getNombre().', ubicada en '.$findBiblioteca->getCalle().' No. '.$findBiblioteca->getNo().', Colonia '.$findBiblioteca->getColonia().', CP '.$findBiblioteca->getCP().', Teléfono: '.$findBiblioteca->getTel());
        }

    }

//    controlador que actauliza una biblioteca por su id
    #[Route('/biblioteca/update/{id}', name:'app_update_biblioteca')]
    public function update(EntityManagerInterface $entityManager, int $id):Response
    {
        $foundBiblioteca = $entityManager->getRepository(Biblioteca::class)->find($id);
        if (!$foundBiblioteca) {
            return new Response('No se encontro la biblioteca con id '.$id);
        }
            $foundBiblioteca->setNombre('Biblioteca Actualizada'.$id);
            $entityManager->flush();
            return new Response('Se actualizo con exito la biblioteca con id '.$id);

    }

//    controlador que elimina una biblioteca por su id
    #[Route('/biblioteca/delete/{id}', name:'app_delete_biblioteca')]
    public function delete(EntityManagerInterface $entityManager, int $id):Response
    {
        $foundBiblioteca = $entityManager->getRepository(Biblioteca::class)->find($id);
        if (!$foundBiblioteca) {
            return new Response('No se encontró la biblioteca con id ' . $id);
        }
        $entityManager->remove($foundBiblioteca);
        $entityManager->flush();
        return new Response('Se elimino con exito la biblioteca con id '.$id);
    }

}