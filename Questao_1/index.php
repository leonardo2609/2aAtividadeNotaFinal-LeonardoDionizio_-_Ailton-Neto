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
                
                <tbody id="corpo_tabela">
                
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

                    <form id="form_cadastro" method="post" onsubmit="enviarFormulario(); return false;">
                        <label for="titulo">Título:</label> <br>
                        <input type="text" id="titulo" name="titulo" required> <br>
        
                        <label for="autor">Autor:</label> <br>
                        <input type="text" id="autor" name="autor" required> <br>
        
                        <label for="ano">Ano de Publicação:</label> <br>
                        <input type="number" id="ano" name="ano" required> <br>

                        <button type="submit">Inserir</button>
                    </form>
    
                </div>
    
            </div>

            <div class="exclui">

                <h2 class="titulo_exclui">
                    Exclua os livros aqui 👇
                </h2>

                <div class="formulario">

                    <form id="form_exclui" action="delete_book.php" method="post" onsubmit="excluirLivro(); return false;">
                        <label for="id_exclui">Digite o ID do livro:</label> <br>
                        <input type="number" id="id_exclui" name="id" required> <br>

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
            const form = document.querySelector('#form_cadastro'); // Seleciona o formulário
            const formData = new FormData(form); // Cria o objeto FormData com os dados do formulário

            // Envia a requisição AJAX
            fetch('add_book.php', { // A função "fetch" envia uma requisição http para o arquivo "add_book.php"
                method: 'POST', // Indica que a requisição é do método post
                body: formData, // E que o corpo da requisição são os dados guardados no objeto "formData"
            })
                .then((response) => { // Quando a resposta do servidor, add_book.php, é recebida
                    if (!response.ok) { // Verifica se há algum erro
                        throw new Error('Erro ao cadastrar o livro.');
                    }
                    return response.json(); // Converte a resposta para JSON
                })
                .then((data) => { // É executada após a resposta ser convertida em JSON
                    // Atualiza a tabela com os novos dados
                    adicionarLinhaNaTabela(data);
                    form.reset(); // Limpa o formulário após o envio
                })
                .catch((error) => { // É executada se ocorrer algum erro
                    console.error(error); // Imprime o erro no console do navegador
                    alert('Ocorreu um erro ao cadastrar o livro.'); // E informa ao usuário
                });
        }

        // Função para adicionar uma nova linha na tabela
        function adicionarLinhaNaTabela(data) {
            const tabela = document.querySelector('#corpo_tabela'); // Seleciona o corpo da tabela
            const novaLinha = document.createElement('tr'); // Cria uma nova linha

            // Adiciona as células com os dados
            novaLinha.innerHTML = `
                <td class="celula_tabela">${data.id}</td>
                <td class="celula_tabela">${data.titulo}</td>
                <td class="celula_tabela">${data.autor}</td>
                <td class="celula_tabela">${data.ano_publicacao}</td>
            `;

            tabela.appendChild(novaLinha); // Insere a nova linha na tabela
        }

        function excluirLivro() {
            const form = document.querySelector('#form_exclui'); // Seleciona o formulário
            const formData = new FormData(form); // Cria um FormData com os dados, ID, do formulário

            // Envia a requisição AJAX para o servidor
            fetch('delete_book.php', { // Envia para o servidor, delete_book.php, a requisição
                method: 'POST', // Especifica que a requisição é pelo metodo POST
                body: formData, // Envia o objeto, formData, com os dados do formulário, ID
            })
                .then((response) => { // É executada quando obtem uma resposta do servidor, delete_book.php
                    if (!response.ok) {
                        throw new Error('Erro ao excluir o livro.');
                    }
                    return response.json();
                })
                .then((data) => { // É executada quando é recebido o arquivo JSON
                    if (data.success) {
                        // Remove a linha correspondente na tabela
                        removerLinhaDaTabela(data.id);
                        form.reset(); // Limpa o formulário após a exclusão
                        alert('Livro excluído com sucesso!');
                    } else {
                        alert('Erro: ' + data.error);
                    }
                })
                .catch((error) => {
                    console.error(error);
                    alert('Ocorreu um erro ao excluir o livro.');
                });
        }

        // Função para remover a linha da tabela
        function removerLinhaDaTabela(id) {
            const tabela = document.querySelector('#corpo_tabela');
            const linhas = tabela.querySelectorAll('tr');

            // Encontra a linha com o ID correspondente e a remove
            linhas.forEach((linha) => {
                if (linha.firstElementChild.textContent == id) {
                    tabela.removeChild(linha);
                }
            });
        }


    </script>
</body>
</html>

<?php
    require 'database.php';
    // require 'delete_book.php';
?>