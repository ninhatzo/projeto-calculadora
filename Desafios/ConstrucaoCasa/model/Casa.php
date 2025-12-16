<?php
require_once 'Aberturas.php';
require_once 'Porta.php';
require_once 'Janela.php';

class Casa {
    // Atributos privados
    private string $descricao;
    private string $cor;
    private array $listaDePortas = []; // Substitui ArrayList<Aberturas>
    private array $listaDeJanelas = []; // Substitui ArrayList<Aberturas>

    // Métodos getters e setters
    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function getCor(): string {
        return $this->cor;
    }

    public function setCor(string $cor): void {
        $this->cor = $cor;
    }

    public function getListaDePortas(): array {
        return $this->listaDePortas;
    }

    public function setListaDePortas(array $listaDePortas): void {
        $this->listaDePortas = $listaDePortas;
    }

    public function getListaDeJanelas(): array {
        return $this->listaDeJanelas;
    }

    public function setListaDeJanelas(array $listaDeJanelas): void {
        $this->listaDeJanelas = $listaDeJanelas;
    }

    // Retorna todas as aberturas (portas ou janelas)
    public function getAberturasPorTipo(string $tipo): array {
        if($tipo === 'porta') {
            return $this->listaDePortas;
        } else if($tipo === 'janela') {
            return $this->listaDeJanelas;
        } else {
            return [];
        }
    }

    // Retorna uma abertura específica pelo índice
    public function retornaAbertura(string $tipo, int $indice): ?Aberturas {
        $lista = $this->getAberturasPorTipo($tipo);
        return $lista[$indice] ?? null;
    }

    // Move (abre e fecha) uma abertura
    public function moverAbertura(Aberturas $abertura, int $novoEstado): void {
        $abertura->setEstado($novoEstado);
    }

    // Gera um resumo completo das informações da casa
    public function geraInfoCasa(): string {
        $info = "<h2>Informações da Casa</h2>";
        $info .= "<p><strong>Descrição:</strong> {$this->descricao}</p>";
        $info .= "<p><strong>Cor: </strong> {$this->cor}</p>";

        // Portas
        $info .= "<h3>Portas:</h3>";
        if (!empty($this->listaDePortas)) {
            foreach ($this->listaDePortas as $porta) {
                $estado = $porta->getEstadoTexto();
                $info .= "<p>{$porta->getDescricao()} - {$estado}</p>";
            }
        } else {
            $info .= "<p>Nenhuma Porta cadastrada.</p>";
        }

        // Janelas
        $info .= "<h3>Janelas:</h3>";
        if (!empty($this->listaDeJanelas)) {
            foreach ($this->listaDeJanelas as $janela) {
                $estado = $janela->getEstadoTexto();
                $info .= "<p>{$janela->getDescricao()} - {$estado}</p>";
            }
        } else {
            $info .= "<p>Nenhuma Janela cadastrada.</p>";
        }

        return $info;
    }
}
?>