<?php

    // --- CLASS: Calculadora (métodos estáticos) ---

    final class Calculadora {

        // Exibir resultado = deve ser método estático conforme solicitado.
        // Recebe o resultado (float|string) e retorna um HTML seguro.

        public static function exibirResultado(?string $er,string $oper, ?float $v1, ?float $v2, ?float $resultado) {
        
            if (!empty($er)) {
                echo '<p class="error">' . htmlspecialchars($er, ENT_QUOTES, 'UTF-8') . '</p>';
            } else {
                echo '<p>Operação: <strong>' . htmlspecialchars($oper, ENT_QUOTES, 'UTF-8') . '</strong></p>';
                echo '<p>' . htmlspecialchars($v1, ENT_QUOTES, 'UTF-8') . ' ';

                switch($oper) {
                    case 'somar':
                        echo '+';
                    break;
                    case 'subtrair':
                        echo '-';
                    break;
                    case 'multiplicar':
                        echo 'x';
                    break;
                    case 'dividir':
                        echo '/';
                    break;
                }

                echo ' ' . htmlspecialchars($v2, ENT_QUOTES, 'UTF-8');
                echo ' = <strong>' . htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') . '</strong></p>';
            }

            echo '<p><a href="../../index.html"">Voltar</a></p>';
        }

        // Método estático que limpa/valida os dados de entrada
        public static function parse_num($val) : ?float {
            // Remove espaços
            $s = trim($val);
            // Troca vírgula por ponto (aceita 1,5)
            $s = trim($val);
            // Remover qualquer caracere que não seja dígito, sinal, ou ponto - assim mantemos entrada simples
            // Importante: para fins didáticos - em produção, use validação mais robusta
            if(!preg_match('/^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/', $s)) {
                return null;
            }
            return floatval($s);
        }

        // Método estático Soma
        public static function somar (float $a, float $b) : float {
            return $a + $b;
        }
        // Método estático subtração
        public static function subtrair (float $a, float $b) : float {
            return $a - $b;
        }
        // Método estático multiplicação
        public static function multiplicar (float $a, float $b) : float {
            return $a * $b;
        }
        // Método estático Divisão com chegagem de divisão por zero
        public static function dividir (float $a, float $b) {
            if ($b === 0.0) {
                // Retornamos string com erro para manter tipo informativo
                return "Erro: divisão por zero";
            }
            return $a / $b;
        }

    } // Fechando a classe estática Calculadora

    // Nesse trecho de programa temos o programa principal da solução ou código de controle
    // este, por sua vez é responsável por receber dados, validar e exibir
    // o resultado

    // Recepção dos dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recebendo os valores e as operações
        $valor1 = $_POST['valor1'] ?? '';
        $valor2 = $_POST['valor2'] ?? '';
        $operacao = $_POST['operacao'] ?? '';

    // Converte e valida os números recebidos a partir da chamada do método estático parse_num()
    // que encontra-se na classe estática Calculadora
        $val1 = Calculadora::parse_num($valor1);
        $val2 = Calculadora::parse_num($valor2);

        $result = null;
        $error = null;

    // Verificar se há erro de entrada ou de operação
        if ($val1 === null || $val2 === null) {
            $error = 'Entrada inválida. Certifique-se de informar números válidos.';
        } else {
        // De acordo com a operação escolhida, executa a operação a partir da chamada
        // do método estático correspondente da operação que encontra-se na classe
        // estática Calculadora.
            switch ($operacao) {
                case 'somar':
                    $result = Calculadora::somar($val1, $val2); // O método somar da classe Calculadora 
                break;                                          // está passando as variváveis $val1 e $val2 como argumento
                case 'subtrair':
                    $result = Calculadora::subtrair($val1, $val2);
                break;
                case 'multiplicar':
                    $result = Calculadora::multiplicar($val1, $val2);
                break;
                case 'dividir':
                    if ($val2 == 0) {
                        $error = 'Divisão por zero não permitida';
                    } else {
                        $result = Calculadora::dividir($val1, $val2);
                           }
                break;
                default:
                    $error = 'Operação desconhecida';
            } // Finaliza o switch
        } // Finalisa o else

    // Exibir resultado chamando o método estático exibirResultado()
    // que encontra-se na classe estática Calculadora.
        Calculadora::exibirResultado($error, $operacao, $val1, $val2, $result);

    }
?>