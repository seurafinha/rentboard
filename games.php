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
        <title> Meus Jogos - Rent Board</title>  
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
                    <div class="panel-heading" style="height: 55px;"><span class="panel_head">Meu jogos</span> <button class="btn btn-danger" style="float:right;"><a href="uploadgame.php" style="text-decoration:none;color:#fff;">Publicar novo jogo</a></button></div>
                    <div class="panel-body">
                    <div class="table-responsive">  
                        <table class="table table-striped" style="width: 100%; ">
                            <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Título</th>
                                <th>Preço</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $userid = $_SESSION['user_id'];
                                    $query = "SELECT * FROM products WHERE user_id='$userid'";
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    $result = $statement->fetchAll();
                                    foreach($result as $row)
                                    {
                                        $catId = $row['cat_id'];
                                        $getCat=mySQLi_query($connDb,"SELECT * from categories where id='$catId'"); 
                                        $getCatrow=mySQLi_fetch_array($getCat);
                                        
                                        echo "
                                       
                                        <tr>
                                            <td style='width: 143px;'><img class='pro_img' src='upload/".$row['pro_image']."' /></td>
                                            <td>".$row['pro_name']."</td>
                                            <td>R$".$row['pro_price']."</td>
                                            <td>".$getCatrow['name']."</td>
                                            <td style='width: 196px;'>";
                                            if($row['status'] == 0){
                                                echo " <a class='btn btn-success' href='sendOffer.php?proid=".$row['id']."'>Enviar proposta</a>
                                                <a class='btn btn-danger' href='delete_pro.php?proid=".$row['id']."'>Apagar</a>
                                                ";
                                            }else{
                                                echo " <button class='btn btn-primary' disabled>Alugado</button>";
                                            }
                                               
                                                
                                           echo"   
                                            </td>
                                        </tr>
                                        ";
                                    }
                                ?>
                             
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>



    </body>
</html>



