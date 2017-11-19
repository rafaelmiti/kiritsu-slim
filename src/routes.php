<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/agenda', function() use($app) {
    $app->get('/listar', 'Kiritsu\Agenda\Application\Controller\AgendaController:getListar');
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->renderer->render($response, 'index.phtml', $args);
});
