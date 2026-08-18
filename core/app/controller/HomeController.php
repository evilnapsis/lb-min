<?php
namespace App\Controller;

use ViewEngine;

class HomeController {
    public function index() {
        ViewEngine::render('index.html.twig', ['title' => 'Inicio LegoBox']);
    }
}
