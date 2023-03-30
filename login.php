<?php
// Verifica se o formulário de login foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {

    // Conectar ao banco de dados MySQL
    $host = "localhost";
    $usuario = "root";
    $senha_mysql = "";
    $banco = "Loja";

    $conn = mysqli_connect($host, $usuario, $senha_mysql, $banco);

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Obtém as credenciais de login do usuário do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para buscar usuário e senha no banco de dados
    $sql = "SELECT * FROM usuarios WHERE (email='$username' OR nome='$username') AND senha='$password'";
    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta SQL retornou algum resultado
    if (mysqli_num_rows($result) > 0) {
        // Credenciais corretas, redireciona o usuário para a página principal da loja
        header('Location: index.php');
        exit();
    } else {
        // Credenciais incorretas, exibe uma mensagem de erro
        $error_msg = "Nome de usuário ou senha incorretos. Tente novamente.";
    }
    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
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
		<h2>Bem-vindo à nossa loja</h2>

			<form method="post" action="login.php">
				<div class="caixa__login-input">
				<label for="username">   </label>
				<input type="text" id="username" name="username" placeholder="Digite seu nome de usuário ou e-mail"><br><br>
				</div>

				<div class="caixa__login-input">
				<label for="password">   </label>
				<input type="password" id="password" name="password"  placeholder="Digite sua senha"><br><br>
				</div>

				<?php
				// Exibe uma mensagem de erro se as credenciais de login foram incorretas
				if (isset($error_msg)) {
					echo '<p style="color: red; text-align: center;">' . $error_msg . '</p>';
				}
				?>


				<a class="bnt-entrar">

					<span></span>
					<span></span>
					<span></span>
					<span></span>
					
					<input class="bnt-submit" type="submit" value="Entrar">
				</a>
				
				<a class="bnt" href="register.html">Registrar</a>
				<a class="bnt" href="#">Esqueceu sua senha?</a>
			</form>
	</div>
</body>
</html>




