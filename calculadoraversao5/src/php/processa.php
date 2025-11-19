<?php
    // Descarrega o arquivo Soma.php e
    // TrataeMostra.php que, respectivamente,
    // contém as classes Soma e TrataeMostra
    // neste Script.

    require_once 'IOperacao.php';
    require_once 'Soma.php';
    require_once 'Subtracao.php';
    require_once 'Multiplicacao.php';
    require_once 'Divisao.php';
    require_once 'TrataeMostra.php';

    // Recepção de dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Recebendo os valores e a operação

        $valor1 = $_POST['valor1'] ?? '';
        $valor2 = $_POST['valor2'] ?? '';
        $operacao = $_POST['operacao'] ?? '';

        // Converte e valida os números recebidos a partir da chamada do método estático parse_num()
        // que encontra-se na classe estática Calculadora
        $val1 = TrataeMostra::parse_num($valor1);
        $val2 = TrataeMostra::parse_num($valor2);

        $result = null;
        $error = null;

        // Verifica se há erro de entrada ou de operação

        if($val1 === null || $val2 === null) {
            $error = 'Entrada inválida. Certifique-se de informar números válidos.';
        } else {
            // De acordo com a operação escolhida, executa a operação a partir da chamada
            // do método estático correspondente da operação que encontra-se na classe
            // estática Calculadora

            switch($operacao) {
                case 'somar':
                    $soma = new Soma();
                    $soma->setNum1($val1);
                    $soma->setNum2($val2);
                    $result = $soma->calcula();

                break; 
                case 'subtrair':
                    $subtracao = new Subtracao();
                    $subtracao->setNum1($val1);
                    $subtracao->setNum2($val2);
                    $result = $subtracao->calcula();
                break;
                case 'multiplicar':
                    $multiplicacao = new Multiplicacao();
                    $multiplicacao->setNum1($val1);
                    $multiplicacao->setNum2($val2);
                    $result = $multiplicacao->calcula();
                break;
                case 'dividir':
                    if($val2 == 0) {
                        $error = 'Divisão por zero não permitida';
                    } else {
                        $divisao = new Divisao();
                        $divisao->setNum1($val1);
                        $divisao->setNum2($val2);
                        $result = $divisao->calcula();
                    }
                break;
                default:
                $error = 'Operação desconhecida.';
            } // Finaliza o switch
        } // Finaliza o Else
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <main class="container">
        <?php
            // Exibir resultado chamando o método estático exibirResultado()
        // que encontra-se na classe estática Calculadora.
        TrataeMostra::exibirResultado($error,$operacao,$val1,$val2,$result);
        ?>
    </main>
    
</body>
</html>