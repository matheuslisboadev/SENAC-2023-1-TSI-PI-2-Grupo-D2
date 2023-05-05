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
	<link rel="stylesheet" type="text/css" href="Css\cssTelaGerenciarProdutos.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="Js\jsTelaGerenciarProdutos.js"></script>
	<?php include "ConectaMySQLDelta.php";
	$pdo = conectaSQL();
	?>
</head>

<body>
	<div id="logoPi">
		<img src="Imagens/logoPI.png" width="300px" height="125px">
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
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Produto</span></a>
							<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Deletar Produto</span></a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>ID do Produto</th>
							<th>Nome do Produto</th>
							<th>Descrição do Produto</th>
							<th>Preço do Produto</th>
							<th>Desconto do Produto</th>
							<th>Categoria ID</th>
							<th>Produto Ativo</th>
							<th>Editar/Excluir Produto</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							//Monta o comando de Inserção no Banco
							$cmd = $pdo->query("SELECT P.PRODUTO_ID,P.PRODUTO_NOME,P.PRODUTO_DESC,P.PRODUTO_DESCONTO,P.PRODUTO_PRECO,P.PRODUTO_ATIVO,C.CATEGORIA_ID,C.CATEGORIA_NOME,C.CATEGORIA_ATIVO
							FROM PRODUTO P 
							INNER JOIN 
							CATEGORIA C ON P.CATEGORIA_ID = C.CATEGORIA_ID
							WHERE  PRODUTO_ATIVO=1
							ORDER BY PRODUTO_ID");
							?>
							<?php
							while ($linha = $cmd->fetch()) {
							?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox2" name="options[]" value="1">
									<label for="checkbox2"></label>
							</td>
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
								<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>
							<td>
							<?php
							}
							?>
							</td>
						</tr>
						</tr>
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Mostrando <b>5</b> de <b>25</b> páginas.</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Anterior</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Próximo</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
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
							<input type="text" class="form-control" name="precoProduto" required>
						</div>
						<div class="form-group">
							<label>Desconto do Produto</label>
							<input type="text" class="form-control" name="descontoProduto" required>
						</div>
						<div class="form-group">
								<label for="exampleInputEmail1">Categoria</label>
								<div class="input-group mb-3">
							<select class="custom-select" name="categoriaProd" id="inputGroupSelect01">
								<option selected>Escolha...</option>
								<?php
								$cmd = $pdo->query("SELECT * FROM CATEGORIA WHERE CATEGORIA_ATIVO=1");
								while($linha = $cmd->fetch()){?>
								<option value="<?php echo $linha["CATEGORIA_ID"]?> " name = "categoriaID"><?php echo $linha["CATEGORIA_NOME"];
								?>
							<?php }?>
										</option> 
								</select>
							</div>
					</div>
					<div class="form-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="radio" name="produtoAtivo" value=true>Ativo 
							</div>
								<div class="input-group-text">
									<input type="radio" name="produtoInativo" value=false>Não Ativo
					   			</div>
						</div>
					</div>
						<div class="form-group">
							<label>Quantidade do Produto</label>
							<input type="number" min = "1" max="999" class="form-control" name ="qntProduto" required>
						</div>
					</div>
						<div class="form-group">
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Enviar" name="Enviar">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
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
							<input type="text" class="form-control"  id="descDoProduto" required>
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
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Deletar Produto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Você tem certeza que quer deletar esse produto?</p>
						<p class="text-warning"><small>Essa ação não pode ser desfeita.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Deletar">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
