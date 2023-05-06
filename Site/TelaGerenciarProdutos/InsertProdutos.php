<?php include "ConectaMySQLDelta.php";
	$pdo = conectSQL();
 if (isset($_POST['enviar'])) {
    if (!empty($_POST['nomeProduto'])|| !empty($_POST['descProduto']) || !empty($_POST['categoriaProd']) || !empty($_POST['qntProduto']) || !empty($_POST['precoProduto']) || !empty($_POST['descontoProduto']) || !empty($_POST['categoriaID'])) {
      $nome = $_POST['nomeProduto'];
      $preco = $_POST['precoProduto'];
      $desc = $_POST['descProduto'];
      $categoria = $_POST['categoriaProd'];
      $quantidade = $_POST['qntProduto'];
      $desconto = $_POST['descontoProduto'];
      $categoriaID = $_POST['categoriaID'];
      $comandoSql1 = "INSERT INTO PRODUTO(PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) VALUES (:nome, :desc, :preco, :desconto, :categoriaID)";
      $pdo->prepare($comandoSql1)->execute(["nome" => $nome, "descricao" => $desc, "preco" => $preco, "desconto" => $categoriaID, "categoriaID" => $categoriaID,]);
      $idProduto = $pdo->lastInsertId();
      $comandoSql2 = "INSERT INTO PRODUTO_ESTOQUE(PRODUTO_ID, PRODUTO_QTD) VALUES(:idProduto, :qtd)";
      $pdo->prepare($comandoSql2)->execute(["idProduto" => $idProduto, "qtd" => $quantidade]);
    }
 }
 
 header("Location: telaGerenciarprodutos.php");
