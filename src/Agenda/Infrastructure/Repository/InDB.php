<?php

namespace Kiritsu\Agenda\Infrastructure\Repository;

use Kiritsu\Agenda\Domain\Entity\Agenda;

class InDB implements RepositoryStrategy
{
    private $pdo;
    private $stmt;
    
    public function __construct(string $provider, string $host, string $name, string $charset, string $user, string $password)
    {
        $this->pdo = new \PDO("$provider:host=$host;dbname=$name;charset=$charset", $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function create(Agenda $agenda): int
    {
        
    }
    
    public function read(int $id): Agenda
    {
        
    }
    
    public function update(Agenda $agenda)
    {
        
    }
    
    public function delete(Agenda $agenda)
    {
        
    }
    
    public function listAll(): array
    {
        $this->stmt = $this->pdo->prepare('select * from agenda where historia = 0');
        $this->stmt->execute();
        
        $list = $this->fetchResult();
        
        return $list;
    }
    
    private function fetchResult(): array
    {
        while ($list[] = $this->stmt->fetch(\PDO::FETCH_ASSOC));
        return $list;
    }
    
    public function __destruct()
    {
        $this->pdo = null;
        $this->stmt = null;
    }
}
