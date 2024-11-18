<?php 
    try {
        // Conexão ao banco SQLite
        $conn = new PDO('sqlite:livraria.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Criação da tabela, caso ainda não exista
        $sql = "CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano_publicacao DATE NOT NULL
        )";
    
        // Executa a criação da tabela
        $conn->exec($sql);
    } catch (PDOException $e) {
        // Exibe erro, caso ocorra
        die("Erro na conexão ao banco de dados: " . $e->getMessage());
    }
?>