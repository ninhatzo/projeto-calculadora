<?php
require_once 'Carro.php';

    class Fabrica {
        // Atributos protegidos
        private array $carros = [];

        public function fabricarCarro($modelo, $cor) {
            $carro = [
                'modelo' => $modelo,
                'cor' => $cor
            ];

            $this->carros[] = $carro;
        }

        public function venderCarro($modelo, $cor) {
            foreach($this->carros as $i => $carro) {

                if($carro['modelo'] === $modelo && $carro['cor'] === $cor) {
                    unset($this->carros[$i]);
                    $this->carros = array_values($this->carros);
                    return;
                }
             }
             echo "Carro $modelo ($cor) não encontrado no estoque.<br>";
        }
    }
?>