<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-image: url(./src/image/background.jpg);
        }

        header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            margin: 10px 0;

            h1 {
                background-color: #F5F5DC;
                padding: 20px;
                border-radius: 10px;
            }
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .livros_cadastrados {
                margin-bottom: 20px;
                padding: 20px;
                border-radius: 20px;
                border: 1px solid #000000;

                background-color: #FAFAD2;

                h2 {
                    text-align: center;

                    margin-bottom: 10px;
                }
            }

            table {

                tr {
                    background-color: #F5F5DC;
                }

                /* Quando passar o mouse ele de um zoom na linha inteira */
                tr:not(.cabecalho_table):hover {
                    box-shadow: 0px 5px 10px #00000033;
                    transform: translateY(-5px);

                    background-color: #FFBF00;
                }

                th {
                    padding: 10px;
            
                    border: 1px solid #000000;
                    border-radius: 10px;
                }

                td {
                    padding: 10px;
                    max-width: 25%;

                    border: 1px solid #000000;
                    
                    border-radius: 10px; 
                }
            }

            .altera_tabela {
                display: flex;
                justify-content: center;
                align-items: center;

                padding: 20px;
                border-radius: 20px;
                border: 1px solid #000000;
            
                background-color: #FAFAD2;

                .cadastro {     
                    margin-right: 25px;
                    padding-right: 25px;

                    border-right: 1px dashed black;

                    h2 {
                        text-align: center;
                
                        margin-bottom: 5px;
                    }
                }

                .exclui {
                    
                    h2 {
                        text-align: center;
                
                        margin-bottom: 5px;
                    }  
                }
            }

            .formulario {
                label {
                    font-weight: bold;
                }

                input {
                    background-color: #F5F5DC;
                    border: 1px solid black;
                    border-radius: 5px;

                    margin: 0 0 10px;
                    padding: 10px;
                    width: 100%;
                    height: 30px;
                }

                button {
                    padding: 10px;
                    border: 1px solid black;
                    border-radius: 10px;

                    background-color: #FFBF00;
                    font-weight: bold;

                    cursor: pointer;
                }

                button:hover {
                    background-color: #FAFAD2;
                }

                p {
                    text-align: center;
                }
            }
        }

    </style>

    <title>2ª Atividade - Questão 1</title>
</head>
<body>
    <!-- Cabeçalho -->

    <header>

        <h1 class="titulo_principal">
            BANCO DE DADOS DA LIVRARIA
        </h1>

    </header>

    <!-- Corpo Principal -->

    <main>

        <!-- Seção de livros já cadastrados -->

        <div class="livros_cadastrados">

            <h2>
                Livros Cadastrados
            </h2>

            <table>
                <thead>
                    <tr class="cabecalho_table">
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Publicação</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php
                    require 'database.php'; // Inclui o arquivo de conexão

                    try {
                        // Consulta ao banco de dados
                        $query = "SELECT * FROM livros";
                        $stmt = $conn->query($query); // Executa a consulta

                        // Itera sobre os resultados
                        if ($stmt) {
                            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if (count($resultados) > 0) {
                                foreach ($resultados as $row) {
                                    echo "<tr>";
                                    echo "<td class='celula_tabela'>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td class='celula_tabela'>" . htmlspecialchars($row['titulo']) . "</td>";
                                    echo "<td class='celula_tabela'>" . htmlspecialchars($row['autor']) . "</td>";
                                    echo "<td class='celula_tabela'>" . htmlspecialchars($row['ano_publicacao']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Nenhum livro cadastrado</td></tr>";
                            }
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='4'>Erro ao consultar banco de dados: " . $e->getMessage() . "</td></tr>";
                    }
                    ?>
                    </tr>
                </tbody>
            </table>

        </div>

        <!-- Seção de cadastro de livros -->
        <section class="altera_tabela">

            <div class="cadastro">

                <h2>
                    Cadastre os livros aqui 👇
                </h2>
    
                <div class="formulario">

                    <form class="limpa_formulario" method="post" onsubmit="enviarFormulario(); return false;">
                        <label for="titulo">Título:</label> <br>
                        <input type="text" id="titulo" name="titulo" required> <br>
        
                        <label for="autor">Autor:</label> <br>
                        <input type="text" id="autor" name="autor" required> <br>
        
                        <label for="ano">Ano de Publicação:</label> <br>
                        <input type="number" id="ano" name="ano" required> <br>

                        <button type="submit" onclick="confirmacaoDeEnvio()">Inserir</button>
                    </form>
    
                </div>
    
            </div>

            <div class="exclui">

                <h2 class="titulo_exclui">
                    Exclua os livros aqui 👇
                </h2>

                <div class="formulario">

                    <form action="delete_book.php" method="post">
                        <label for="titulo_exclui">Digite o título do livro:</label> <br>
                        <input type="text" id="titulo_exclui" name="titulo_exclui" required> <br>

                        <button type="submit">Excluir</button>
                    </form>
    
                </div>

            </div>

        </section>

    </main>

    <script defer>

        main();

        function main() {
            definirTamanhoMaximoCelula();

            document.getElementById("limpa_formulario").addEventListener("submit", function() {
                limparFormulario();
            });
        }

        function definirTamanhoMaximoCelula() {

            // variáveis
            const celulas = document.getElementsByClassName('celula_tabela');
            const largura_da_tela = window.innerWidth; // Largura da tela do usuário
            const tamanho_maximo = largura_da_tela * 0.25; // Define o max-width em 25% da tela

            // Vai iterar em cada célula da linha
            for (let i = 0; i < celulas.length; i++) {
                celulas[i].style.maxWidth = tamanho_maximo + 'px'; // Define o tamanho máximo da celula em px
                celulas[i].style.wordWrap = 'break-word'; // Quebra a linha quanto atinge o tamanho máximo
            }
        }

        //Impede que quando enviar o formulário ele abra uma nova aba ou o arquivo "add_book.php"
        function enviarFormulario() {
            let xhr = new XMLHttpRequest(); // Cria um objeto para a requisição
            xhr.open('POST', 'add_book.php', true); // Configura o método como POST, para o arquivo php. Indicando também que a requisição é assincrona. Ou seja, o usuário pode continuar navegando no site enquanto o servidor envia a requisição.
            
            xhr.send(new FormData(document.getElementById('meuFormulario'))); // Envia os dados recebidos para o servidor

            location.reload();
        }

        function limpandoFormulario() {
            document.getElementsByClassName('limpa_formulario').reset();
        }

    </script>
</body>
</html>

<?php
    require 'database.php';
    require 'add_book.php';
    require 'delete_book.php';
?>