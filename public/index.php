<?php

require_once __DIR__ . '/../app/core/Autoload.php';
require_once __DIR__ . '/../app/config/Config.php';

use app\core\Router;

$router = new Router();

// Página inicial
$router->get('/', 'OngController@index');

// Rotas de ONGs
$router->get('/ongs', 'OngController@index'); // Público (Listar)
$router->get('/ongs/ver', 'OngController@ver'); // Público (Detalhes)

$router->get('/ongs/cadastrar', 'OngController@cadastrar'); // Restrito
$router->post('/ongs/salvar', 'OngController@salvar'); // Restrito
$router->get('/ongs/editar', 'OngController@editar'); // Restrito
$router->post('/ongs/atualizar', 'OngController@atualizar'); // Restrito
$router->get('/ongs/excluir', 'OngController@excluir'); // Restrito

// Autenticação
$router->get('/login', 'AutenticacaoController@login');
$router->post('/logar', 'AutenticacaoController@logar');
$router->get('/logout', 'AutenticacaoController@logout');

// Usuários (do projeto base)
$router->get('/usuarios', 'UsuarioController@index');
$router->get('/usuarios/cadastrar', 'UsuarioController@cadastrar');
$router->post('/usuarios/salvar', 'UsuarioController@salvar');
$router->get('/usuarios/editar', 'UsuarioController@editar');
$router->post('/usuarios/atualizar', 'UsuarioController@atualizar');
$router->get('/usuarios/excluir', 'UsuarioController@excluir');

$router->run();
