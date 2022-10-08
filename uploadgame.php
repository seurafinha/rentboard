<!--
//games.php
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
		<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>
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


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 55px;"><span class="panel_head">Upload Game</span> <button class="btn btn-danger" style="float:right;"><a href="games.php" style="text-decoration:none;color:#fff;">Meus jogos</a></button></div>
                    <div class="panel-body">
                        <form method="POST" enctype="multipart/form-data"> 
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control" name="title" placeholder="Título do jogo" required />
                            </div>
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="number" class="form-control" name="price" placeholder="0.00" required />
                            </div>
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control" name="type">
                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $statement = $connect->prepare($query);
                                        $statement->execute();
                                        $result = $statement->fetchAll();
                                        foreach($result as $row)
                                        {
                                            echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" class="form-control" name="pro_image" placeholder="Título do Jogo" required />
                            </div>
                            <div class="form-group"> 
                                <button class="btn btn-danger" name="submit" type="submit">Publicar Jogo</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

<?php





if(isset($_POST["submit"])) {
    global $connDb;
        $title = $_POST['title'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $time = date('Y-m-d H:i:s');
        $userid = $_SESSION['user_id'];

        $filename = $_FILES["pro_image"]["name"];

        $tempname = $_FILES["pro_image"]["tmp_name"];  

        $folder = "upload/".$filename;    

        $sql = "INSERT INTO products (cat_id,pro_name,user_id,pro_price,pro_image,status,created_at) 
                VALUES ('$type','$title','$userid','$price','$filename','0','$time')";
 
        mysqli_query($connDb, $sql);        
        if (move_uploaded_file($tempname, $folder)) {

            echo "<script>alert('Publicado com sucesso')</script>";

        }else{

            echo "<script>alert('Algo deu errado! Tente novamente')</script>";

    }

}




   

?>



    </body>
</html>



