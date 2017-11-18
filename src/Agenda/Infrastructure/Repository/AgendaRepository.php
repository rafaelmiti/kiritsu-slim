<?php

namespace Kiritsu\Agenda\Infrastructure\Repository;

use Kiritsu\Agenda\Domain\Entity\Agenda;

class AgendaRepository
{
    private $repo;
    
    public function __construct(RepositoryStrategy $repo)
    {
        $this->repo = $repo;
    }
    
    public function create(Agenda $agenda): int
    {
        return $this->repo->create($agenda);
    }

    public function read(int $id): Agenda
    {
        return $this->repo->read($id);
    }
    
    public function update(Agenda $agenda)
    {
        $this->repo->update($agenda);
    }
    
    public function delete(Agenda $agenda)
    {
        $this->repo->delete($agenda);
    }
}
