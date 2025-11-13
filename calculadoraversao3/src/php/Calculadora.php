<?php

    // --- CLASS: Calculadora (métodos estáticos) ---

    final class Calculadora {
        // Métod estático Soma
        public function somar(float $a, float $b) : float {
            return $a + $b;
        }
        // Método etático Subtração
        public function subtrair(float $a, float $b) : float {
            return $a - $b;
        }

        // Método estático Multiplicação
        public function multiplicar(float $a, float $b) : float {
            return $a * $b;
        }
        // Método estático Divisão com checagem de divisão por zero
        public function dividir(float $a, float $b) : float {
            if ($b == 0.0) {
                // Retornar string com erro para manter tipo informativo
                return 'Erro: divisão por zero';
            } else {
                return $a / $b;
            }
        }
    } // Fechando a classe estática Calculadora
?>