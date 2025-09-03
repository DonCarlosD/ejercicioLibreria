<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Entity\Libro;
use App\Form\AutorType;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class autorController extends  AbstractController
{

    #[Route('/new-autor', name: 'app_new_autor')]
    public function newAutor(Request $request, EntityManagerInterface $entityManager):Response
    {
        $autor = new Autor();
        //crear el formulario
        $form = $this->createForm(AutorType::class, $autor);

        //manejar la peticion
        $form->handleRequest($request);
        //si el formulario es enviado y es valido
        if($form->isSubmitted() && $form->isValid()){
            //guardar el autor en la base de datos
            $entityManager->persist($autor);
            $entityManager->flush();

            //enviar una notificacion flash
            $this->addFlash('success','Autor creado con exito');
            //redireccionar a la pagina de inicio
            return $this->redirectToRoute('app_list_autors');
        }

        return $this->render('autor/newAutor.html.twig',[
            'form' => $form->createView()
        ]);

    }

    #[Route('/autors/', name:'app_list_autors')]
    public function show(AutorRepository $autorRepository)
    {
        $data = $autorRepository->findAll();
        return $this->render('autor/autores.html.twig', [
            'autores' => $data
        ]);
    }

//    controlador que devuelve un autor por su id
    #[Route('/autor/{id}', name:'app_autor_by_id')]
    public function showAutorById(EntityManagerInterface $entityManager, int $id): Response
    {
            $findAutor = $entityManager->getRepository(Autor::class)->find($id);
            $libros = $entityManager->getRepository(Libro::class)->findBy(['autor' => $findAutor]);
            if (!$findAutor) {
                throw $this->createNotFoundException(
                    'No author found for id '.$id
                );
            }
            return $this->render('autor/autor.html.twig', [
                'autor' => $findAutor,
                'libros' => $libros
            ]);
    }

//    controlador que actualiza el autor por su id
    #[Route('/autor/update/{id}', name:'app_update_autor')]
    public function updateAutor(Request $request,EntityManagerInterface$entityManager, int $id): Response
    {
        $findAutor= $entityManager->getRepository(Autor::class)->find($id);
        if (!$findAutor) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $form = $this->createForm(AutorType::class,$findAutor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $findAutor = $form->getData();
            $entityManager->persist($findAutor);
            $entityManager->flush();
            return $this->redirectToRoute('app_list_autors');
        }


        return $this->render('autor/editAutor.html.twig', [
            'form' => $form->createView(),
            'autor' => $findAutor
        ]);

    }

//    controller que elimina un autor por su id
    #[Route ('/autor/delete/{id}', name:'app_delete_autor', methods: ['POST'])]
    public function delete(EntityManagerInterface $entityManager, Autor $autor): JsonResponse
    {

            $entityManager->remove($autor);
            $entityManager->flush();
            return $this->json(['success' => true]);

    }
}