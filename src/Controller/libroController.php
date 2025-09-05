<?php

namespace App\Controller;

use App\Entity\Biblioteca;
use App\Entity\BibliotecaLibro;
use App\Entity\Libro;
use App\Form\BibliotecaLibrosType;
use App\Form\LibroType;
use App\Repository\LibroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class libroController extends AbstractController
{
    #[Route('/libro/new', name: 'app_new_libro')]
    public function newLibro(Request $request,EntityManagerInterface $entityManager):Response
    {
        $libro = new Libro();

        $form=$this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($libro);
            $entityManager->flush();
            $this->addFlash('success','Libro creado con exito');

            return $this->redirectToRoute('app_list_libros');
        }




        return $this->render('libro/newLibro.html.twig', [
            'form' => $form->createView(),
            'errors'=> $form->getErrors(true, false)
        ]);
    }

    #[Route('/libros', name: 'app_list_libros')]
    public function show(LibroRepository $libroRepository):Response
    {
        $libros= $libroRepository->findAll();

        return $this->render('libro/libros.html.twig', [
            'libros' => $libros
        ]);
    }

    #[Route('/libro/{id}', name: 'app_show_libro')]
    public function showLibro(EntityManagerInterface $entityManager, int $id):Response
    {
        $libro= $entityManager->getRepository(Libro::class)->find($id);
        $bibliotecas = $entityManager->getRepository(BibliotecaLibro::class)->findBy(['libro' => $libro]);
        return $this->render('libro/libro.html.twig', [
            'libro' => $libro,
            'bibliotecas' => $bibliotecas
        ]);
    }

    #[Route('/libro/edit/{id}', name: 'app_edit_libro')]
    public function editLibro(Request $request, EntityManagerInterface $entityManager, int $id):Response
    {
        $libro= $entityManager->getRepository(Libro::class)->find($id);

        $form=$this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Libro editado con exito');
            return $this->redirectToRoute('app_list_libros');
        }
        return $this->render('libro/editLibro.html.twig', [
            'form' => $form->createView(),
            'libro' => $libro,
            'errors'=> $form->getErrors(true, false)
        ]);
    }

    #[Route('/libro/delete/{id}', name: 'app_delete_libro')]
    public function deleteLibro(EntityManagerInterface $entityManager, Libro $libro):Response
    {



            $entityManager->remove($libro);
            $entityManager->flush();
            return $this->json(['success' => true]);

    }

//    agregar libro a biblioteca
    #[Route('/libro/biblioteca/new/{id}', name: 'app_new_libro_biblioteca')]
    public function newLibroBiblioteca(Request $request, EntityManagerInterface $entityManager,int $id):Response
    {
        $bibliotecaLibro= new BibliotecaLibro();

//        buscar biblioteca por id y asignarla al formulario

        $biblioteca = $entityManager->getRepository(Biblioteca::class)->find($id);

//        asignar la biblioteca al formulario
        $bibliotecaLibro->setBiblioteca($biblioteca);

        $form = $this->createForm(BibliotecaLibrosType::class, $bibliotecaLibro);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($bibliotecaLibro);
            $entityManager->flush();
            $this->addFlash('success','Libro agregado a la biblioteca con exito');
            return $this->redirectToRoute('app_biblioteca_by_id', ['id' => $id]);
        }

        return $this->render('libro/bibliotecaLibro.html.twig', [
            'form' => $form->createView(),
            'errors'=> $form->getErrors(true, false),
            'biblioteca' => $biblioteca
        ]);
    }

//    eliminar libro de biblioteca
    #[Route('/libro/biblioteca/delete/{id}', name: 'app_delete_libro_biblioteca', methods:['POST'])]
    public function deleteLibroBiblioteca(EntityManagerInterface $entityManager, BibliotecaLibro $bibliotecaLibro):Response
    {

            $entityManager->remove($bibliotecaLibro);
            $entityManager->flush();
            return $this->json(['success' => true]);

    }

//    editar el libro de la biblioteca
    #[Route('/libro/biblioteca/edit/{id}', name: 'app_edit_libro_biblioteca')]
    public function editLibroBiblioteca(Request $request,EntityManagerInterface $entityManager, BibliotecaLibro $bibliotecaLibro):Response
    {

        $form = $this->createForm(BibliotecaLibrosType::class, $bibliotecaLibro);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            $this->addFlash('success','Libro editado en la biblioteca con exito');
            return $this->redirectToRoute('app_biblioteca_by_id', ['id' => $bibliotecaLibro->getBiblioteca()->getId()]);
        }
        return $this->render('libro/editBibliotecaLibro.html.twig', [
            'form' => $form->createView(),
            'errors'=> $form->getErrors(true, false),
            'bibliotecaLibro' => $bibliotecaLibro
        ]);

    }

}