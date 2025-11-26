<?php
    // extends na declaração da classe significa
    // que esta classe está em uma relação de herança
    // com a classe Operacoes, no caso, a classe soma
    // é a classe filha de Operacoes a classe mãe.
    final class Soma extends Operacoes {

        // Método que faz o cálculo da soma dos valores
        // armazenados nos atributos $num1 e $num2
        public function calcula(): float {
            return $this->num1 + $this->num2;
        }
    }
?>