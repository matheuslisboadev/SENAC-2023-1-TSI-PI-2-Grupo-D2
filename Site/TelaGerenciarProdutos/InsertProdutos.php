<?php
  function validar() {
    return !empty($_POST['nomeProduto'])
    || !empty($_POST['descProduto'])
    || !empty($_POST['qntProduto'])
    || !empty($_POST['precoProduto'])
    || !empty($_POST['descontoProduto'])
    || !empty($_POST['categoriaID'])
    || !empty($_POST['produtoAtivo']);
  }

  include "ConectaMySQLDelta.php";
  include_once "abrir_transacao.php";
  if (validar()) {
    $nome = $_POST['nomeProduto'];
    $preco = $_POST['precoProduto'];
    $descricao = $_POST['descProduto'];     
    $quantidade = $_POST['qntProduto'];
    $ativo = $_POST['produtoAtivo'];
    echo (int) $ativo;
    $desconto = $_POST['descontoProduto'];
    $categoriaID = $_POST['categoriaID'];
    
    $comandoInsertProduto = ""
        . "INSERT INTO PRODUTO (PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) "
        . "VALUES (:nome, :descricao, :preco, :desconto, :categoriaID, :ativo)";
    $stmt = $pdo->prepare($comandoInsertProduto);
    $stmt->bindValue("nome", $nome, PDO::PARAM_STR);
    $stmt->bindValue("descricao", $descricao, PDO::PARAM_STR);
    $stmt->bindValue("preco", (int) $preco, PDO::PARAM_INT);
    $stmt->bindValue("desconto", (int) $desconto, PDO::PARAM_INT);
    $stmt->bindValue("categoriaID", (int) $categoriaID, PDO::PARAM_INT);
    $stmt->bindValue("ativo", (int) $ativo, PDO::PARAM_INT);
    $stmt->execute();

    $idProduto = $pdo->lastInsertId();
    $comandoInsertEstoque = "INSERT INTO PRODUTO_ESTOQUE (PRODUTO_ID, PRODUTO_QTD) VALUES (:idProduto, :qtd)";
    $pdo->prepare($comandoInsertEstoque)->execute(["idProduto" => $idProduto, "qtd" => $quantidade]);

    $transacaoOk = true;

    include "fechar_transacao.php";
  } else {
    // Volta pra página com todos os dados.
  }
 
 header("Location: telaGerenciarprodutos.php");
