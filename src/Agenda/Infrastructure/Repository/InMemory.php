<?php

namespace Kiritsu\Agenda\Infrastructure\Repository;

use Kiritsu\Agenda\Domain\Entity\Agenda;

class InMemory implements RepositoryStrategy
{
    private $id = 0;
    private $agendas = [];
    
    public function create(Agenda $agenda): int
    {
        $this->id++;
        $agenda->setId($this->id);
        $this->agendas[$this->id] = $agenda;
        
        return $this->id;
    }
    
    public function read(int $id): Agenda
    {
        $this->checkIdExistence($id);
        return $this->agendas[$id];
    }
    
    private function checkIdExistence(int $id)
    {
        if (!isset($this->agendas[$id])) {
            throw new \Exception("Não há registro para o id $id");
        }
    }
    
    public function update(Agenda $agenda)
    {
        $this->agendas[$agenda->getId()] = $agenda;
    }
    
    public function delete(Agenda $agenda)
    {
        unset($this->agendas[$agenda->getId()]);
    }
}
