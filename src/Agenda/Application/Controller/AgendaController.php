<?php
namespace Kiritsu\Agenda\Application\Controller;

use Kiritsu\Agenda\Infrastructure\Repository\InDB;
use Kiritsu\Agenda\Infrastructure\Repository\AgendaRepository;

use Slim\Http\Request;
use Slim\Http\Response;

class AgendaController
{
    private $c;
    private $s;

    public function __construct($container)
    {
        $this->c = $container;
        $this->s = $container->get('settings');
    }

    public function getListar(Request $request, Response $response, array $args): Response
    {
        try {
            $strategy = $this->buildInDBStrategy();
            $list = (new AgendaRepository($strategy))->listAll();
            
            return $response->withJson($list);
        } catch (\Exception $e) {
            $error = $this->buildErrorResponse($e->getMessage());
            return $response->withJson($error);
        }
    }
    
    private function buildInDBStrategy(): InDB
    {
        return new InDB(
            $this->s['db']['provider'],
            $this->s['db']['host'],
            $this->s['db']['name'],
            $this->s['db']['charset'],
            $this->s['db']['user'],
            $this->s['db']['password']
        );
    }
    
    private function buildErrorResponse(string $message): array
    {
        return ['error' => ['message' => $message]];
    }
}
