<?php
    
   abstract class Veiculos {
    // Atributos protegidos
    protected string $modelo;
    protected string $cor;

    // Getter e Setter para modelo
    public function getModelo(): string {
        return $this->modelo;
    }

    public function setModelo(string $modelo): void {
        $this->modelo = $modelo;
    }

    // Getter e Setter para cor
    public function getCor(): string {
        return $this->cor;
    }

    public function setCor(string $cor): void {
        $this->cor = $cor;
    }
   }
?>