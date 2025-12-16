<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Fabrica de Carros</title>
</head>
<body>

<?php
session_start();
require_once '../model/Carro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    switch ($acao) {
        case 'fabricarCarro':

            echo "<div class='menu-container'>
                    <h2>Fabricando carros!</h2><br>

                    <form action='processa.php' method='POST'>
                        <input type='hidden' name='acao' value='salvar_fabricacao'>

                        <label><strong>Quantos carros deseja fabricar?</strong></label>
                        <input type='number' name='qtde_carros' required min='1'>
                        <button type='submit'>Avançar</button>
                    </form>
                  </div>";
        break;

        case 'salvar_fabricacao':
            $qtdeCarros = (int)($_POST['qtde_carros'] ?? 0);
            
            echo "<div class='container-esp'>";
            echo    "<form action='processa.php' method='POST'>";
            for($i = 1; $i <= $qtdeCarros; $i++) {
                echo "<div class='container-carros'>";
                echo    "<h2>Defina modelo e cor carro #{$i}</h2>";
                echo        "<input type='hidden' name='acao' value='finalizar_fabricacao'>";
                echo        "<div class='container-text'>";
                echo        "<br><label><strong>Modelo</strong></label>";
                echo        "<input type='text' name='metodo[]' required>";
                echo        "</div>";
                echo        "<div class='container-text'>";
                echo        "<label><strong>Cor:</strong></label>";
                echo        "<input type='text' name='cor[]' required>";
                echo        "</div>";
                echo "</div>";
        }
        echo "<button type='submit'>Continuar</button>";
        echo "</form>";
        echo "</div>";

        break;

        case 'finalizar_fabricacao':

            $modelos = $_POST['metodo'] ?? [];
            $cores   = $_POST['cor'] ?? [];
        
            if (empty($modelos) || empty($cores)) {
                echo "<div class='menu-container'>";
                echo "<h2>Erro: dados inválidos.</h2>";
                echo "</div>";
                exit;
            }
        
            // Recupera o estoque atual da sessão ou cria um array vazio
            $fabrica = isset($_SESSION['fabrica']) ? unserialize($_SESSION['fabrica']) : [];
        
            // Adiciona os novos carros ao estoque existente
            foreach ($modelos as $i => $modelo) {
                $carro = new Carro();
                $carro->setModelo($modelo);
                $carro->setCor($cores[$i] ?? '');
        
                $fabrica[] = $carro;
            }
        
            // Salva o estoque atualizado na sessão
            $_SESSION['fabrica'] = serialize($fabrica);
        
            echo "<div class='menu-container'>";
            echo "<h2>Carros cadastrados com sucesso!</h2><br>";
            echo "<a href='../view/index.html'>Voltar ao menu</a>";
            echo "</div>";
        
        break;

        case 'venderCarro':

            if (!isset($_SESSION['fabrica']) || empty($_SESSION['fabrica'])) {
                echo "<div class='menu-container'>";
                echo "<h2>Não há carros para vender!</h2>";
                echo "<a href='../view/index.html'>Voltar ao menu</a>";
                echo "</div>";
                break;
            }
        
            $fabrica = unserialize($_SESSION['fabrica']);
        
            echo "<div class='menu-container'>";
            echo "<form action='processa.php' method='POST'>";
            echo "<input type='hidden' name='acao' value='confirmar_venda'>";
            echo "<label><strong>Informe o modelo do carro:</strong></label>";
            echo "<input type='text' name='modelo' required>";
            echo "<label><strong>Informe a cor do carro:</strong></label>";
            echo "<input type='text' name='cor' required>";
            echo "<a href='../view/index.html'>Voltar ao menu</a>";
            echo "<button type='submit'>Vender carro</button>";
            echo "</form>";
        
            echo "</div>";
        break;
        
        case 'confirmar_venda':

            if (!isset($_SESSION['fabrica']) || empty($_SESSION['fabrica'])) {
                echo "<div class='menu-container'>";
                echo "<h2>Não há carros para vender!</h2>";
                echo "<a href='../view/index.html'>Voltar ao menu</a>";
                echo "</div>";
                break;
            }
        
            $modelo = $_POST['modelo'] ?? '';
            $cor    = $_POST['cor'] ?? '';
        
            $fabrica = unserialize($_SESSION['fabrica']);
            $vendido = false;
        
            foreach ($fabrica as $index => $carro) {
                if ($carro->getModelo() === $modelo && $carro->getCor() === $cor) {
                    unset($fabrica[$index]);
                    $vendido = true;
                    break;
                }
            }
        
            if ($vendido) {
                $_SESSION['fabrica'] = serialize(array_values($fabrica));
                echo "<div class='menu-container'>";
                echo "<h2>Carro vendido com sucesso!</h2>";
            } else {
                echo "<div class='menu-container'>";
                echo "<h2>Carro não encontrado!</h2>";
            }
        
            echo "<a href='../view/index.html'>Voltar ao menu</a>";
            echo "</div>";
        break;

        case 'confirmar_venda': // Mudando de 'carroVendido' para 'confirmar_venda'
            // Verifica se há carros na fábrica
            if (!isset($_SESSION['fabrica']) || empty($_SESSION['fabrica'])) {
                echo "<div class='menu-container'>";
                echo "<h2>Não há carros para vender!</h2>";
                echo "<a href='../view/index.html'>Voltar ao menu</a>";
                echo "</div>";
                break;
            }
            
            // Recupera o ID do carro a ser vendido
            $carroId = $_POST['carro_id'] ?? null;
        
            // Se não for fornecido um ID válido, exibe erro
            if ($carroId === null || !isset($_SESSION['fabrica'][$carroId])) {
                echo "<div class='menu-container'>";
                echo "<h2>Erro: Carro não encontrado!</h2>";
                echo "<a href='../view/index.html'>Voltar ao menu</a>";
                echo "</div>";
                break;
            }
        
            // Deserializa os carros da sessão
            $fabrica = unserialize($_SESSION['fabrica']);
        
            // Remove o carro selecionado
            unset($fabrica[$carroId]);
        
            // Reindexa o array para corrigir os índices
            $_SESSION['fabrica'] = serialize(array_values($fabrica));
        
            echo "<div class='menu-container'>";
            echo "<h2>Carro vendido com sucesso!</h2>";
            echo "<a href='../view/index.html'>Voltar ao menu</a>";
            echo "</div>";
        break;

        case 'visualizarEstoque':
            // Verifique se há carros na sessão
            if (!isset($_SESSION['fabrica']) || empty($_SESSION['fabrica'])) {
                echo "<div class='menu-container'>";
                echo "<h2>Não tem carros na fábrica ainda!</h2>";
                echo '<a href="../view/index.html">Voltar ao menu</a>';
                echo "</div>";
                break;
            }
        
            // Deserializa os carros salvos na sessão
            $fabrica = unserialize($_SESSION['fabrica']);
        
            // Exibe o estoque
            echo "<div class='menu-container'>";
            echo "<h2>Estoque de Carros</h2>";
        
            // Exibe todos os carros cadastrados
            foreach ($fabrica as $i => $carro) {
                echo "<p>Carro #" . ($i + 1) . ": ";
                echo "Modelo: " . $carro->getModelo() . " | ";
                echo "Cor: " . $carro->getCor() . "</p>";
            }
        
            echo "<a href='../view/index.html'>Voltar ao menu</a>";
            echo "</div>";
        break;

        case 'encerrarSessao':
            session_unset(); // Limpa variáveis da sessão
            session_destroy(); // encerra a sessão atual
            echo "<div class='menu-container'>";
            echo "<h2>Fábrica apagada!</h2>";
            echo '<a href="../view/index.html">Voltar ao menu inicial</a>';
            echo "</div>";
        break;
    }
}
?>

</body>
</html>