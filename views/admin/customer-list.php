<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shopet</title>

	<link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon" />
	<link rel="stylesheet" href="../css/dropdown.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
	integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery-3.4.0.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/customer-list.js"></script>
	<script>
		$(function(){
			$("#successMessage").hide();
			$("#errorMessage").hide();
		});
	</script>
</head>

<body onload="onload()">
	<?php include "navbar.php"; ?>
	<div class="alert alert-success" id="successMessage" style="color:green;">
		<strong>Cliente excluido com sucesso.</strong>
	</div>
	<div class="alert alert-danger" id="errorMessage" style="color: red;">
		<strong>Ocorreu uma falha ao executar a operação: </strong><span id="message"></span>
	</div>
	<div class="container-fluid">
		<div id="cart">
			<br>
			<h3 class="page-header">Clientes</h3>
			<hr />
			<br>

			<div class="container mb-4">
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col"> </th>
										<th scope="col" class="text-center">ID</th>
										<th scope="col" class="text-center">CPF</th>
										<th scope="col" class="text-center">Nome</th>
										<th scope="col" class="text-center">E-mail</th>
										<th scope="col" class="text-center">Telefone</th>
										<th scope="col" class="text-center">Data de nascimento</th>
										<th scope="col" class="text-center">Profissão</th>
										<th> </th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div id="modals">
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>