<?php
try {
    include 'database.php'; // Inclui o arquivo de conexão com o banco

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica se a requisição HTTP é do tipo POST
        // Obtém o ID enviado pelo cliente
        $id = isset($_POST['id']) ? intval($_POST['id']) : null; // Verifica se o "id" existe no array POST, recebido pela requisição HTTP. Depois converte o dado convertido em um número inteiro. Caso não existe nenhum dado a variável recebera o valor NULL

        if ($id) {
            // Prepara a query para excluir o registro
            $stm = $conn->prepare("DELETE FROM livros WHERE id = ?");
            $stm->execute([$id]);

            if ($stm->rowCount() > 0) {
                // Retorna uma resposta de sucesso
                echo json_encode(['success' => true, 'id' => $id]);
            } else {
                // Caso o ID não exista
                echo json_encode(['error' => 'Livro não encontrado.']);
            }
        } else {
            // Caso o ID não seja fornecido
            echo json_encode(['error' => 'ID inválido ou ausente.']);
        }
    } else {
        // Caso o método HTTP não seja POST
        echo json_encode(['error' => 'Método não permitido.']);
    }
} catch (PDOException $e) {
    // Retorna erro em JSON caso ocorra uma exceção
    echo json_encode(['error' => $e->getMessage()]);
}
?>