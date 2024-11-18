<?php
include 'database.php';

try {
    // Consulta para obter todos os livros
    $query = "SELECT id, titulo, autor, ano_publicacao FROM livros";
    $stmt = $conn->query($query);

    // Busca os dados e os retorna como JSON
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($livros);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>