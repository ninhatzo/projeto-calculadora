<?php

    // Programação estruturada: cada operação é implementada em função separada.
    // Recebe via POST: valor1, valor2 e operacao

    // Funções de operação (cada uma recebe dois números e retorna o resultado)
    function somar ($a, $b) {
        return $a + $b;
    }

    function subtrair($a, $b) {
        return $a - $b;
    }

    function multiplicar($a, $b) {
        return $a * $b;
    }

    function dividir($a, $b) {
        if($b == 0) {
            return null; // Sinaliza erro
        }
        return $a / $b;
    }

    // Função utilitária: limpa/normaliza entrada
    // limpa e valida o valor digitado pelo usuário, permitindo números com vírgula ou ponto e ignorando espaços.
    function parse_num($val) {
    // Remove espaços
        $s = trim($val);
    // Troca vírgulas por ponto (aceitas 0,0)
        $s= str_replace(",",".", $s);
    // Remover qualquer caracter que não seja dígito, sinal ou ponto - assim mantemos simples
    // Importante: para fins didáticos - em produção, use validação mais robusta
        if (!preg_match('/^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/', $s)) {
            return null;
        }
        return floatval($s);
    }

    // Recepção dos dados

    $valor1 = $_POST['valor1'] ?? '';
    $valor2 = $_POST['valor2'] ?? '';
    $operacao = $_POST['operacao'] ?? '';

    $val1 = parse_num($valor1);
    $val2 = parse_num($valor2);

    $result = null;
    $error = null;

    if ($val1 === null || $val2 === null) { // Checa se os números são válidos
        $error = 'Entrada inválida. Certifique-se de informar números válidos.';
        } else { // Faz o cálculo com a função correspondente
            switch ($operacao) {
                case 'somar':
                    $result = somar($val1, $val2);
                break;
                
                case 'subtrair':
                    $result = subtrair($val1, $val2);
                break;

                case 'multiplicar':
                    $result = multiplicar($val1, $val2);
                break;

                case 'dividir':
                    if ($val2 == 0) { // Detecta divisão por zero
                        $error = 'Divisão por zero não permitida.';
                    } else {
                        $result = dividir($val1, $val2);
                    }
                break;
                
                default:
                $error = 'Operação desconhecida'; // Gera uma mensagem de erro se algo der errado
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Calculadora</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <main class="container">
        <h1>
            Resultado
        </h1>

        <?php if($error !== null): ?>
            <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php else: ?> <!-- Quando você quer escrever HTML junto com PHP, as chaves podem atrapalhar a legibilidade -->
                       <!-- Por isso o PHP oferece uma sintaxe alternativa usando “:” e palavras de fechamento da estrutura if(), como endif -->
            <p>Operação: <strong><?php echo htmlspecialchars($operacao); ?></strong></p>
            <p><?php echo htmlspecialchars($val1); ?>
               <?php 
                switch ($operacao) {
                    case 'somar': echo '+'; break;
                    case 'subtrair': echo '-'; break;
                    case 'multiplicar': echo 'x'; break;
                    case 'dividir': echo '/'; break;
                }
               ?>
               <!-- htmlspecialchars() é usado para evitar ataques XSS (segurança) -->
               <?php echo htmlspecialchars($val2); ?> =
               <strong><?php echo htmlspecialchars($result); ?></strong>
            </p>
            <?php endif; ?>

            <!-- voltar -->
            <p><a href="../../index.html">Voltar</a></p>
    </main>
</body>
</html>