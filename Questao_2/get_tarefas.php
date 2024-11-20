<?php
require 'database.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->query("SELECT titulo, data_vencimento, descricao, status FROM tarefas");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'tarefas' => array_map(function ($tarefa) {
            return [
                'titulo' => $tarefa['titulo'],
                'data_vencimento' => date('d/m/Y', strtotime($tarefa['data_vencimento'])),
                'descricao' => $tarefa['descricao'],
                'status' => $tarefa['status'] // Inclui o status no retorno
            ];
        }, $tarefas)
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao buscar tarefas: ' . $e->getMessage()
    ]);
}
?>
