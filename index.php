<?php

use App\Domains\Clientes\Controllers\ClienteController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->get('/', ClienteController::class . ':view');
$app->get('/cliente', ClienteController::class . ':view');
$app->post('/cliente/salvar', ClienteController::class . ':store');
$app->post('/cliente/atualizar', ClienteController::class . ':update');
$app->post('/cliente/lista/{idCliente}', ClienteController::class . ':show');
$app->delete('/cliente/remover/{idCliente}', ClienteController::class . ':destroy');

$app->run();