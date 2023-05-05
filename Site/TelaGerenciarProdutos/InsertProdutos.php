<?php
 require("ConectaMySQLDelta");
 if(isset($_GET['enviar'])){
    if (!empty($_GET['nomeProduto'])|| !empty($_GET['descProduto']) || !empty($_GET['categoriaProd']) || !empty($_GET['qntProduto']) || !empty($_GET['precoProduto']) || !empty($_GET['descontoProduto'] || !empty($_GET['categoriaID']))
     $nome = $_GET['nomeProduto'];
     $preco = $_GET['precoProduto'];
     $desc = $_GET['descProduto'];
     $categoria = $_GET['categoriaProd'];
     $quantidade = $_GET['qntProduto'];
     $desconto = $_GET['descontoProduto'];
     $categoriaID = $_GET['categoriaID'];

        $comandosql = "INSERT INTO PRODUTO(PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID) VALUES ('$nome', '$desc', '$preco', '$desconto', '$categoriaID')";
        $comandosqlQuantidade = "INSERT INTO PRODUTO_ESTOQUE(PRODUTO_QTD) VALUES('$quantidade')";
        $enviar = 


 }
?>
