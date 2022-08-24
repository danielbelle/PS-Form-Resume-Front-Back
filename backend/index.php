<?php

namespace App;

require __DIR__ . '/vendor/autoload.php';

use App\Communication\Email;
use App\Conection\Conexao;

header('Access-Control-Allow-Origin: *');

$conectarBd = new Conexao();



$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'POST':

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



            if ($extensao == '.pdf' or $extensao == '.doc' or $extensao == 'docx' or $_FILES['arquivo']['size']<=1100000) {

                

                $arquivo = $_FILES['arquivo']['tmp_name'];

                $conectarBd->Conectar('localhost', 'form_ps', 'root', '123456');
                $extensao = '';
                if (!$conectarBd) {
                    die("Falha na conexão: ");
                }

                $conectarBd->Gravar($nome, $email, $celular, $cargo, $escolaridade, $obs, $arquivo, $ip);

                move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta . $novoNomeArquivo);
                
                $address = $email;
                $subject = "Seu CV foi recebido pela XYZ";
                $body = "<html>
                    <h1>Confirmando o envio do seu CV:</h1>
                    <p><b>Nome:</b>$nome</p>
                    <p><b>Email:</b>$email</p>
                    <p><b>Telefone:</b>$celular</p>
                    <p><b>Cargo Desejado:</b>$cargo</p>
                    <p><b>Escolaridade:</b>$escolaridade</p>
                    <p><b>Observação:</b>$obs</p>
                </html>";

                $obEmail = new Email;
                $sucesso = $obEmail->sendEmail($address, $subject, $body);

                echo $sucesso ? 'Formulário enviado com sucesso!' : $obEmail->getError();
            } else {
                echo('Formulário não enviado, verifique o tamanho do anexo ou a extensão');
            }
        }

        break;
};
