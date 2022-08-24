<?php

class Conexao 
{
    private $host;
    private $database; 
    private $user;
    private $password;   
    private $con;

    public function Conectar($host, $database, $user, $password){
        $this->host = $host;
        $this->database = $database; 
        $this->user = $user;
        $this->password = $password;
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8";
        
        try{
            $this->con = new PDO($dsn, $this->user, $this->password);
            echo "<script>alert('Conectado com sucesso ao {$this->database}.')</script>";
        }catch (PDOException $ex){
            echo 'Erro: '.$ex->getMessage();
        }
        return $this->con;

    }

    public function Gravar($nome, $email, $celular, $cargo, $escolaridade, $obs, $arquivo, $ip){
        
        $statements = "INSERT INTO dados_pessoas (nome, email, celular, cargo, escolaridade, obs, arquivo, data_atual, ip) VALUES ('$nome', '$email', '$celular', '$cargo', '$escolaridade', '$obs', '$arquivo', NOW(), '$ip')";
        
        
        

        try{
            $sql = $this->con->prepare($statements);
            $sql->execute();
            echo "<script>alert('Envio aconteceu corretamente')</script>";
        }catch (PDOException $ex){
            echo 'Erro: '.$ex->getMessage();
        }
        
        return $this->con->close();
        


    }
}

?>