<?php
header('Access-Control-Allow-Origin: *');

$host = "localhost";
$user = "root";
$password = "123456";
$dbname = "form_ps";

$con = mysqli_connect($host,$user,$password,$dbname);

$method = $_SERVER['REQUEST_METHOD'];

if(!$con){
    die("Falha na conexão: " .mysqli_connect_error());
}




switch($method){
    case 'POST':

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $celular = $_POST["celular"];
        $cargo = $_POST["cargo"];
        $escolaridade = $_POST["escolaridade"];
        $obs = $_POST["obs"];
        $arquivo ="teste";

        if(isset($_FILES['arquivo'])){
            $pasta = "arquivos/";
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novoNomeArquivo = md5(time()) . $extensao;
                    
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$novoNomeArquivo);
        
            $arquivo = $_FILES['arquivo']['tmp_name'];
  
        }
            
        
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "INSERT INTO dados_pessoas (nome, email, celular, cargo, escolaridade, obs, arquivo, data_atual, ip) VALUES ('$nome', '$email', '$celular', '$cargo', '$escolaridade', '$obs', '$arquivo', NOW(), '$ip')";


    break;
};

$result = mysqli_query($con, $sql);

if(!$result){
    http_response_code(404);
    die(mysqli_error($con));
}

if($method == 'POST'){
    echo json_encode($result);
}else{
    echo mysqli_affected_rows($con);
}


$con->close();


/*$mail = new PMPMailer(true);*/





?>