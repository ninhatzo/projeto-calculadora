<?php
// Classe abstrata Aberturas (equivalente ao código Java)

abstract class Aberturas {
    // Atributos protegidos
    protected string $descricao;
    protected int $estado;

    // Getter e Setter para descricao
    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    // Getter e Setter para estado
    public function getEstado(): int {
        return $this->estado;
    }

    public function setEstado(int $estado): void {
        $this->estado = $estado;
    }

    // Métodos comportamentais
    public function abrir(): void {
        $this->estado = 1;
    }

    public function fechar(): void {
        $this->estado = 0;
    }

    public function getEstadoTexto(): string {
        return $this->estado === 1 ? "Aberta" : "Fechada";
    }
}
?>