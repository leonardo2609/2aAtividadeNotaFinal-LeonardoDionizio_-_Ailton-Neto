<?php
require 'database.php';
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim($_POST['titulo'] ?? '');

        if (empty($titulo)) {
            echo json_encode(['success' => false, 'message' => 'O título da tarefa não foi informado.']);
            exit;
        }

        // Prepara e executa a consulta SQL
        $sql = "DELETE FROM tarefas WHERE titulo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Tarefa deletada com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada ou já deletada.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>
