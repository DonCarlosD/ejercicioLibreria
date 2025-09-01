<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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