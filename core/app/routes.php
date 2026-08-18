<?php
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\PersonController;

return function(FastRoute\RouteCollector $r) {
    // Rutas públicas y de autenticación
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logout']);

    // Rutas CRUD de Personas (Privadas)
    $r->addRoute('GET', '/persons', [PersonController::class, 'index']);
    $r->addRoute('GET', '/person/new', [PersonController::class, 'new']);
    $r->addRoute('POST', '/person/create', [PersonController::class, 'create']);
    $r->addRoute('GET', '/person/{id:\d+}', [PersonController::class, 'show']);
    $r->addRoute('GET', '/person/{id:\d+}/edit', [PersonController::class, 'edit']);
    $r->addRoute('POST', '/person/{id:\d+}/update', [PersonController::class, 'update']);
    $r->addRoute('POST', '/person/{id:\d+}/delete', [PersonController::class, 'delete']);

    // API REST
    $r->addRoute('GET', '/api/persons', [PersonController::class, 'apiList']);
};
