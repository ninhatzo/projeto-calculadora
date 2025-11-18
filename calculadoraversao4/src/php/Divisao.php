<?php
final class Divisao {

    private float $num1;
    private float $num2;

    public function getNum1(): float {
        return $this->num1;
    }

    public function setNum1(float $num1): void {
        $this->num1 = $num1;
    }

    public function getNum2(): float {
        return $this->num2;
    }

    public function setNum2(float $num2): void {
        $this->num2 = $num2;
    }

    public function calculaDivisao() {
        if ($this->num2 == 0.0) {
            return 'Erro: divisão por zero';
        }
        return $this->num1 / $this->num2;
    }
}
?>
