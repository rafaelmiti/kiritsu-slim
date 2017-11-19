<?php

namespace Kiritsu\Agenda\Infrastructure\Repository;

use Kiritsu\Agenda\Domain\Entity\Agenda;

interface RepositoryStrategy
{
    public function create(Agenda $agenda): int;
    public function read(int $id): Agenda;
    public function update(Agenda $agenda);
    public function delete(Agenda $agenda);
    public function listAll(): array;
}
