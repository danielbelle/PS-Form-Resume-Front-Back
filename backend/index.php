<?php
header('Access-Control-Allow-Origin: *');

require_once('services/Conexao.php');

$conectarBd = new Conexao();



$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'POST':
        $conectarBd->Conectar('localhost','form_ps','root','123456');
        if (!$conectarBd) {
            die("Falha na conexão: ");
        }
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $celular = $_POST["celular"];
        $cargo = $_POST["cargo"];
        $escolaridade = $_POST["escolaridade"];
        $obs = $_POST["obs"];
        $arquivo = "teste";
        $ip = $_SERVER['REMOTE_ADDR'];

        if (isset($_FILES['arquivo'])) {
            $pasta = "arquivos/";
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novoNomeArquivo = md5(time()) . $extensao;

            move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta . $novoNomeArquivo);

            $arquivo = $_FILES['arquivo']['tmp_name'];
        }

        $conectarBd->Gravar($nome, $email, $celular, $cargo, $escolaridade, $obs, $arquivo, $ip);

    break;
};


?>