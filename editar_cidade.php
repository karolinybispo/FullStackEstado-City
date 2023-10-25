<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    include 'connection.php';
if(isset ($_GET['id']) && is_numeric($_GET['id'])){
    //isset() verifica se uma variavel ou indice de um array esta definido e nao eh nulo. isset ($GET[ id']): verificqa se existe um parametro
    // chamado id_city_URL na URL, se tiver, isset ($GET[ id']) eh true.

    //is_numeric() funcao que verifica se uma variavel contem um valor numerico ou uma string numerica. True eh retornado se for valor numerico.
    //is_numeric($_GET['id']) esta vendo se o valor de $GET['id'] eh numerico.

    // && operador que retorna true se as condicoes a direita e esquerda forem verdadeiras.


// if(isset ($GET[ id']) && is_numeric($GET[ id'])){ EXPLICACAO:ocê está verificando se o parâmetro id foi passado na URL ($_GET['id']). O isset($_GET['id']) verifica se o parâmetro id foi passado pela URL, enquanto is_numeric($_GET['id']) verifica se o valor do parâmetro é numérico. 
//o id na URL (?id={$row[ id']}) é capturado usando $_GET['id'] na página editar_cidade.php. A verificação isset($_GET['id']) garante que o parâmetro id foi passado na URL, e is_numeric($_GET['id']) verifica se o valor passado é numérico.

$CIDADE_ID = $_GET['id'];

if ($conn->connect_error){
    die("erro de conexao: " . $conn->connect_error);
}

$sql = "SELECT * FROM tb_cidade WHERE id_cidade = $CIDADE_ID";
$result = $conn->query($sql);
// a função query() é usada para executar consultas SQL. A consulta SQL como no exemplo da variavel $sql
// nao eh feita automaticamnete, precisa da query.
// $result = $conn->query($sql); isso executa a consulta SQL q esta na variavel $sql. conn eh a conexao com o banco


// Verifica se a consulta query() foi bem-sucedida
if ($result && $result->num_rows > 0) {// isso ve se $result contem um resultado da consulta e se o numero de linhas de resultado $result->num_rows eh maior q zero. Se for verdadeiro, pelo menos uma linha correspondente foi encontrado na tabela do banco de dados.
    $cidade = $result->fetch_assoc();//vai obter a proxima linha da consulta.
    //fetch_assoc() retorna a próxima linha do conjunto de resultados como um array associativo, onde as chaves do array são os nomes das colunas do banco de dados e os valores são os valores das colunas correspondentes nesta linha.
    $cidade_nome = $cidade['nome_cidade']; // Substitua 'nome_da_coluna' pelo nome real da coluna
} else {
    echo "Cidade não encontrada!";
    exit; // Encerra o script se a cidade não for encontrada
}

   // Verifica se o formulário foi submetido
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submetido com sucesso";
    // Verifica se o nome da cidade foi enviado pelo formulário
    if(isset($_POST['nome_cidade'])) {
        // Captura o novo nome da cidade do formulário
        $novo_nome = $_POST['nome_cidade'];

        // Atualiza o nome da cidade no banco de dados com base no ID
        $sql = $sql = "UPDATE tb_cidade SET nome_cidade = '$novo_nome' WHERE id_cidade = $CIDADE_ID";
        if ($conn->query($sql) === TRUE) {// verifica se a consulta acima foi realizada com sucesso
            echo "<br>Cidade editada com sucesso!";


            // Inicia o buffer de saída
            ob_start();
                        
            // Aguarde um momento e, em seguida, redirecione para lista_cidadeEestados.php
            header("refresh:2;url=lista_cityEestados.php");
            
            // Limpa o buffer de saída e envia os dados para o navegador
            ob_end_flush();
            exit;


        } else {
            echo "Erro ao editar cidade: " . $conn->error;
        }
    } else {
        echo "Nome da cidade não fornecido!";
    }
}
 // Fecha a conexão com o banco de dados
 $conn->close();
}

else {
    echo "ID inválido ou não fornecido!";
}
?>


<h2>Editar Cidade</h2>
<form method="POST">
    Nome: <input type='text' name='nome_cidade' value='<?php echo $cidade_nome; ?>'><br>
    <input type='submit' value='Salvar'>
</form>

