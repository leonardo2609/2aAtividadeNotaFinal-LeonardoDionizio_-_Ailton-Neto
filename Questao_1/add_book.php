<?php
    try {
        include 'database.php'; // Inclui o arquivo de conexão com o banco
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebe os dados do formulário
            $titulo = $_POST['titulo'] ?? null;
            $autor = $_POST['autor'] ?? null;
            $ano = isset($_POST['ano']) ? intval($_POST['ano']) : null;
    
            // Verifica se todos os campos foram preenchidos
            if ($titulo && $autor && $ano) {
                // Prepara a query para inserir os dados
                $stm = $conn->prepare(
                    "INSERT INTO livros (titulo, autor, ano_publicacao) VALUES (?, ?, ?)"
                );
    
                // Executa a query com os valores
                if ($stm->execute([$titulo, $autor, $ano])) {
                    echo "Livro cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o livro.";
                }
            } else {
                echo "Por favor, preencha todos os campos.";
            }
        }
    } catch (PDOException $erro) {
        // Exibe mensagem de erro
        echo "Erro na operação: " . $erro->getMessage();
    }
?>