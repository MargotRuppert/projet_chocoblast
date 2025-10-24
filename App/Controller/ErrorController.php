<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    /**
     * Méthode pour gérer l'erreur 404
     * @return void Affiche la page d'erreur 404
     */
    public function error404(): void
    {
        http_response_code(404);
        header("Refresh:2; url=/");
        $this->render('error_404', 'Erreur 404');
    }

    /**
     * Méthode pour gérer l'erreur 403
     * @return void Affiche la page d'erreur 403
     */
    public function error403(): void
    {
        http_response_code(403);
        header("Refresh:2; url=/");
        $this->render('error_403', 'Erreur 403');
    }
}
