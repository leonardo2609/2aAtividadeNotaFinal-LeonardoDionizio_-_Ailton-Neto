<?php
    try {
        $conn = new PDO('sqlite:atribuicao.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS tarefas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo text not null,
            data_vencimento date not null,
            descricao text not null,
            status text DEFAULT 'pendente' not null
        )";

        $conn->exec($sql);
    } catch (PDOException $e) {
        die("Erro na conexão ao banco de dados: " . $e->getMessage());
    }
?>