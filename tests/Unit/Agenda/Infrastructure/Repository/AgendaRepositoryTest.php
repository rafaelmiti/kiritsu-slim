<?php

use PHPUnit\Framework\TestCase;

use Kiritsu\Agenda\Domain\Entity\Agenda;

use Kiritsu\Agenda\Infrastructure\Repository\AgendaRepository;
use Kiritsu\Agenda\Infrastructure\Repository\InMemory;

class AgendaRepositoryTest extends TestCase
{
    private function buildAgenda(): Agenda
    {
        return (new Agenda)
            ->setCategoria('Música')
            ->setAtividade("Aprender a tocar It's my life do Bon Jovi")
            ->setData(new \DateTime('2017-05-21 16:09'))
            ->setPeriodico(false)
            ->setHistoria(false)
        ;
    }
    
    public function testCreate()
    {
        $agenda = $this->buildAgenda();
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);
        
        $this->assertSame('Música', $agenda->getCategoria());
    }
    
    public function testUpdate()
    {
        $agenda = $this->buildAgenda();
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);
        
        $agenda->setAtividade('Treinar dedilhado');
        $repo->update($agenda);
        $agenda = $repo->read($id);
        
        $this->assertSame('Treinar dedilhado', $agenda->getAtividade());
    }
    
    public function testDelete()
    {
        $agenda = $this->buildAgenda();
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);

        $this->expectException('\Exception');
        $this->expectExceptionMessage("Não há registro para o id $id");
        
        $repo->delete($agenda);
        $agenda = $repo->read($id);
    }
}
