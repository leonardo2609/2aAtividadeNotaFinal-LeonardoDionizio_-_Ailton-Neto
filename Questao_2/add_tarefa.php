<?php
require 'database.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim($_POST['titulo']);
        $data = trim($_POST['data']);
        $descricao = trim($_POST['descricao_popup']);

        if (empty($titulo) || empty($data) || empty($descricao)) {
            throw new Exception("Todos os campos são obrigatórios.");
        }

        $stmt = $conn->prepare("INSERT INTO tarefas (titulo, data_vencimento, descricao, status) VALUES (:titulo, :data, :descricao, 'pendente')");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();

        header("Location: index.php?mensagem=success");
        exit;
    } else {
        throw new Exception("Método HTTP inválido.");
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>