<?php
  include 'connection.php';

// Verifica a conexão

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
} 


// Consulta para obter dados das cidades e estados
$result = $conn->query("SELECT id_cidade, nome_cidade, nome_estado 
                        FROM tb_cidade
                        LEFT JOIN tb_estados ON tb_cidade.id_estado = tb_estados.id_estado");


// id_cidade, nome_cidade colunas da tabela tb_cidade.
//nome_estado  coluna de tb_estado

// Exibição dos dados
while ($row = $result->fetch_assoc()) {
    echo "Estado: {$row['nome_estado']} - Cidade: {$row[ 'nome_cidade']} ";
    echo "<a href='editar_cidade.php?id={$row['id_cidade']}'>Editar</a> ";
    echo "<a href='excluir_cidade.php?id={$row['id_cidade']}'>Excluir</a><br>";
}// id_cidade é a chave de um índice do array associativo $row que contém os resultados da consulta SQL.
// id_cidade representa a chave do array associativo '$row'onde o id da cidade eh armazenado. Esse nome deve ser o mesmo que esta na coluna da tb_cidade.

//echo "<a href='editar_cidade.php?id={$row['id_cidade']}'>Editar</a> "; EXPLICACAO: você está criando um link (<a>) para a página editar_cidade.php. No URL desse link, você está passando o valor do ID da cidade como um parâmetro chamado id. Este id corresponde ao nome do parâmetro passado pela URL e deve ser capturado na página editar_cidade.php.

// Fecha a conexão
$conn->close();
?> 




