<?php
// Verifica se o formulário de login foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Obtém as credenciais de login do usuário do formulário
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Verifica se as credenciais de login estão corretas
	if ($username == 'usuario' && $password == 'senha') {
		// Credenciais corretas, redireciona o usuário para a página principal da loja
		header('Location: index.php');
		exit();
	} else {
		// Credenciais incorretas, exibe uma mensagem de erro
		$error_msg = "Nome de usuário ou senha incorretos. Tente novamente.";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Página de Login</title>
</head>
<body>
	<h1>Bem-vindo à nossa loja</h1>
	
	<?php
	// Exibe uma mensagem de erro se as credenciais de login foram incorretas
	if (isset($error_msg)) {
		echo '<p style="color: red;">' . $error_msg . '</p>';
	}
	?>
	
	<form method="post" action="login.php">
		<label for="username">Nome de Usuário/E-mail:</label>
		<input type="text" id="username" name="username"><br><br>
		<label for="password">Senha:</label>
		<input type="password" id="password" name="password"><br><br>
		<input type="submit" value="Entrar">
	</form>
	<a href="#">Esqueceu sua senha?</a>
</body>
</html>
