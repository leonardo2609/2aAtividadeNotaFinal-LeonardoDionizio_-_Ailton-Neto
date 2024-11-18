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
                http_response_code(404);
                echo json_encode(['error' => 'Livro não encontrado.']);
            }
        } else {
            // Caso o ID não seja fornecido
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'ID inválido ou ausente.']);
        }
    } else {
        // Caso o método HTTP não seja POST
        http_response_code(405); // Envia um erro via http para o site
        echo json_encode(['error' => 'Método não permitido.']);
    }
} catch (PDOException $e) {
    // Retorna erro em JSON caso ocorra uma exceção
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>