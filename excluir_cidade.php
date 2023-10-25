<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $CIDADE_ID = $_GET['id'];

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tb_cidade WHERE id_cidade = $CIDADE_ID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $cidade = $result->fetch_assoc();
        $cidade_nome = $cidade['nome_cidade'];
    } else {
        echo "Cidade não encontrada!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o formulário foi submetido
        if(isset($_POST['confirmar_exclusao'])) {
            // Exclui a cidade do banco de dados com base no ID
            $sql = "DELETE FROM tb_cidade WHERE id_cidade = $CIDADE_ID";

            if ($conn->query($sql) === TRUE) {
                echo "<br>Cidade excluída com sucesso!";

                // Inicia o buffer de saída
                ob_start();
                            
                // Aguarde um momento e, em seguida, redirecione para lista_cidadeEestados.php
                header("refresh:2;url=lista_cityEestados.php");
                
                // Limpa o buffer de saída e envia os dados para o navegador
                ob_end_flush();
                exit;
            } else {
                echo "Erro ao excluir cidade: " . $conn->error;
            }
        } else {
            echo "Exclusão não confirmada.";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID inválido ou não fornecido!";
}
?>

<h2>Confirmar Exclusão</h2>
<p>Você está prestes a excluir a cidade: <?php echo $cidade_nome; ?>. Esta ação não pode ser desfeita.</p>
<form method="POST">
    <input type='submit' name='confirmar_exclusao' value='Confirmar Exclusão'>
</form>
