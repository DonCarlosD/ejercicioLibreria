<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Form\BibliotecaType;
use App\Repository\BibliotecaLibroRepository;
use App\Repository\BibliotecaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class bibliotecaController extends AbstractController
{
    #[Route('/biblioteca/new', name:'app_new_biblioteca')]
    public function createBiblioteca(Request $request, EntityManagerInterface $entityManager): Response
    {
        $biblioteca = new Biblioteca();

        $form= $this->createForm(BibliotecaType::class,$biblioteca);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($biblioteca);
            $entityManager->flush();
            $this->addFlash('success','Biblioteca creada con exito');
            return $this->redirectToRoute('app_list_bibliotecas');
        }
        return $this->render('biblioteca/newBiblioteca.html.twig', [
            'form' => $form->createView()
        ]);

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
    public function showBibliotecaById(BibliotecaRepository $bibliotecaRepository,BibliotecaLibroRepository $bibliotecaLibroRepository, int $id):Response
    {
        $findBiblioteca = $bibliotecaRepository->find($id);
        if (!$findBiblioteca) {
            return new Response('No se encontro la biblioteca con id '.$id);
        }
        $bibliotecaLibros = $bibliotecaLibroRepository->findBy(['biblioteca' => $findBiblioteca]);
        return $this->render('biblioteca/biblioteca.html.twig', [
            'biblioteca' => $findBiblioteca,
            'libros' => $bibliotecaLibros
        ]);


    }

//    controlador que actauliza una biblioteca por su id
    #[Route('/biblioteca/update/{id}', name:'app_update_biblioteca')]
    public function update(Request $request,EntityManagerInterface $entityManager, int $id):Response
    {
        $foundBiblioteca = $entityManager->getRepository(Biblioteca::class)->find($id);
        $form = $this->createForm(BibliotecaType::class, $foundBiblioteca);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            $this->addFlash('success','Biblioteca actualizada con exito');
            return $this->redirectToRoute('app_list_bibliotecas');
        }
        return $this->render('biblioteca/editBiblioteca.html.twig', [
            'form' => $form->createView(),
            'biblioteca' => $foundBiblioteca
        ]);

    }

//    controlador que elimina una biblioteca por su id
    #[Route('/biblioteca/delete/{id}', name:'app_delete_biblioteca')]
    public function delete(EntityManagerInterface $entityManager, Biblioteca $biblioteca):Response
    {

        $entityManager->remove($biblioteca);
        $entityManager->flush();
        return $this->json(['success' => true]);
    }

}