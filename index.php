<?php
/**
 * LegoBox v5 - Front Controller & Router Principal
 * 
 * Este archivo centraliza la recepcion de todas las solicitudes HTTP,
 * inicializa el enrutador FastRoute, ejecuta los middlewares de sesion
 * y despacha las peticiones hacia los controladores/servicios y vistas Twig.
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/autoload.php';

session_start();

use App\Service\AuthService;
use App\Service\PersonService;

// Configuración de rutas de la aplicación utilizando FastRoute
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // Rutas públicas y de autenticación
    $r->addRoute('GET', '/', 'home_handler');
    $r->addRoute('GET', '/login', 'show_login');
    $r->addRoute('POST', '/login', 'process_login');
    $r->addRoute('GET', '/logout', 'process_logout');

    // Rutas CRUD del módulo de Personas
    $r->addRoute('GET', '/persons', 'list_persons');
    $r->addRoute('GET', '/person/new', 'show_new_person');
    $r->addRoute('POST', '/person/create', 'process_create_person');
    $r->addRoute('GET', '/person/{id:\d+}', 'show_person');
    $r->addRoute('GET', '/person/{id:\d+}/edit', 'show_edit_person');
    $r->addRoute('POST', '/person/{id:\d+}/update', 'process_update_person');
    $r->addRoute('POST', '/person/{id:\d+}/delete', 'process_delete_person');

    // Ruta de API RESTful en formato JSON
    $r->addRoute('GET', '/api/persons', 'api_persons_list');
});

// Captura del método HTTP y la URI de la solicitud
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Limpieza de parámetros Query String de la URI (/persons?page=1 -> /persons)
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Eliminación automática del prefijo si el proyecto se encuentra en un subdirectorio (ej. /lb-min-5)
$baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if (!empty($baseFolder) && strpos($uri, $baseFolder) === 0) {
    $uri = substr($uri, strlen($baseFolder));
}
if (empty($uri)) {
    $uri = '/';
}

// Despacho de la ruta mediante el dispatcher
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        ViewEngine::render('404.html.twig');
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "405 Método No Permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Middleware de protección de rutas privadas (requieren autenticación)
        $protectedHandlers = [
            'list_persons', 'show_new_person', 'process_create_person',
            'show_person', 'show_edit_person', 'process_update_person', 'process_delete_person'
        ];

        if (in_array($handler, $protectedHandlers) && !AuthService::check()) {
            header('Location: ' . $baseFolder . '/login');
            exit;
        }

        $personService = new PersonService();

        // Ejecución del controlador/handler correspondiente a la ruta solicitada
        switch ($handler) {
            case 'home_handler':
                ViewEngine::render('index.html.twig', ['title' => 'Inicio LegoBox']);
                break;

            case 'show_login':
                ViewEngine::render('auth/login.html.twig');
                break;

            case 'process_login':
                $auth = new AuthService();
                if ($auth->login($_POST['username'] ?? '', $_POST['password'] ?? '')) {
                    Session::flash('success', '¡Bienvenido de nuevo!');
                    header('Location: ' . $baseFolder . '/persons');
                } else {
                    ViewEngine::render('auth/login.html.twig', ['error' => 'Credenciales inválidas']);
                }
                break;

            case 'process_logout':
                (new AuthService())->logout();
                Session::flash('info', 'Has cerrado sesión correctamente.');
                header('Location: ' . $baseFolder . '/login');
                break;

            case 'list_persons':
                $persons = $personService->getAllPersons();
                ViewEngine::render('persons/index.html.twig', ['persons' => $persons]);
                break;

            case 'show_new_person':
                ViewEngine::render('persons/new.html.twig');
                break;

            case 'process_create_person':
                $errors = Request::validate([
                    'name' => 'required',
                    'lastname' => 'required'
                ]);
                if (!empty($errors)) {
                    Session::flash('error', implode(' ', $errors));
                    header('Location: ' . $baseFolder . '/person/new');
                    exit;
                }
                $personService->createPerson(Request::post());
                Session::flash('success', 'Persona registrada correctamente.');
                header('Location: ' . $baseFolder . '/persons');
                break;

            case 'show_person':
                $person = $personService->getPersonById((int)$vars['id']);
                ViewEngine::render('persons/show.html.twig', ['person' => $person]);
                break;

            case 'show_edit_person':
                $person = $personService->getPersonById((int)$vars['id']);
                ViewEngine::render('persons/edit.html.twig', ['person' => $person]);
                break;

            case 'process_update_person':
                $personService->updatePerson((int)$vars['id'], Request::post());
                Session::flash('success', 'Persona actualizada correctamente.');
                header('Location: ' . $baseFolder . '/persons');
                break;

            case 'process_delete_person':
                $personService->deletePerson((int)$vars['id']);
                Session::flash('info', 'Persona eliminada correctamente.');
                header('Location: ' . $baseFolder . '/persons');
                break;

            case 'api_persons_list':
                $persons = $personService->getAllPersons();
                Response::json(['status' => 'success', 'data' => $persons]);
                break;
        }
        break;
}