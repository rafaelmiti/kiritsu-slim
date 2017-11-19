<?php

namespace Kiritsu\Agenda\Domain\Service;

use Kiritsu\Agenda\Domain\Repository\AgendaRepositoryInterface;

class Agenda
{
    private $repo;
    
    public function __construct(AgendaRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}
