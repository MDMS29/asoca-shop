<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/usuarios', 'Usuarios::index');

$routes->post('/login', 'Usuarios::login');
$routes->post('/salir', 'Usuarios::salir');
$routes->post('/insertUsuario', 'Usuarios::insertar');
$routes->post('/obtenerUsuarios', 'Usuarios::obtenerUsuarios');
$routes->post('/buscarUsuario/(:num)/(:num)', 'Usuarios::buscarUsuario/$1/$2');
$routes->post('/camEstUsuario', 'Usuarios::cambiarEstado');
$routes->post('/camContraUser', 'Usuarios::cambiarContrasena');

$routes->get('/usuarios-eliminados', 'Usuarios::eliminados');

$routes->get('/clientes', 'Clientes::index');

$routes->post('/obtenerClientes', 'Clientes::obtenerClientes');

$routes->post('/insertarTelefono', 'Telefonos::insertar');
$routes->post('/obtenerTelefonosUser/(:num)', 'Telefonos::obtenerTelefonosUser/$1');
$routes->post('/buscarTelefono/(:num)/(:num)', 'Telefonos::buscarTelefono/$1/$2');
$routes->post('/eliminarTelefono/(:num)', 'Telefonos::eliminarTelefono/$1');

$routes->post('/insertarCorreo', 'Email::insertar');
$routes->post('/obtenerEmailUser/(:num)', 'Email::obtenerEmailUser/$1');
$routes->post('/buscarEmail/(:any)/(:num)', 'Email::buscarEmail/$1/$2');
$routes->post('/eliminarEmail/(:num)', 'Email::eliminarEmail/$1');

$routes->get('/admin-productos', 'Productos::adminProductos');
$routes->post('/obtenerProductos', 'Productos::obtenerProductos');
$routes->post('/buscarProducto', 'Productos::buscarProducto');
$routes->post('/insertarProducto', 'Productos::insertar');
$routes->post('/camEstProducto', 'Productos::cambiarEstado');

$routes->get('/admin-productos-eliminados', 'Productos::adminProductosEliminados');
$routes->get('/detalles-producto/(:num)', 'Productos::verDetallesProducto/$1');

$routes->post('/urlImg', 'Productos::urlImg');
$routes->get('/imagenesProducto/(:any)', 'Productos::imagenesProducto/$1');

$routes->get('/detalles-compra', 'Compras::verDetallesCompra');
$routes->post('/confirCompra', 'Compras::insertar');

$routes->get('/compras-realizadas', 'Compras::verComprasRealizadas');
$routes->post('/obtenerComprasRealizadas', 'Compras::obtenerComprasRealizadas');
$routes->post('/detallesCompra', 'Compras::detallesCompra');
$routes->post('/cancelCompra', 'Compras::cancelCompra');
$routes->post('/actuaDetCompra', 'Compras::actuaDetCompra');

$routes->get('/admin-compras', 'Compras::administrarCompras');
$routes->post('/confirProduc', 'Compras::confirProduc');
$routes->post('/cambEstadoCompra', 'Compras::cambEstadoCompra');

$routes->post('/obtenerComentarios', 'Comentarios::obtenerComentarios');
$routes->post('/insertarComen', 'Comentarios::insertar');
$routes->post('/buscarComentario', 'Comentarios::buscarComentario');
$routes->post('/camEstComen', 'Comentarios::camEstComen');

$routes->get('/perfil/(:num)', 'Usuarios::perfil/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
