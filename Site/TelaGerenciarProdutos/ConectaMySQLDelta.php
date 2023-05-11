<?php
    function conectSQL(){
        //Dados para conexao ao MySQL → MySQL
$host = '144.22.157.228';        
$port = 3306;
$user = 'delta';
$senha = 'delta';
$dbname = 'Delta';
 try{
    //Mostra a String de Conexao ao MySQL → Criei a String de conexão e conectei ao banco (PDO)
return new PDO("mysql:host=$host:$port;dbname=$dbname", $user, $senha);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        throw $e;
    }
}
?>