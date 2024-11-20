<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Lexend;
        }

        body {
            background-image: linear-gradient( 174.2deg,  rgba(255,244,228,1) 7.1%, rgba(240,246,238,1) 67.4% );
        }

        header {
            margin: 20px 0 20px;
            text-align: center;
        }

        main {
            margin-inline: 10px;

            #titulos_tags {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .pendentes {
                    position: relative;
                    border-left: 5px solid #ff0000;
            }

            .concluidas {
                position: relative;
                border-left: 5px solid #088A08; 
            }

            .pendentes , .concluidas {
                margin: 10px;
                padding: 20px;
                width: 50%;   
                border-radius: 15px;
                background-color: #ffffff;
            }

            .titulo_pendentes{
                button {
                    display: flex;
                    position: absolute;
                    right: 0;        
                    margin-right: 30px;
                    border: none;
                    background: none;
                    cursor: pointer;
                                
                    img {
                        border: 2px solid #B7B7B7;
                        border-radius: 50%;
                    }
                }
            }

            .titulo_concluidas {
                button {
                    display: flex;
                    position: absolute;
                    right: 0;   
                    margin-right: 30px;
                    border: none;
                    background: none;
                    cursor: pointer;
                }
            }

            .titulo_pendentes , .titulo_concluidas {
                display: inline-flex;
                align-items: center;
                font-weight: bold;

                img {
                    margin-right: 10px;
                }
            }

            #tarefas_tags {
                display: flex;
                align-items: flex-start;
                justify-content: center;  
            }

            .tag_pendente {
                    border-left: 5px solid red;
                    
                    button {
                        margin-left: 5px;
                        padding: 5px;
                        background: none;
                        border: 1px solid black;
                        border-radius: 5px;
                        font-size: medium;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: #088A08;
                        color: white;
                    }
                }

            .data_tarefa {
                position: absolute;
                right: 0;
                padding: 8px;
                border-radius: 5px;
            }

            .tarefa_concluida , .tarefa_pendente {
                display: flex;
                flex-direction: column;  
                margin-inline: 50px;
                width: 50%;
                max-width: 50%;
            }

            .tag_concluida {
                border-left: 5px solid #088A08;
            }

            .tag_pendente , .tag_concluida {
                margin-bottom: 20px;
                padding: 20px;
                border-radius: 15px;
                background-color: #ffffff;        
            }

            .titulo_tarefa {
                position: relative;
                display: flex;
            }

            .descricao {
                margin: 20px 0 10px;
                padding: 10px;
                border: 1px dotted black;
                border-radius: 10px;
            }
        }

        .popup , .popup2 {
            display: none; /* Oculto por padrão */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Conteúdo do popup */
        .popup-conteudo , .popup2_conteudo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            width: 30%;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            background-color: white;

            h2 {
                margin-bottom: 10px;
            }
        }

        .insere_dados , form {
            display: flex;
            flex-direction: column;
            text-align: justify;

            input , textarea , button {
                padding: 5px;
                border: 1px solid black;
                border-radius: 5px;
                margin: 5px 0 5px;
            }

            textarea {
                max-width: 100%;
            }

            button {
                padding: 5px;
                background: none;
            }

            button:hover {
                background-color: #088A08;
                color: white;
            }
        }

        .titulo_tarefa , form {
            display: flex;
            flex-direction: column;
            text-align: justify;

            input {
                padding: 5px;
                border: 1px solid black;
                border-radius: 5px;
                margin: 5px 0 5px;
            }

            button {
                padding: 5px;
                background: none;
            }

            button:hover {
                background-color: #088A08;
                color: white;
            }
        }

        /* Botão de fechar */
        .fechar {
            position: absolute;
            top: 10px;
            right: 10px;

            font-size: 20px;
            font-weight: bold;
            
            cursor: pointer;
        }

    </style>

    <title>Atividade 2 - Questão 2</title>
</head>
<body>
    <header>
        <h1>Sistema de Gerenciamento de Tarefas</h1>
    </header>

    <main>
        <section id="titulos_tags">
            <div class="pendentes">
                <div class="titulo_pendentes">
                    <img src="./src/image/relogio.png" width="50px">
                    <h1>Pendentes</h1>

                    <button>
                        <img class="adiciona" id="abrirPopup" src="./src/image/add.png" width="45px">
                    </button>

                </div>
            </div>
            <div class="concluidas">
                <div class="titulo_concluidas">
                    <img src="./src/image/check.png" width="50px">
                    <h1>Concluídas</h1>

                    <button>
                        <img class="remove" id="abrirPopup2" src="./src/image/delete.png" width="50px">
                    </button>
                </div>
            </div>
        </section>

        <section id="tarefas_tags">
            <div class="tarefa_pendente">
                
            </div>
            
            <div class="tarefa_concluida">
                
            </div>

        </section>
    </main>

    <div id="popup" class="popup">
        <div class="popup-conteudo">
            <span id="fecharPopup" class="fechar">&times;</span>
            <h2>Adicionar tarefas</h2>
            
            <div class="insere_dados">
                <form action="add_tarefa.php" method="post">
                    <label for="titulo">Título da tarefa</label>
                        <input type="text" id="titulo" name="titulo" placehoabrirPopuplder="Digite aqui" maxlength="60">
                    <label for="data">Data de vencimento</label>
                        <input type="date" name="data" id="data">
                    <label for="descricao_popup">Descrição da tarefa</label>
                        <textarea name="descricao_popup" id="descricao_popup" rows="2" placeholder="Digite Aqui" maxlength="75"></textarea>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <div id="popup2" class="popup2">
        <div class="popup2_conteudo">
            <span id="fecharPopup2" class="fechar">&times;</span>
            <h2>Deletar tarefas</h2>
            <div class="titulo_tarefa">
                <form method="post">
                    <label for="titulo_delete">Digite o título da tarefa</label>
                    <input type="text" id="titulo_delete" name="titulo_delete">
                    <button onclick="deleta_tarefa()">Apagar</button>
                </form>
            </div>
        </div>
    </div>

    <script defer>

        main();

        function main() {
            document.addEventListener('DOMContentLoaded', async () => {
                try {
                    const response = await fetch('get_tarefas.php');
                    const result = await response.json();

                    if (result.success) {
                        result.tarefas.forEach(tarefa => {
                            // Posiciona a tarefa na seção correta com base no status
                            criaElementosDaTarefa(
                                tarefa.titulo,
                                tarefa.data_vencimento,
                                tarefa.descricao,
                                tarefa.status // Passa o status da tarefa
                            );
                        });
                    } else {
                        console.error('Erro ao buscar tarefas:', result.message);
                    }
                } catch (error) {
                    console.error('Erro na requisição:', error);
                }
            });

            document.getElementById("abrirPopup").addEventListener("click", () => {
                popus("popup", "fecharPopup");
            });

            document.getElementById("abrirPopup2").addEventListener("click", () => {
                popus("popup2", "fecharPopup2");
            });
        }
        
        function atualizaCorDataTarefa(dataTarefaDiv) {
            const dataTexto = dataTarefaDiv.querySelector("p").textContent;
            const dataPendente = converteDataBrParaDataAmericana(dataTexto);
            const dataAtual = new Date();
            const diferencaDias = Math.ceil((dataPendente - dataAtual) / (1000 * 60 * 60 * 24));

            // Aplica a cor com base na diferença de dias
            if (diferencaDias > 5) {
                dataTarefaDiv.style.backgroundColor = "green";
                dataTarefaDiv.style.color = 'white';
            } else if (diferencaDias > 1) {
                dataTarefaDiv.style.backgroundColor = "yellow";
            } else {
                dataTarefaDiv.style.backgroundColor = "red";
                dataTarefaDiv.style.color = 'white';
            }
        }

        function converteDataBrParaDataAmericana(dataStr) {
            const [dia, mes, ano] = dataStr.split("/").map(Number);
            return new Date(ano, mes - 1, dia); // Meses começam do 0 no JavaScript
        }

        function popus(popupId, closeButtonId) {
            const popup = document.getElementById(popupId);
            const closeButton = document.getElementById(closeButtonId);

            // Exibe o popup
            popup.style.display = "block";

            // Adiciona evento para fechar o popup ao clicar no botão de fechar
            closeButton.addEventListener("click", () => {
                popup.style.display = "none";
            });

            // Adiciona evento para fechar o popup ao clicar fora do conteúdo
            popup.addEventListener("click", (e) => {
                if (e.target === popup) {
                    popup.style.display = "none";
                }
            });
        }

        function criaElementosDaTarefa(titulo, dataVencimento, descricao, status = 'pendente') {
            const container = document.querySelector(status === 'pendente' ? '.tarefa_pendente' : '.tarefa_concluida');
            const taskDiv = criaDivDaTarefa(status);
            const titleDiv = criaDivDoTitulo(titulo, dataVencimento, status);
            const descPara = criaElementoDaDescricao(descricao);

            taskDiv.appendChild(titleDiv);
            taskDiv.appendChild(descPara);

            if (status === 'pendente') {
                const button = criaBotaoDeConcluido(taskDiv, titulo, titleDiv);
                taskDiv.appendChild(button);
            }

            container.appendChild(taskDiv);

            if (status === 'pendente') {
                atualizaCorDataTarefa(titleDiv.querySelector('.data_tarefa'));
            }
        }

        function criaDivDaTarefa(status) {
            const div = document.createElement('div');
            div.className = status === 'pendente' ? 'tag_pendente' : 'tag_concluida';
            return div;
        }

        function criaDivDoTitulo(titulo, dataVencimento, status) {
            const titleDiv = document.createElement('div');
            titleDiv.className = 'titulo_tarefa';

            const titleElement = document.createElement('h2');
            titleElement.textContent = titulo;
            titleDiv.appendChild(titleElement);

            if (status === 'pendente' && dataVencimento) {
                const dataDiv = document.createElement('div');
                dataDiv.className = 'data_tarefa';

                const dataElement = document.createElement('p');
                dataElement.textContent = dataVencimento;

                dataDiv.appendChild(dataElement);
                titleDiv.appendChild(dataDiv);
            }

            return titleDiv;
        }

        function criaElementoDaDescricao(descricao) {
            const descPara = document.createElement('p');
            descPara.className = 'descricao';
            descPara.textContent = descricao;
            return descPara;
        }

        function criaBotaoDeConcluido(taskDiv, titulo, titleDiv) {
            const button = document.createElement('button');
            button.textContent = 'Concluído';

            button.addEventListener('click', async () => {
                try {
                    const response = await fetch('update_tarefa.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ titulo })
                    });

                    const result = await response.json();

                    if (result.success) {
                        moveATarefaParaConcluido(taskDiv, titleDiv);
                    } else {
                        alert('Erro: ' + result.message);
                    }
                } catch (error) {
                    console.error('Erro ao concluir tarefa:', error);
                }
            });

            return button;
        }

        function moveATarefaParaConcluido(taskDiv, titleDiv) {
            // Move a tarefa para "concluída"
            taskDiv.classList.remove('tag_pendente');
            taskDiv.classList.add('tag_concluida');
            document.querySelector('.tarefa_concluida').appendChild(taskDiv);

            // Remove a <div class="data_tarefa">
            const dataDiv = titleDiv.querySelector('.data_tarefa');
            if (dataDiv) dataDiv.remove();

            // Remove o botão "Concluído"
            const button = taskDiv.querySelector('button');
            if (button) button.remove();
        }

        function deleta_tarefa() {
            document.querySelector('#titulo_delete').closest('form').addEventListener('submit', async (e) => {
                e.preventDefault();

                const titulo = document.querySelector('#titulo_delete').value.trim();

                if (titulo) {
                    try {
                        const response = await fetch('delete_tarefa.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: new URLSearchParams({ titulo }),
                        });

                        const result = await response.json();

                        if (result.success) {
                            alert(result.message);
                            location.reload(); // Atualiza a página para refletir a exclusão
                        } else {
                            alert(result.message);
                        }
                    } catch (error) {
                        console.error('Erro ao deletar tarefa:', error);
                        alert('Erro no servidor.');
                    }
                } else {
                    alert('Por favor, insira o título da tarefa.');
                }
            });
        }

    </script>
</body>
</html>

<?php
    require 'database.php';
?> 