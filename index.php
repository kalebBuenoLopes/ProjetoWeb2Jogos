<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!--Tags básicas do head-->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Jogos</title>
	<!--Link dos nossos arquivos CSS e JS padrão-->
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script src="js/scripts.js"></script>
	<!--Link dos arquivos CSS e JS do Bootstrap-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>

<body>

	<?php
	include_once "jogoview.php";
	include_once "jogoDAO.php";
	include_once "jogo.php";
	include_once "usuarioDAO.php";

	$con = Conexao::getConexao();

	session_start();

	$_SESSION["logado"] = false;

	if (isset($_POST["entrar"])) {
		$usuario = $_POST["txtUsuario"];
		$senha = $_POST["txtSenha"];

		if (UsuarioDAO::logar($usuario, $senha)) {
			session_cache_expire(10);
			$_SESSION["logado"] = true;
			header("Location: listagem.php");
			
		}
	}

	?>

	<div class="container">
		<br>
		<form method="post" action="index.php">
			<div class="row" style="background-color: black; color: white;">
				<div class="col-md-5" style="font-size:1.2em">
					<strong>Quer editar os jogos?</strong>
				</div>
				<div class="col-md-1 text-center">
					Usuário:
				</div>
				<div class="col-md-2">
					<input class='ajustavel' type='text' name='txtUsuario' value='' style="color:black">
				</div>
				<div class="col-md-1 text-center">
					Senha:
				</div>
				<div class="col-md-2">
					<input class='ajustavel' type='password' name='txtSenha' value='' style="color:black">
				</div>
				<div class="col-md-1">
					<button class='btn-primary' type='submit' name='entrar' value='entrar'>Entrar</button>
				</div>
			</div>
		</form>
		<br>
		<div class="row text-center" id="titulo">
			<div class="col-md-12">
				<h1>Jogos</h1>
			</div>
		</div>

		<?php

		$listagem = JogoDAO::getJogos("idjogo", "desc", "", "");
		JogoView::gerarCard($listagem);

		?>

	</div>
</body>

</html>