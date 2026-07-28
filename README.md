# LegoBox v5 - Micro-Framework PHP

**LegoBox v5 (`lb-min-5`)** es un micro-framework PHP ultraligero, rápido y modular diseñado para el desarrollo ágil de aplicaciones web. Esta versión 5 introduce una arquitectura moderna con motor de plantillas **Twig**, enrutamiento **FastRoute**, un mini-ORM seguro (**LbModel** con PDO), una **capa de Servicios**, **gestor de solicitudes `Request` con validación**, **respuestas API `Response`** y **mensajes flash de sesión**.

---

## Ventajas Principales

* **Ligero y ultrarrápido**: Consume menos de 4-6 MB de RAM por petición HTTP y no requiere compiladores pesados ni servidores Node.js.
* **Despliegue directo**: Funciona en cualquier hosting PHP 8 (cPanel, XAMPP, VPS) copiando los archivos.
* **Seguridad y orden**: Prepared Statements con PDO en LbModel, vistas desacopladas en Twig y capa de servicios.

---

## Novedades de la Versión 5

* **Motor de Plantillas Twig 3**: Plantillas HTML desacopladas en la carpeta `public/`.
* **Enrutador FastRoute**: URLs limpias y amigables (ej. `/persons`, `/person/1`) reemplazando los antiguos Query Strings (`?view=`).
* **Mini-ORM LbModel (PDO)**: Consultas preparadas contra inyección SQL con métodos integrados (`find()`, `all()`, `where()`, `save()`, `delete()`).
* **Capa de Servicios (`App\Service`)**: Separación clara de la lógica de negocio (`AuthService`, `PersonService`).
* **Objeto Request y Validación de Formularios**: Manejo limpio de datos de entrada `Request::post()`, `Request::get()` y validación ligera `Request::validate()`.
* **Helper de Respuestas API JSON (`Response::json()`)**: Construcción ultrarrápida de APIs RESTful.
* **Mensajes Flash en Sesión**: Notificaciones informativas de un solo uso entre redirecciones (`Session::flash()`).
* **Autoloading PSR-4**: Carga automática mediante Composer estándar.

---

## Requisitos del Sistema

* **PHP**: `>= 8.0`
* **Servidor Web**: Apache con módulo `mod_rewrite` habilitado (XAMPP, WampServer, Laragon o Linux/cPanel).
* **Base de Datos**: MySQL `>= 5.7` o MariaDB `>= 10.4`
* **Composer**: `>= 2.0`

---

## Instalación y Configuración

### 1. Ubicación del Proyecto
Descarga o clona este repositorio dentro del directorio raíz de tu servidor web (por ejemplo `C:\xampp\htdocs\lb-min-5`).

### 2. Base de Datos
Importa el archivo `schema.sql` en tu gestor de base de datos MySQL (phpMyAdmin o CLI):

```bash
mysql -u root -p < schema.sql
```

### 3. Configurar Conexión a la BD
Asegúrate de configurar tus credenciales en `core/controller/Database.php`:

```php
function __construct(){
    $this->user = "root";
    $this->pass = "";
    $this->host = "localhost";
    $this->ddbb = "lbmin5"; // Nombre de tu BD
}
```

### 4. Instalar Dependencias de Composer
Abre una terminal en la raíz del proyecto y ejecuta:

```bash
composer install
```

---

## Estructura del Proyecto

```text
lb-min-5/
├── .htaccess                   # Reescritura de URLs para Apache (Front Controller)
├── composer.json               # Configuración de dependencias y PSR-4 Autoload
├── index.php                   # Front Controller y definición de rutas (FastRoute)
├── public/                     # Vistas Twig y Assets estáticos
│   ├── layouts/
│   │   └── main.html.twig      # Plantilla principal heredable (renderiza alertas flash)
│   ├── auth/
│   │   └── login.html.twig
│   └── persons/                # Plantillas del módulo de personas
│       ├── index.html.twig
│       ├── new.html.twig
│       ├── edit.html.twig
│       └── show.html.twig
├── core/
│   ├── autoload.php            # Carga de controladores base y autoloader de modelos
│   ├── controller/
│   │   ├── Database.php        # Conexión MySQLi y PDO
│   │   ├── LbModel.php         # Mini-ORM Base (PDO Prepared Statements)
│   │   ├── Request.php         # Objeto de solicitud HTTP y validación de formularios
│   │   ├── Response.php        # Helper para respuestas JSON / REST API
│   │   ├── Session.php         # Gestor de sesión y mensajes flash
│   │   └── ViewEngine.php      # Helper / Wrapper de Twig Engine
│   └── app/
│       ├── model/              # Modelos de datos (UserData, PersonData, etc.)
│       └── service/            # Servicios de Lógica de Negocio (App\Service)
```

---

## Uso de Request y Validación

Puedes acceder a los datos de entrada y validarlos de forma sencilla:

```php
// Obtener campos sanitizados
$name = Request::post('name');

// Validar reglas requeridas o tipo email
$errors = Request::validate([
    'name' => 'required',
    'email' => 'required|email'
]);

if (!empty($errors)) {
    Session::flash('error', implode(' ', $errors));
    header('Location: /person/new');
    exit;
}
```

---

## Uso de Respuestas JSON / API REST (`Response::json()`)

Para construir APIs REST o responder a llamadas AJAX en JavaScript:

```php
// Devuelve una respuesta JSON con código de estado HTTP 200
Response::json([
    'status' => 'success',
    'data' => $persons
]);

// O especificar código de error
Response::json(['error' => 'No autorizado'], 401);
```

---

## Uso de Mensajes Flash

Puedes enviar notificaciones temporales al usuario entre redirecciones utilizando `Session::flash($tipo, $mensaje)`:

```php
// En un servicio o controlador
Session::flash('success', 'Registro creado con éxito.');
Session::flash('error', 'Ocurrió un error al procesar.');
Session::flash('info', 'Sesión cerrada correctamente.');
```

La plantilla base `public/layouts/main.html.twig` mostrará automáticamente las alertas dinámicas en Bootstrap.

---

## Guía Paso a Paso: Cómo Crear un CRUD Básico

A continuación se explica cómo crear un nuevo módulo (ejemplo: **Productos**).

### Paso 1: Crear el Modelo (`core/app/model/ProductData.php`)
Crea la clase del modelo heredando de `LbModel`:

```php
<?php

class ProductData extends LbModel {
    public static $tablename = "product";

    public $id, $name, $price, $stock, $created_at;
}
```

### Paso 2: Crear el Servicio (`core/app/service/ProductService.php`)
Encapsula la lógica de negocio del módulo:

```php
<?php
namespace App\Service;

class ProductService {
    public function getAllProducts(): array {
        return \ProductData::all();
    }

    public function getProductById(int $id) {
        return \ProductData::find($id);
    }

    public function createProduct(array $data): bool {
        $product = new \ProductData();
        $product->name = $data['name'] ?? '';
        $product->price = $data['price'] ?? 0;
        $product->stock = $data['stock'] ?? 0;
        return $product->save();
    }

    public function deleteProduct(int $id): bool {
        $product = \ProductData::find($id);
        return $product ? $product->delete() : false;
    }
}
```

### Paso 3: Registrar las Rutas en `index.php`
Agrega las rutas del nuevo módulo en el `simpleDispatcher` de `index.php`:

```php
// Rutas de Productos
$r->addRoute('GET', '/products', 'list_products');
$r->addRoute('GET', '/product/new', 'show_new_product');
$r->addRoute('POST', '/product/create', 'process_create_product');

// En el switch de handlers:
case 'list_products':
    $productService = new \App\Service\ProductService();
    $products = $productService->getAllProducts();
    ViewEngine::render('products/index.html.twig', ['products' => $products]);
    break;

case 'process_create_product':
    $errors = Request::validate(['name' => 'required']);
    if (!empty($errors)) {
        Session::flash('error', implode(' ', $errors));
        header('Location: ' . $baseFolder . '/product/new');
        exit;
    }
    $productService = new \App\Service\ProductService();
    $productService->createProduct(Request::post());
    Session::flash('success', 'Producto creado exitosamente.');
    header('Location: ' . $baseFolder . '/products');
    break;
```

### Paso 4: Crear la Vista Twig (`public/products/index.html.twig`)
Crea la plantilla extendiendo de `layouts/main.html.twig`:

```twig
{% extends "layouts/main.html.twig" %}

{% block title %}Listado de Productos{% endblock %}

{% block content %}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-primary font-weight-bold">Productos</h4>
        <a href="{{ base_url }}/product/new" class="btn btn-success">+ Nuevo Producto</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
            {% for product in products %}
                <tr>
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>${{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                </tr>
            {% else %}
                <tr><td colspan="4" class="text-center py-3">No hay productos.</td></tr>
            {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}
```

---

## Créditos e Historia

* **Creador y Desarrollador**: **Evilnapsis**  
* **Sitio Web**: [http://evilnapsis.com](http://evilnapsis.com)

### Cronología de Versiones
* **v1**: 2016
* **v2**: 2017
* **v3**: 2019
* **v4**: 2021
* **v5**: 2026
