<?php
  function validar() {
    return !empty($_POST['nomeUsuario'])
    || !empty($_POST['EmailUsuario'])
    || !empty($_POST['SenhaUsuario'])
    || !empty($_POST['CPFusuario']);
  }

  include "ConectaMySQLDelta.php";
  include_once "abrir_transacao.php";
  if (validar()) {
    $nome = $_POST['nomeUsuario'];
    $email = $_POST['EmailUsuario'];
    $senha = $_POST['SenhaUsuario'];     
    $cpf = $_POST['CPFusuario'];

    
    $comandoInsertUsuario = ""
        . "INSERT INTO USUARIO (USUARIO_NOME, USUARIO_EMAIL, USUARIO_SENHA, USUARIO_CPF) "
        . "VALUES (:nome, :email, :senha, :cpf)";
    $stmt = $pdo->prepare($comandoInsertProduto);
    $stmt->bindValue("nome", $nome, PDO::PARAM_STR);
    $stmt->bindValue("email", $email, PDO::PARAM_STR);
    $stmt->bindValue("senha", $senha, PDO::PARAM_STR);
    $stmt->bindValue("cpf", (int) $cpf, PDO::PARAM_INT);
    $stmt->execute();

    /*
    $idUsuario = $pdo->lastInsertId();
    $comandoInsertUsuario = "INSERT INTO PRODUTO_ESTOQUE (PRODUTO_ID, PRODUTO_QTD) VALUES (:idProduto, :qtd)";
    $pdo->prepare($comandoInsertEstoque)->execute(["idProduto" => $idProduto, "qtd" => $quantidade]);

    $transacaoOk = true;

    include "fechar_transacao.php";
  } else {
  */
    // Volta pra página com todos os dados.
  }
 
 header("Location: GerenciarUsuariosDelta.php");