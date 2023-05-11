<?php
  function validar() {
    return !empty($_POST['nomeADM'])
    || !empty($_POST['emailADM'])
    || !empty($_POST['senhaADM'])
    || !empty($_POST['ativoADM']);
  }

  include "ConectaMySQLDelta.php";
  include_once "abrir_transacao.php";
  if (validar()) {
    $nome = $_POST['nomeADM'];
    $email = $_POST['emailADM'];
    $senha = $_POST['senhaADM'];     
    $ativo = $_POST['ativoADM'];
    echo (int) $ativo;

    $comandoInsertADM = ""
        . "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) "
        . "VALUES (:nome, :email, :senha, :ativo)";
    $stmt = $pdo->prepare($comandoInsertADM);
    $stmt->bindValue("nome", $nome, PDO::PARAM_STR);
    $stmt->bindValue("email", $descricao, PDO::PARAM_STR);
    $stmt->bindValue("senha", (int) $preco, PDO::PARAM_INT);
    $stmt->bindValue("ativo", (int) $ativo, PDO::PARAM_INT);
    $stmt->execute();

    /*
    $idADM = $pdo->lastInsertId();
    $comandoInsertEstoque = "INSERT INTO PRODUTO_ESTOQUE (PRODUTO_ID, PRODUTO_QTD) VALUES (:idProduto, :qtd)";
    $pdo->prepare($comandoInsertEstoque)->execute(["idProduto" => $idProduto, "qtd" => $quantidade]);

    $transacaoOk = true;

    include "fechar_transacao.php";
  } else {
  */
    // Volta pra página com todos os dados.
  }
 
 header("Location: GerenciarADM.php");
