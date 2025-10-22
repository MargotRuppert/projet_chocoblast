<?php

namespace App\Controller;

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function error404(): void {
        http_response_code(404);
        $this->render("error_404", "error 404", []);
    }

    public function error403(): void{
        http_response_code(403);
        $this->render("error_403", "erreur 403", []);
    }
}
