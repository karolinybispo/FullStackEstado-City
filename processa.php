<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estado_id = $_POST['estado'];
    $cidade = $_POST['cidade'];

    include 'connection.php';

    $query = "INSERT INTO tb_cidade (id_estado, nome_cidade) VALUES ('$estado_id', '$cidade')";
    if (mysqli_query($conn, $query)) {
        echo "Cidade adicionada";
    } else {
        echo "Erro ao adicionar a cidade: " . mysqli_error($conn);
    }

    // Redirecionar de volta para o formulário
   //header("Location: form.php");
   //exit();
   header("Location:form.php");
   exit();
}
?>