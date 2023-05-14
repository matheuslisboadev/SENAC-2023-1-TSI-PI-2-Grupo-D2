<?php
  function validar() {
    return !empty($_POST['nomeDoProduto'])
    || !empty($_POST['descDoProduto'])
    || !empty($_POST['qntDoProduto'])
    || !empty($_POST['precDoProduto'])
    || !empty($_POST['dsctDoProduto'])
    || !empty($_POST['categDoProduto'])
    || !empty($_POST['produtoEditAtivo']);
  }

  include "ConectaMySQLDelta.php";
  include_once "abrir_transacao.php";
  if (validar()) {
    $nome = $_POST['nomeDoProduto'];
    $preco = $_POST['precDoProduto'];
    $descricao = $_POST['descDoProduto'];     
    $quantidade = $_POST['qntDoProduto'];
    $ativo = $_POST['produtoEditAtivo'];
    echo (int) $ativo;
    $desconto = $_POST['dsctDoProduto'];
    $categoriaID = $_POST['categDoProduto'];
    $idProduto = $_POST['idProdutoInativar'];
    
    $comandoUpdateProduto = ""
        . "UPDATE PRODUTO  "
        . "SET PRODUTO_NOME = (:nome) , PRODUTO_DESC = (:descricao) , PRODUTO_PRECO = (:preco) , PRODUTO_DESCONTO = (:desconto),  CATEGORIA_ID = (:categoriaID) , PRODUTO_ATIVO = (:ativo) WHERE PRODUTO_ID = (:idProduto)";
    $stmt = $pdo->prepare($comandoUpdateProduto);
    $stmt->bindValue("nome", $nome, PDO::PARAM_STR);
    $stmt->bindValue("descricao", $descricao, PDO::PARAM_STR);
    $stmt->bindValue("preco", (int) $preco, PDO::PARAM_INT);
    $stmt->bindValue("desconto", (int) $desconto, PDO::PARAM_INT);
    $stmt->bindValue("categoriaID", (int) $categoriaID, PDO::PARAM_INT);
    $stmt->bindValue("ativo", (int) $ativo, PDO::PARAM_INT);
    $stmt->bindValue("idProduto", (int) $idProduto, PDO::PARAM_INT);
    $stmt->execute();


    $comandoEditEstoque = "UPDATE PRODUTO_ESTOQUE SET PRODUTO_QTD = (:quantidade) WHERE PRODUTO_ID = (:idProduto)";
    $pdo->prepare($comandoEditEstoque)->execute(["idProduto" => $idProduto, "quantidade" => $quantidade]);
    $transacaoOk = true;

    include "fechar_transacao.php";
  } else {
    // Volta pra página com todos os dados.
  }
 
 header("Location: telaGerenciarprodutos.php");
