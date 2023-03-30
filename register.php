<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {

	// Receber os valores do formulário
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	// Conectar ao banco de dados MySQL
	$host = "localhost";
	$usuario = "root";
	$senha_mysql = "";
	$banco = "Loja";

	$conexao = mysqli_connect($host, $usuario, $senha_mysql, $banco);

	if (mysqli_connect_errno()) {
		echo "Falha ao conectar ao banco de dados MySQL: " . mysqli_connect_error();
	} else {
		// Verificar se o email já está cadastrado
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$result = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($result) > 0) {
			$erro_email = "Esse email já está cadastrado. Por favor, use outro email.";
		} else {
			// Inserir os dados do usuário no banco de dados
			$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

			if (mysqli_query($conexao, $sql)) {
				echo "Usuário cadastrado com sucesso!";
				// Redirecionar para a página de login
				header("Location: login.php");
				exit(); // interromper a execução do script para evitar problemas com o redirecionamento
			} else {
				echo "Erro ao cadastrar o usuário: " . mysqli_error($conexao);
			}
		}

		mysqli_close($conexao); // Fechar a conexão com o banco de dados
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilo.css">
	<title>Document</title>
</head>

<body>

	<div class="caixa__login">
		<h2>Cadastro de Usuário</h2>

		<form method="post" action="register.php">
			<div class="caixa__login-input">
				<label for="nome"> </label>
				<input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
			</div>
			<br>
			<div class="caixa__login-input">
				<label for="email"> </label>
				<input type="email" name="email" id="email" placeholder="Digite seu email" required>
				<?php if (isset($erro_email)) { ?>
					<div class="error"><?php echo $erro_email; ?></div>
				<?php } ?>
			</div>
			<br>
			<div class="caixa__login-input">
				<label for="senha"> </label>
				<input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
			</div>
			<br>
			<div class="caixa__login-input">
				<label for="confirma_senha"> </label>
				<input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme sua senha" required>
			</div>
			<br>

			<a class="bnt">
				<form method="post" action="register.php">
					<input class="bnt-submit" type="submit" value="Cadastrar">
				</form>
			</a>

		</form>
	</div>

</body>

</html>