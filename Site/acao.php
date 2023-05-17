<?php
switch ($_REQUEST["acao"]){
        
        case 'cadastrar':
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $cpf = $_POST["cpf"];
    
    $sql = "INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_cpf) values ('{$nome}.{$sobrenome}', '{$email}', '{$senha}', '{$cpf}')";
            $res = $conn ->query ($sql)
    break
    








}
?>
