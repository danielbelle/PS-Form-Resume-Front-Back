<?php
function sendEmail($nome, $email, $celular, $cargo, $escolaridade, $obs)
{

    $sender = "phpmytraining404@gmail.com";

    $arquivo = "
    <html>
        <h1>Confirmando o envio do seu CV:</h1>
        <p><b>Nome:</b>$nome</p>
        <p><b>Email:</b>$email</p>
        <p><b>Telefone:</b>$celular</p>
        <p><b>Cargo Desejado:</b>$cargo</p>
        <p><b>Escolaridade:</b>$escolaridade</p>
        <p><b>Observação:</b>$obs</p>
    </html>
    ";


    $destino = $email;
    $assunto = "Confirmação de envio de CV para a empresa XYZ";

    $headers = array(
        "MIME-Version" => "1.0",
        "Content-type" => "text/html;charset=UTF-8",
        "From" => $sender,
        "Reply-To" => $sender
    );

    mail($destino, $assunto, $arquivo, $headers);
}
