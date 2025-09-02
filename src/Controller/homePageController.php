<?php

namespace App\Controller;


use App\Entity\Autor;
use App\Form\AutorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class homePageController extends  AbstractController
{
    #[Route ('/', name: 'app_homePage')]
    public function homePage(): Response
    {
        $number = random_int(0, 100);
        return $this->render('pages/homePage.html.twig',[
            'number' => $number
        ]);
    }

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
}