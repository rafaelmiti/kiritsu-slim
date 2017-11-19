<?php

namespace Kiritsu\Agenda\Infrastructure\Repository;

use Kiritsu\Agenda\Domain\Repository\AgendaRepositoryInterface;
use Kiritsu\Agenda\Domain\Entity\Agenda;

class AgendaRepository implements AgendaRepositoryInterface
{
    private $strategy;
    
    public function __construct(RepositoryStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
    
    public function create(Agenda $agenda): int
    {
        return $this->strategy->create($agenda);
    }

    public function read(int $id): Agenda
    {
        return $this->strategy->read($id);
    }
    
    public function update(Agenda $agenda)
    {
        $this->strategy->update($agenda);
    }
    
    public function delete(Agenda $agenda)
    {
        $this->strategy->delete($agenda);
    }
    
    public function listAll(): array
    {
        return $this->strategy->listAll();
    }
}
