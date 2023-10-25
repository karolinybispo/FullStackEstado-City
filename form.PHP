<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cidade</title>
</head>
<body>
    <h2>Adicionar Nova Cidade</h2>
    <form action="processa.php" method="post">
        Estado:
        <select name="estado"> <!-- o <select> cria um menu suspenso-->
                        <?php
                        include 'connection.php';
                    $query = "SELECT * FROM tb_estados";
                    $result = mysqli_query($conn, $query);// mysqli_query funcao que recebe dois parametros, a consulta com banco($conn)
                    // e a consulta SQL q desejo executar ($query).
                    while ($row = mysqli_fetch_assoc($result)) {
            // mysqli_fetch_assoc essa funcao obtem uma linha de dados do resultado da consulta ($result) como um array associativo($row);
            //toda vez q ela eh chamada, ela pega a proxima linha de dados do resultado da consulta. Se n tiver mais linhas o while fecha.
            //$row armazena a linha de dados obtida. Ela eh tipo um array. Cada chave do array corresponde ao nome de uma coluna na tabela do bd.
                        echo "<option value='" . $row['id_estado'] . "'>" . $row['nome_estado'] . "</option>";
                    }// "<option value='" . $row['estado_id'] . "'>": esta sendo construido uma string HTML q representa uma opcao em um menu suspenso ('<select>').

            ?>

        </select>
        <br>
        Cidade: <input type="text" name="cidade">
        <br>
        <input type="submit" value="Adicionar Cidade">
        
<a href="lista_cityEestados.php"><button type="button">Lista Cidades e Estados</button></a>
    </form>
</body>
</html>