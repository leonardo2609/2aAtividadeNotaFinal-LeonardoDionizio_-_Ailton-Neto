<?php
require 'database.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? null;

        if (!$titulo) {
            throw new Exception("Título não fornecido.");
        }

        $stmt = $conn->prepare("UPDATE tarefas SET status = 'concluida' WHERE titulo = :titulo");
        $stmt->bindParam(':titulo', $titulo);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso.']);
        } else {
            throw new Exception("Erro ao atualizar o status no banco de dados.");
        }
    } else {
        throw new Exception("Método HTTP inválido.");
    }
} catch (Exception $e) {
    // Exibe os erros no log para debugging
    error_log("Erro no update_status.php: " . $e->getMessage());

    // Retorna o erro em formato JSON
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
