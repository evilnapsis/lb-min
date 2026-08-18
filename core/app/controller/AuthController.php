<?php
namespace App\Controller;

use App\Service\AuthService;
use ViewEngine;
use Session;

class AuthController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLogin() {
        ViewEngine::render('auth/login.html.twig');
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($this->authService->login($username, $password)) {
            Session::flash('success', '¡Bienvenido de nuevo!');
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/persons');
        } else {
            ViewEngine::render('auth/login.html.twig', ['error' => 'Credenciales inválidas']);
        }
    }

    public function logout() {
        $this->authService->logout();
        Session::flash('info', 'Has cerrado sesión correctamente.');
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/login');
    }
}
