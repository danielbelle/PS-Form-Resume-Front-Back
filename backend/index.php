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

//$diahoje = new DateTime();

switch($method){
    case 'POST':

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $celular = $_POST["celular"];
        $cargo = $_POST["cargo"];
        $escolaridade = $_POST["escolaridade"];
        $obs = $_POST["obs"];
        $arquivo = $_POST["arquivo"];
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = $_POST["nome"];
        $sql = "INSERT INTO dados_pessoas (nome, email, celular, cargo, escolaridade, obs, arquivo, data_atual, ip) VALUES ('$nome', '$email', '$celular', '$cargo', '$escolaridade', '$obs', '$arquivo', NOW(), '$ip')";


    break;
}
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

?>