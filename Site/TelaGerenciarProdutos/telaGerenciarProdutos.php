<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delta ADM</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Css/cssTelaGerenciarProdutos.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="Js/jsTelaGerenciarProdutos.js"></script>
	<?php include "ConectaMySQLDelta.php";
	$pdo = conectSQL();
	?>
</head>

<body>
	<div id="logoPi">
		<img src="Imagens/logoPI.png" width="300" height="125">
	</div>
	<div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2>Gerenciar <b>Produtos Delta</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
									class="material-icons">&#xE147;</i> <span>Adicionar Produto</span></a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID do Produto</th>
							<th>Nome do Produto</th>
							<th>Descrição do Produto</th>
							<th>Quantidade do Produto</th>
							<th>Preço do Produto</th>
							<th>Desconto do Produto</th>
							<th>Categoria ID</th>
							<th>Status do Produto</th>
							<th>Editar/Inativar Produto</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//Monta o comando de Inserção no Banco
						$cmd = $pdo->query("SELECT P.PRODUTO_ID,P.PRODUTO_NOME,P.PRODUTO_DESC,PE.PRODUTO_QTD,P.PRODUTO_DESCONTO,P.PRODUTO_PRECO,P.PRODUTO_ATIVO,C.CATEGORIA_ID,C.CATEGORIA_NOME,C.CATEGORIA_ATIVO
						FROM PRODUTO P 
						INNER JOIN 
						CATEGORIA C 
						ON P.CATEGORIA_ID = C.CATEGORIA_ID
						INNER JOIN
						PRODUTO_ESTOQUE PE 
						ON PE.PRODUTO_ID = P.PRODUTO_ID
						WHERE  PRODUTO_ATIVO=1
						ORDER BY PRODUTO_ID");
						?>
						<?php $resultado = $cmd->fetchAll(); ?>
						<?php
						foreach ($resultado as $linha) {
							?>
							<tr>
								<td>
									<?php
									echo $linha["PRODUTO_ID"];
									?>
								</td>
								<td>
									<?php
									echo $linha["PRODUTO_NOME"];
									?>
								</td>
								<td>
									<?php
									echo $linha["PRODUTO_DESC"];
									?>
								</td>
								<td>
									<?php
									echo $linha["PRODUTO_QTD"] . " Unidade(s)";
									?>
								</td>
								<td>
									<?php
									echo "R$" . $linha["PRODUTO_PRECO"];
									?>
								</td>
								<td>
									<?php
									echo "R$" . $linha["PRODUTO_DESCONTO"];
									?>
								</td>
								<td>
									<?php
									echo ($linha["CATEGORIA_ID"]);
									?>
								</td>
								<td>
									<?php
									if ($linha["PRODUTO_ATIVO"] == 00) {
										echo "Produto inativo";
									} else {
										echo "Produto Ativo";
									}
									?>
								</td>
								<td>
									<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
											data-toggle="tooltip" title="Editar">&#xE254;</i></a>
									<a href="#inativarProdutoModal" class="delete inativarProduto"
										data-produto-id="<?php echo $linha['PRODUTO_ID']; ?>" data-toggle="modal"><i
											class="material-icons" data-toggle="tooltip" title="Inativar">&#xE872;</i></a>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="InsertProdutos.php" id="form-inserir">
					<div class="modal-header">
						<h4 class="modal-title">Adicionar Produto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nome do Produto</label>
							<input type="text" class="form-control" name="nomeProduto" required>
						</div>
						<div class="form-group">
							<label>Descrição do Produto</label>
							<input type="text" class="form-control" name="descProduto" required>
						</div>
						<div class="form-group">
							<label>Preço do Produto</label>
							<input type="number" min="1" max="999" class="form-control" name="precoProduto" required>
						</div>
						<div class="form-group">
							<label>Desconto do Produto</label>
							<input type="number" max="999" class="form-control" name="descontoProduto" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Categoria</label>
							<div class="input-group mb-3">
								<select class="custom-select" name="categoriaID">
									<option selected>Escolha...</option>
									<?php
									$cmd = $pdo->query("SELECT * FROM CATEGORIA WHERE CATEGORIA_ATIVO=1");
									while ($linhaCategoria = $cmd->fetch()) { ?>
										<option value="<?php echo $linhaCategoria["CATEGORIA_ID"] ?>">
											<?php echo $linhaCategoria["CATEGORIA_ID"] . " - " . $linhaCategoria["CATEGORIA_NOME"]; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<input type="radio" name="produtoAtivo" value="1" checked> Ativo
								</div>
								<div class="input-group-text">
									<input type="radio" name="produtoAtivo" value="0"> Não Ativo
								</div>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label>Quantidade do Produto</label>
							<input type="number" min="1" max="999" class="form-control" name="qntProduto" required>
						</div>
						<div class="form-group">
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success" id="botaoEnviar"
									onclick="enviar();">Enviar</button>
								<script>
									function enviar() {
										document.getElementById("form-inserir").submit();
									}
								</script>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="EditProdutos.php">
					<div class="modal-header">
						<h4 class="modal-title">Editar Produto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nome do Produto</label>
							<input type="text" class="form-control" id="nomeDoProduto" required>
						</div>
						<div class="form-group">
							<label>Descrição do Produto</label>
							<input type="text" class="form-control" id="descDoProduto" required>
						</div>
						<div class="form-group">
							<label>Categoria do Produto</label>
							<textarea class="form-control" id="categDoProduto" required></textarea>
						</div>
						<div class="form-group">
							<label>Quantidade do Produto</label>
							<input type="number" class="form-control" id="qntDoProduto" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Inativar Modal HTML -->
	<div id="inativarProdutoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="InativarProdutos.php" id="formInativar">
					<input type="hidden" name="idProduto">
					<div class="modal-header">
						<h4 class="modal-title">Inativar Produto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Você tem certeza que quer inativar esse produto?</p>
						<p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Inativar" onclick="enviarInativo();">
						<script>
							function enviarInativo() {
								document.getElementById("formInativar").submit();
							}
						</script>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function () {
    $(".inativarProduto").click(function () {
        console.log($(this).data('produto-id'));
        $('[name="idProduto"]').val($(this).data('produto-id'));
    });
});
</script>

</html>
