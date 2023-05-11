<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gerenciamento de usuario Delta</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="Css\TelaGerenciarUsuarios.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script> src="\Js\TelaGerenciarUsuarios"</script>
<?php include "ConectaMySQLDelta.php";
	$pdo = conectSQL();
	?>
</head>
<body>
<div id = "logoPi">
		<img src = "Imagens/logoPI.png" width="300px" height="125px">
	</div>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Gerenciamento de <b>Usuário Delta</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="#adicionaruser" class="btn btn-secondary" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Adicionar Usuário</span></a>	
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Usuário</th>
                        <th>Nome Usuario</th>						
                        <th>Email do Usuario</th>
                        <th>Senha do Usuario</th>
                        <th>CPF do Usuario</th>
                    </tr>
                </thead>
                <?php
                //Monta o comando de Inserção no Banco
                $cmd = $pdo->query("SELECT USUARIO_ID, USUARIO_NOME, USUARIO_EMAIL, USUARIO_SENHA, USUARIO_CPF
                FROM USUARIO
                ORDER BY USUARIO_ID");
                ?>
                <?php
                while ($linha = $cmd->fetch()) {
                ?>
                    <tr>
                        <td>
                            <?php
                            echo $linha["USUARIO_ID"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $linha["USUARIO_NOME"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $linha["USUARIO_EMAIL"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $linha["USUARIO_SENHA"];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $linha["USUARIO_CPF"];
                            ?>
                        </td>
                    <?php
                }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>     
<div id="#adicionaruser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="AdicionarUsuario.php" id="form-inserir">
					<div class="modal-header">
						<h4 class="modal-title">Adicionar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nome do Usuario</label>
							<input type="text" class="form-control" name="nomeUsuario" required>
						</div>
						<div class="form-group">
							<label>Email do Usuario</label>
							<input type="text" class="form-control" name="EmailUsuario" required>
						</div>
						<div class="form-group">
							<label>Senha do Usuario</label>
							<input type="text" class="form-control" name="SenhaUsuario" required>
						</div>
						<div class="form-group">
							<label>CPF do Usuario</label>
							<input type="number" max="99999999999" class="form-control" name="CPFusuario" required>
						</div>
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-success" id="botaoEnviar" onclick="enviar();">Enviar</button>
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
</body>
</html>
