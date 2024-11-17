<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $db->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->execute(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao excluir o livro.";
    }
}
?>