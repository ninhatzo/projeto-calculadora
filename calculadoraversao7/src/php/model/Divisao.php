<?php
final class Divisao extends Operacoes {

    public function calcula(): float {
        if ($this->num2 == 0.0) {
            return 'Erro: divisão por zero';
        }
        return $this->num1 / $this->num2;
    }
}
?>
