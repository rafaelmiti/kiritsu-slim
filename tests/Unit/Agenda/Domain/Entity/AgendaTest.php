<?php

use PHPUnit\Framework\TestCase;
use Kiritsu\Agenda\Domain\Entity\Agenda;

class AgendaTest extends TestCase
{
    private $agenda;
    
    protected function setUp()
    {
        $this->agenda = new Agenda;
    }

    public function testUnnaturalId()
    {
        $id = -1;
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("O valor do id $id deveria ser do conjunto dos naturais");
        
        $this->agenda->setId($id);
    }
    
    public function testZeroId()
    {
        $id = 0;
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("O valor do id $id não pode ser zero");
        
        $this->agenda->setId($id);
    }
    
    public function testCategoriaOverLimit()
    {
        $categoria = str_repeat('M', 31);
        $length = mb_strlen($categoria);
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("O tamanho da categoria de $length caractéres é maior do que o máximo de ".Agenda::CATEGORIA_LENGTH);
        
        $this->agenda->setCategoria($categoria);
    }
    
    public function testCategoriaLengthLimit()
    {
        $categoria = str_repeat('M', 30);
        $this->agenda->setCategoria($categoria);
        
        $this->assertSame($categoria, $this->agenda->getCategoria());
    }
    
    public function testAtividadeOverLimit()
    {
        $atividade = str_repeat('A', 1101);
        $length = mb_strlen($atividade);
        
        $this->expectException('\Exception');
        $this->expectExceptionMessage("O tamanho da atividade de $length caractéres é maior do que o máximo de ".Agenda::ATIVIDADE_LENGTH);
        
        $this->agenda->setAtividade($atividade);
    }
    
    public function testAtividadeLengthLimit()
    {
        $atividade = str_repeat('A', 1100);
        $this->agenda->setAtividade($atividade);
        
        $this->assertSame($atividade, $this->agenda->getAtividade());
    }
    
    public function testData()
    {
        $dataHora = new \DateTime('2017-05-21 15:27:08');
        $this->agenda->setData($dataHora);
        
        $this->assertSame('21/05/2017', $this->agenda->getData()->format('d/m/Y'));
    }
    
    public function testHora()
    {
        $dataHora = new \DateTime('2017-05-21 15:27:08');
        $this->agenda->setData($dataHora);
        
        $this->assertSame('15:27:08', $this->agenda->getData()->format('H:i:s'));
    }
    
    public function testPeriodico()
    {
        $this->agenda->setPeriodico(true);
        $this->assertTrue($this->agenda->getPeriodico());
    }
    
    public function testHistoria()
    {
        $this->agenda->setHistoria(false);
        $this->assertFalse($this->agenda->getHistoria());
    }
}
