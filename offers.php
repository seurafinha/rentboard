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
                    <div class="panel-heading" style="height: 55px;"><span class="panel_head">Negócios </span> <button class="btn btn-danger" style="float:right;"><a href="index.php" style="text-decoration:none;color:#fff;">Voltar</a></button></div>
                    <div class="panel-body">
                        <div class='row offerspage'> 
                            <?php 
                                $userid = $_SESSION['user_id'];
                                $query = "SELECT * FROM deals WHERE borower_id='$userid'";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();

                                foreach($result as $row)
                                { 
                                    $offerid= $row['id'];
                                    $pro_id= $row['pro_id'];
                                    $offerby= $row['user_id'];
                                    $pro_price= $row['pro_price'];
                                    $installments= $row['installments'];
                                    $per_month= $row['per_month'];
                                    $status= $row['status'];

                                    $getTitle=mySQLi_query($connDb,"SELECT * from products where id='$pro_id'"); 
					                $getTitlerow=mySQLi_fetch_array($getTitle);
                                    
                                    $getUser=mySQLi_query($connDb,"SELECT * from login where user_id='$offerby'"); 
					                $getUserrow=mySQLi_fetch_array($getUser);

                                    echo '
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4>Oferta de: <span>'.$getUserrow['username'].'</span></h4>
                                                    <p>'.$getTitlerow['pro_name'].'</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <a style="    margin-top: 18px; float: right;" class="btn btn-danger" href="viewOffer.php?proid='.$pro_id.'&offerid='.$offerid.'">Ver proposta</a>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    ';
                                }
                            ?>  
                        </div>             
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    
    
  


    </body>
</html>



