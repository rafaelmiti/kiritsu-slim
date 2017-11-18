<?php

namespace Kiritsu\Agenda\Domain\Entity;

class Agenda
{
    private $id;
    private $categoria;
    private $atividade;
    private $data;
    private $periodico;
    private $historia;
    
    const CATEGORIA_LENGTH = 30;
    const ATIVIDADE_LENGTH = 1100;
    
    public function setId(int $id): Agenda
    {
        $this->checkIdScope($id);
        $this->id = $id;
        
        return $this;
    }
    
    private function checkIdScope(int $id)
    {
        $this->checkNaturalId($id);
        $this->checkNonZeroId($id);
    }
    
    private function checkNaturalId(int $id)
    {
        if ($id < 0) {
            throw new \Exception("O valor do id $id deveria ser do conjunto dos naturais");
        }
    }
    
    private function checkNonZeroId(int $id)
    {
        if ($id == 0) {
            throw new \Exception("O valor do id $id não pode ser zero");
        }
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setCategoria(string $categoria): Agenda
    {
        $this->checkCategoriaLength($categoria);
        $this->categoria = $categoria;
        
        return $this;
    }

    private function checkCategoriaLength(string $categoria)
    {
        $length = mb_strlen($categoria);
        
        if ($length > self::CATEGORIA_LENGTH) {
            throw new \Exception("O tamanho da categoria de $length caractéres é maior do que o máximo de ".self::CATEGORIA_LENGTH);
        }
    }
    
    public function getCategoria(): string
    {
        return $this->categoria;
    }
    
    public function setAtividade(string $atividade): Agenda
    {
        $this->checkAtividadeLength($atividade);
        $this->atividade = $atividade;
        
        return $this;
    }
    
    private function checkAtividadeLength(string $atividade)
    {
        $length = mb_strlen($atividade);
        
        if ($length > self::ATIVIDADE_LENGTH) {
            throw new \Exception("O tamanho da atividade de $length caractéres é maior do que o máximo de ".self::ATIVIDADE_LENGTH);
        }
    }
    
    public function getAtividade(): string
    {
        return $this->atividade;
    }
    
    public function setData(\DateTime $data): Agenda
    {
        $this->data = $data;
        return $this;
    }
    
    public function getData(): \DateTime
    {
        return $this->data;
    }
    
    public function setPeriodico(bool $periodico): Agenda
    {
        $this->periodico = $periodico;
        return $this;
    }
    
    public function getPeriodico(): bool
    {
        return $this->periodico;
    }
    
    public function setHistoria(bool $historia): Agenda
    {
        $this->historia = $historia;
        return $this;
    }
    
    public function getHistoria(): bool
    {
        return $this->historia;
    }
}
