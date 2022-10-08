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
                    <div class="panel-heading" style="height: 55px;"><span class="panel_head">Enviar oferta para o locatário</span> <button class="btn btn-danger" style="float:right;"><a href="games.php" style="text-decoration:none;color:#fff;">Voltar</a></button></div>
                    <div class="panel-body">
                        <div class='row offerspage'> 
                            <?php 
                                $proid = $_GET['proid'];
                                $query = "SELECT * FROM products WHERE id='$proid'";
                                $statement = $connect->prepare($query);
                                $statement->execute();
                                $result = $statement->fetchAll();

                                foreach($result as $row)
                                { 
                                    echo "
                                    
                                        <div class='col-md-4'>
                                            <img class='pro_img' src='upload/".$row['pro_image']."' /></td>
                                            <h4>".$row['pro_name']."</h4>
                                            <h5><span>Preço Estimado: </span> R$".$row['pro_price']."</h5>
                                        </div>
                                         
                                    
                                    ";
                                }
                            ?> 
                            <div class="col-md-8">
                                <div class="main_form">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Oferta para:</label>
                                                    <select class="form-control" name="sent_to">
                                                        <?php
                                                            
                                                            $query = "SELECT * FROM login WHERE status='0'";
                                                            $statement = $connect->prepare($query);
                                                            $statement->execute();
                                                            $result = $statement->fetchAll();
                                                            foreach($result as $row)
                                                            {
                                                                echo '<option value="'.$row['user_id'].'">'.$row['username'].'</option>';
                         
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <h3>Termos</h3>
                                        <div class="row">
                                            <div class="col-md-4">
                                                
                                                <div class="form-group">
                                                    <label>Período de locação:</label>
                                                    <select id="yearsPer" class="form-control" name="yearsper">
                                                        <option value="1">1 mês</option>
                                                        <option value="2">2 meses</option>
                                                        <option value="3">3 meses</option>
                                                        <option value="4">4 meses</option>
                                                        <option value="5">5 meses</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4"> 
                                                <div class="form-group">
                                                    <label>Preço Final R$:</label>
                                                    <input class="form-control" id="final_price" type="number" name="final_price" placeholder="0.00" />
                                                </div>
                                            </div>
                                            <div class="col-md-4"> 
                                                <div class="form-group"> 
                                                    <label>Parcela semanal:</label><br>
                                                    <span>Preço total / Meses</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" type="submit" name="submit">Enviar Oferta</button>
                                    </form>
                                </div>
                            </div>
                        </div>             
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    
     <?php
                
        if(isset($_POST["submit"])) {
            global $connDb;
                $proid = $_GET['proid'];
                $sent_to = $_POST['sent_to'];
                $userid = $_SESSION['user_id'];
                $yearsper = $_POST['yearsper'];
                $final_price = $_POST['final_price'];
                $totalMonths = $yearsper * 1;
                $perMonth = $final_price / $totalMonths;

                $time = date('Y-m-d H:i:s'); 

                $sql = "INSERT INTO deals (pro_id,user_id,borower_id,pro_price,installments,per_month,status,created_at) 
                        VALUES ('$proid','$userid','$sent_to','$final_price','$yearsper','$perMonth','0','$time')";
        
                $runQuery = mysqli_query($connDb, $sql);        
                if ($runQuery) {

                    echo "<script>alert('O seu pedido foi enviado: Pagamento mensal: ".$perMonth." por um período de ".$yearsper." meses')</script>";

                }else{

                    echo "<script>alert('Something went wrong! Try Again')</script>";

            }

        }

     ?>
  


    </body>
</html>



