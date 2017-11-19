<?php

use PHPUnit\Framework\TestCase;

use Kiritsu\Agenda\Domain\Entity\Agenda;

use Kiritsu\Agenda\Infrastructure\Repository\AgendaRepository;
use Kiritsu\Agenda\Infrastructure\Repository\InMemory;

class AgendaRepositoryTest extends TestCase
{
    private function buildAgenda(string $categoria, string $atividade): Agenda
    {
        return (new Agenda)
            ->setCategoria($categoria)
            ->setAtividade($atividade)
            ->setData(new \DateTime('2017-05-21 16:09'))
            ->setPeriodico(false)
            ->setHistoria(false)
        ;
    }
    
    public function testCreate()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);
        
        $this->assertSame('Música', $agenda->getCategoria());
    }
    
    public function testReadInexistentId()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $repo->create($agenda);
        
        $fakeId = 999;
        $agenda->setId($fakeId);
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("Não há registro para o id $fakeId");
        
        $repo->read($fakeId);
    }
    
    public function testUpdate()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);
        
        $agenda->setAtividade('Treinar dedilhado');
        $repo->update($agenda);
        $agenda = $repo->read($id);
        
        $this->assertSame('Treinar dedilhado', $agenda->getAtividade());
    }
    
    public function testUpdateInexistentId()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);
        
        $fakeId = 998;
        $agenda->setId($fakeId);
        $agenda->setAtividade('Treinar dedilhado');
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("Não há registro para o id $fakeId");
        
        $repo->update($agenda);
    }
    
    public function testDelete()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);

        $this->expectException('\Exception');
        $this->expectExceptionMessage("Não há registro para o id $id");
        
        $repo->delete($agenda);
        $agenda = $repo->read($id);
    }
    
    public function testDeleteInexistentId()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $id = $repo->create($agenda);
        $agenda = $repo->read($id);

        $fakeId = 997;
        $agenda->setId($fakeId);
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("Não há registro para o id $fakeId");
        
        $repo->delete($agenda);
    }
    
    public function testListAll()
    {
        $agenda = $this->buildAgenda('Música', "Aprender a tocar It's my life do Bon Jovi");
        $agenda2 = $this->buildAgenda('Parkour', "Treinar climb-up");
        
        $strategy = new InMemory;
        $repo = new AgendaRepository($strategy);
        
        $repo->create($agenda);
        $repo->create($agenda2);
        
        $list = $repo->listAll();
        
        $this->assertCount(2, $list);
        $this->assertSame('Música', $list[1]->getCategoria());
        $this->assertSame('Parkour', $list[2]->getCategoria());
    }
}
