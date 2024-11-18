<?php
try {
    include 'database.php'; // Inclui o arquivo de conexão com o banco

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtém o ID enviado pelo cliente
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;

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
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido.']);
        }
    } else {
        // Caso o método HTTP não seja POST
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido.']);
    }
} catch (PDOException $e) {
    // Retorna erro em JSON caso ocorra uma exceção
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
