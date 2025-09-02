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


}