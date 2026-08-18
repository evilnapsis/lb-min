<?php
namespace App\Controller;

use App\Service\PersonService;
use ViewEngine;
use Request;
use Response;
use Session;

class PersonController {
    private $personService;
    private $baseFolder;

    public function __construct() {
        $this->personService = new PersonService();
        $this->baseFolder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    }

    public function index() {
        $persons = $this->personService->getAllPersons();
        ViewEngine::render('persons/index.html.twig', ['persons' => $persons]);
    }

    public function new() {
        ViewEngine::render('persons/new.html.twig');
    }

    public function create() {
        $errors = Request::validate([
            'name' => 'required',
            'lastname' => 'required'
        ]);
        if (!empty($errors)) {
            Session::flash('error', implode(' ', $errors));
            header('Location: ' . $this->baseFolder . '/person/new');
            exit;
        }
        $this->personService->createPerson(Request::post());
        Session::flash('success', 'Persona registrada correctamente.');
        header('Location: ' . $this->baseFolder . '/persons');
    }

    public function show($vars) {
        $person = $this->personService->getPersonById((int)$vars['id']);
        ViewEngine::render('persons/show.html.twig', ['person' => $person]);
    }

    public function edit($vars) {
        $person = $this->personService->getPersonById((int)$vars['id']);
        ViewEngine::render('persons/edit.html.twig', ['person' => $person]);
    }

    public function update($vars) {
        $this->personService->updatePerson((int)$vars['id'], Request::post());
        Session::flash('success', 'Persona actualizada correctamente.');
        header('Location: ' . $this->baseFolder . '/persons');
    }

    public function delete($vars) {
        $this->personService->deletePerson((int)$vars['id']);
        Session::flash('info', 'Persona eliminada correctamente.');
        header('Location: ' . $this->baseFolder . '/persons');
    }

    public function apiList() {
        $persons = $this->personService->getAllPersons();
        Response::json(['status' => 'success', 'data' => $persons]);
    }
}
