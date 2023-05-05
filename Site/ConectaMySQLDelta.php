<?php
    function conectaSQL(){
       //Dados para conexao ao MySQL → MySQL
$mysqlhostname = "144.22.157.228";
$mysqlport = "3306";
$mysqlpassword="delta";
$mysqlusername = "delta";
$mysqldatabase = "Delta";

//Mostra a String de Conexao ao MySQL → Criei a String de conexão e conectei ao banco (PDO)
$dsn = 'mysql:host=' . $mysqlhostname . ';dbname=' . $mysqldatabase . ';port=' . $mysqlport;
$pdo = new PDO($dsn, $mysqlusername, $mysqlpassword);
return $pdo;
}
