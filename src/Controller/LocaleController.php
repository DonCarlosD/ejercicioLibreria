<?php
// src/Controller/LocaleController.php
// src/Controller/LocaleController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends AbstractController
{
    #[Route('/change-locale/{locale}', name: 'change_locale')]
    public function changeLocale(Request $request, string $locale): RedirectResponse
    {
        $request->getSession()->set('_locale', $locale);

        // Redirige a la página anterior
        $referer = $request->headers->get('referer');
        return $this->redirect($referer ?: '/');
    }
}
