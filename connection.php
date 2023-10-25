<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "FORM_BD"; // banco de dados

$conn = mysqli_connect ($servidor, $usuario, $senha, $dbname);// atribuindo p a variavel conn uma funcao (mysqli_connect) que gera uma conexao com
// o bd. Quando eu quiser conexao com o bd, utilizo a variavel conn.

// trecho abaixo usado p descrever erro ao se conectar com o bd.
if (!$conn) {// ! eh um operador de negacao em PHP. !$conn verifica se a conexao eh falsa, ou seja, 
    // se ela n foi estabelecida com sucesso ou se teve falhas
    die("Conexao falhou: " . mysqli_connect_error());// mysqli_connect_error() uma funcao q vai dizer o q falhou na tentativa de se conectar com o banco.
}// die imprimi a mensagem e encerra a excucao do script.
?>