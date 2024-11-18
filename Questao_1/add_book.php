<?php
    try {
        include 'database.php'; // Inclui o arquivo de conexão com o banco
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebe os dados do formulário
            $titulo = $_POST['titulo'] ?? null;
            $autor = $_POST['autor'] ?? null;
            $ano = isset($_POST['ano']) ? intval($_POST['ano']) : null;

            // Prepara a query para inserir os dados
            $stm = $conn->prepare("INSERT INTO livros (titulo, autor, ano_publicacao) VALUES (?, ?, ?)");

            $stm->execute([$titulo, $autor, $ano]);

            // Retorna o último ID inserido e os dados em JSON
            $lastId = $conn->lastInsertId();
            echo json_encode([
                'id' => $lastId,
                'titulo' => $titulo,
                'autor' => $autor,
                'ano_publicacao' => $ano
            ]);
            exit;
        }
    } catch (PDOException $erro) {
        // Exibe mensagem de erro
        echo "Erro na operação: " . $erro->getMessage();
    }
?>