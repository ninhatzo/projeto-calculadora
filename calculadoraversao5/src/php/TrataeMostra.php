<?php

    final class TrataeMostra {

        // Exibir resultado - deve ser método estático conforme solicitado.
        // Recebe o resultado (float|string) e retorna um HTML seguro.

        public static function exibirResultado(?string $er, string $oper, ?float $v1, ?float $v2, ?float $resultado) {

            echo '<h1>Resultado</h1>';

            if(!empty($er)) {
                echo '<p class="error">' . htmlspecialchars($er, ENT_QUOTES,'UTF-8') . '</p>';
            } else {
                    echo '<p>Operação:<strong>' . htmlspecialchars($oper, ENT_QUOTES,'UTF-8') . '</strong></p>';
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

            echo '<p><a href="../../index.html">Voltar</a></p>';
 
        }

        // Método estático que limpa/valida os dados de entrada
        public static function parse_num($val) : ?float {
            // Remove espaços
            $s = trim($val);
            // Troca vírgula por ponto (aceita 1,5)
            $s = str_replace(',', '.', $s);
            // Remover qualquer caractere que não seja dígito, sinal, ou ponto - assim mantemos entrada simples
            // importante: para fins didáticos - em produção, use validação mais robusta
            if(!preg_match('/^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/', $s)) {
                return null;
            }
            return floatval($s);
        }
    }
?>