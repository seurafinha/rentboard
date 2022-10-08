<!--
//index.php
!-->

<?php

include('database_connection.php');

session_start();

if(!isset($_SESSION['user_id']))
{
	header("location:login.php");
}

?>

<html>  
    <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Rent Board</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <link rel="stylesheet" href="assets/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    </head>  
    <body>  


	<?php include("includes/header.php") ?>

	<section class="games_sec">
		<div class="container">
			<div class="row">
			<?php 
                $pro_id_get = $_GET['proid'];
				$query = "SELECT * FROM products WHERE id='$pro_id_get'";
				$statement = $connect->prepare($query);
				$statement->execute();
				$result = $statement->fetchAll();
				foreach($result as $row)
				{
					$category_id=$row['cat_id'];
					$user_id=$row['user_id'];

					$getCat=mySQLi_query($connDb,"SELECT * from categories where id='$category_id'"); 
					$getCatrow=mySQLi_fetch_array($getCat);
					 
					$getUser=mySQLi_query($connDb,"SELECT * from login where user_id='$user_id'"); 
					$getUserrow=mySQLi_fetch_array($getUser); 

					echo '
					<div class="col-md-12">
						<div class="game_box card">
							<div class="card-header">
								<div class="game_img">
									<img src="upload/'.$row['pro_image'].'" />
								</div>
							</div>
							<div class="card-body">
								<div class="details">
									<h4>'.$row['pro_name'].'</h4>
									<p><span class="type"><b>Type:</b> '.$getCatrow["name"].'</span>
									<span class="price"><b>Preço Est.:</b> R$'.$row['pro_price'].'</span></p>
									<p><b>By:</b> '.$getUserrow['username'].'</p>
                                    
								</div>
							</div>
						</div>
					</div>
					';
				}
			?>
				
			</div>
		</div>
	</section>

    <br><br>

</body>
</html>