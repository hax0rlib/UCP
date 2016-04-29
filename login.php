<html>
<title>UCP SA-MP - Login</title>
<body align = "center">
<font face = "Verdana">
<?php
include "autoload.php";

session_start();

if (isset($_POST['login']))
{
	$nome = $_POST['nome'];
	$stmt = $db->prepare("SELECT * FROM player_info WHERE name = ?");
	$stmt = $db->bindParam(1, $nome);
	$stmt->execute();
	$rows = $db->rowCount($stmt);
	if ($rows)
	{
		$senha = $_POST['senha'];
		$stmt = $db->prepare("SELECT * FROM player_info WHERE name = ? AND password = ?");
		$stmt = $db->bindParam(1, $nome);
		$stmt = $db->bindParam(2, $senha);
		$stmt->execute();
		$rows = $db->rowCount($stmt);
		if ($rows)
		{
			$dados = $rows->fetch(PDO::FETCH_ASSOC);
			$nome = $dados['name'];
			$_SESSION['username'] = $nome;
			header('location: perfil.php');
		}
		else
		{
			echo "Erro: Senha incorreta.<br />";
		}
	}
	else
	{
		echo "Não há nenhum usuário registrado com este nome.<br />";
		echo "Porém, você pode se registrar clicando <a href = 'registro.php'>aqui</a>.<br />";
	}
}

?>
<form method = "post" action = "">
        Nome:<br /><input type = "text" name = "nome"><br />
        Senha:<br /><input type = "password" name = "senha"><br /><br />
        <input type = "submit" name = "login" value = "Login">
</form>
</font>
</body>
</html>
