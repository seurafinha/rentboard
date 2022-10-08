<!--
//register.php
!-->

<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST["register"]))
{
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$check_query = "
	SELECT * FROM login 
	WHERE username = :username
	";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':username'		=>	$username
	);
	if($statement->execute($check_data))	
	{
		if($statement->rowCount() > 0)
		{
			$message .= '<p><label>Usuário já existe</label></p>';
		}
		else
		{
			if(empty($username))
			{
				$message .= '<p><label>É necessário informar um nome de usuário</label></p>';
			}
			if(empty($password))
			{
				$message .= '<p><label>É necessário informar uma senha</label></p>';
			}
			else
			{
				if($password != $_POST['confirm_password'])
				{
					$message .= '<p><label>As senhas não são iguais</label></p>';
				}
			}
			if($message == '')
			{
				$data = array(
					':username'		=>	$username,
					':password'		=>	password_hash($password, PASSWORD_DEFAULT)
				);

				$query = "
				INSERT INTO login 
				(username, password) 
				VALUES (:username, :password)
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$message = "<label>Cadastro realizado! Já pode logar</label>";
				}
			}
		}
	}
}

?>

<html>  
    <head>  
        <title>Rent Board</title> 
		<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body style="background-color: #dd5252;">  
        <div class="container">
			<br />
			
			<h3 align="center" style="color:#fff;">RENT BOARD</a></h3><br />
			<br />
			<div class="panel panel-default"  style="    width: 60%;
    margin: 0 auto;">
  				<div class="panel-heading">Preencha os dados abaixo e faça o seu cadastro</div>
				<div class="panel-body">
					<form method="post">
						<span class="text-danger"><?php echo $message; ?></span>
						<div class="form-group">
							<label>Usuário novo</label>
							<input type="text" name="username" class="form-control" />
						</div>
						<div class="form-group">
							<label>Sua senha</label>
							<input type="password" name="password" class="form-control" />
						</div>
						<div class="form-group">
							<label>Confirmar senha</label>
							<input type="password" name="confirm_password" class="form-control" />
						</div>
						<div class="form-group">
							<input type="submit" name="register" class="btn btn-info" value="Cadastrar" />
						</div>
						<div align="center">
							<a href="login.php">LOGIN</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>  
</html>
