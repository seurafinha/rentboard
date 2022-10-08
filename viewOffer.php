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
                    <div class="panel-heading" style="height: 55px;"><span class="panel_head">Details</span> <button class="btn btn-danger" style="float:right;"><a href="offers.php" style="text-decoration:none;color:#fff;">Voltar</a></button></div>
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
                                            <h5><span>Preço Estimado </span> R$".$row['pro_price']."</h5>
                                        </div>
                                         
                                    
                                    ";
                                }
                            ?> 
                            <div class="col-md-8">
                                <div class="main_form viewOfferDetails">
                                    <?php
                                        $offerid = $_GET['offerid'];
                                        $getOffer=mySQLi_query($connDb,"SELECT * from deals where id='$offerid'"); 
					                    $getOfferrow=mySQLi_fetch_array($getOffer); 

                                        $useridOffer = $getOfferrow['user_id'];
                                        $pro_priceOffer = $getOfferrow['pro_price'];
                                        $per_monthOffer = $getOfferrow['per_month'];
                                        $installmentsOffer = $getOfferrow['installments'];
                                        $statusOffer = $getOfferrow['status'];
                                        $paid_instmts = $getOfferrow['paid_instmts'];
                                        $last_Installment_date = $getOfferrow['last_Installment_date'];
                                        $createdOffer = $getOfferrow['created_at'];


                                        $getUser=mySQLi_query($connDb,"SELECT * from login where user_id='$useridOffer'"); 
					                    $getUserrow=mySQLi_fetch_array($getUser);

                                    ?>
                                    <h4 class="">Proposta de: <span style="color:#e55f62;"><?php echo $getUserrow['username']; ?></span></h4>

                                    <h5>Valor total: R$ <span style="color:#e55f62;"><?php echo $pro_priceOffer; ?></span> </h5>
                                    <h5>Período de locação: <span style="color:#e55f62;"><?php echo $installmentsOffer; ?> meses</span> </h5>
                                    <h5>Pagamento mensal: R$ <span style="color:#e55f62;"><?php echo $per_monthOffer; ?></span> </h5>
                                    <br><br>
                                    <?php if($statusOffer == 0 && $paid_instmts == 0) {
                                    ?>
                                        <form method="POST">
                                            <input type="text" name="dealsid" value="<?php echo $offerid; ?>" hidden />  
                                            <button type="Submit" name="submitOffer" class="btn btn-success">
                                                Pagar Agora
                                            </button> 
                                        </form>
                                    <?php
                                    }elseif($statusOffer == 1){

                                        // $getNextDate=mySQLi_query($connDb,"SELECT * from installRecords where deals_id='$offerid' ORDER BY id DESC LIMIT 1"); 
					                    // $getNextDaterow=mySQLi_fetch_array($getNextDate);
                                        // $previousDate= $getNextDaterow['created_at'];
                                        // $FirstDate = date("Y-m-d",strtotime($previousDate));

                                        // $newdate = strtotime ( '+1 month' , strtotime ( $previousDate ) ) ;
                                          

                                        ?>
                                            <!--<span class="next_evaluation"><b>Current Installment is PAID on <?php //echo $FirstDate; ?></b>. <span style="color: #e55f62;">Next Installment Date is: <?php //echo date('Y-m-d', $newdate);   ?></span></span>-->
                                        <?php
                                    }
                                    ?>
                                    
                                    <?php

                                        
                                        if(isset($_POST["submitOffer"])) {
                                            global $connDb;
                                                $dealsid = $_POST['dealsid'];
                                                $userId = $_SESSION['user_id']; 
                                                $time = date('Y-m-d H:i:s'); 
                                                $proid = $_GET['proid'];
                                                
                                                $getOffer=mySQLi_query($connDb,"SELECT * from deals where id='$offerid'"); 
					                            $getOfferrow=mySQLi_fetch_array($getOffer); 

                                                $paid_instmts = $getOfferrow['paid_instmts'];
                                                $installmentAdd = $paid_instmts+1;
                                                
                                                $sql = "UPDATE deals SET status='1', paid_instmts='$installmentAdd', last_Installment_date='$time', delay_status='0' WHERE id='$dealsid'";
                                        
                                                $QueryRun = mysqli_query($connDb, $sql); 

                                                if ($QueryRun) {

                                                    $productUpdate = "UPDATE products SET status='1' WHERE id='$proid'";
                                                    mysqli_query($connDb, $productUpdate);
                                                    if (mysqli_query($connDb, $productUpdate) ) {
                                                        
                                                        echo "<script>alert('Pagamento confirmado')</script>";
                                                        
                                                    } else {
                                                    echo "Error updating record: " . mysqli_error($conn);
                                                    }
                                                   

                                                }else{

                                                    echo "<script>alert('Something went wrong')</script>";

                                            }

                                        }


                                        $offerid = $_GET['offerid'];
                                        $getOffer=mySQLi_query($connDb,"SELECT * from deals where id='$offerid'"); 
                                        $getOfferrow=mySQLi_fetch_array($getOffer); 

                                        $oldPaidVal= $getOfferrow['paid_instmts']; 

                                        $paid_instmts= $getOfferrow['paid_instmts']+1; 
                                        $useriddeal= $getOfferrow['user_id']; 

                                        $last_Installment_date= $getOfferrow['last_Installment_date'];
                                        $prevInstal = date("Y-m-d",strtotime($last_Installment_date));

                                        $newInstal = strtotime ( '+1 month' , strtotime ( $last_Installment_date ) ) ;
                                        

                                        $Fnewdate = date('m', $newInstal);
 
                                        $timeNow = date('m');
 

                                        if($timeNow > $Fnewdate){
                                            if($oldPaidVal !== '0'){
                                                echo '<form method="POST">
                                                    <input type="text" name="dealsid" value="'.$offerid.'" hidden />  
                                                    <button type="Submit" name="submitOffer" class="btn btn-success">
                                                        Pay Now Your Next Installment No.'.$paid_instmts.' 
                                                    </button> 
                                                    <span> Or Return the Game to Owner otherwise your account can be blocked </span>
                                                </form>';
                                                $deaUpdate = "UPDATE deals SET delay_status='1' WHERE id='$offerid'";
                                                mysqli_query($connDb, $deaUpdate);

                                            }
                                            
                                         
                                        // $userid= $_SESSION['user_id'];
                                        // $sql = "INSERT INTO lateinstall (deals_id,user_id,borower_id,messagae,created_at) 
                                        // VALUES ('$offerid','$useriddeal','$userid','Installment date is exceeds from the due date and if your game is not returned the click block button','$filename','0','$time')";
                                        
                                        // if(isset($_POST["submitOfferNext"])) {
                                        //     global $connDb;
                                        //         $dealsid = $_POST['dealsid'];
                                        //         $userId = $_SESSION['user_id']; 
                                        //         $time = date('Y-m-d H:i:s'); 
                                        //         $proid = $_GET['proid'];
                                                
                                        //         $getOffer=mySQLi_query($connDb,"SELECT * from deals where id='$offerid'"); 
					                    //         $getOfferrow=mySQLi_fetch_array($getOffer); 

                                        //         $paid_instmts = $getOfferrow['paid_instmts'];
                                        //         $installmentAdd = $paid_instmts+1;
                                                
                                        //         $sqlN = "UPDATE deals SET status='1', paid_instmts='$installmentAdd', last_Installment_date='$time' WHERE id='$dealsid'";
                                        
                                        //         $QueryRun = mysqli_query($connDb, $sqlN); 
                                        //         // print_r($sqlN);
                                        //         if ($QueryRun) {

                                        //             $productUpdate = "UPDATE products SET status='1' WHERE id='$proid'";
                                        //             mysqli_query($connDb, $productUpdate);
                                        //             if (mysqli_query($connDb, $productUpdate) ) {
                                                        
                                        //                 echo "<script>alert('Successfully Paid')</script>";
                                                        
                                        //             } else {
                                        //             echo "Error updating record: " . mysqli_error($conn);
                                        //             }
                                                   

                                        //         }else{

                                        //             echo "<script>alert('Something went wrong')</script>";

                                        //     }

                                        // }   


                                        }else{
                                            $getNextDate=mySQLi_query($connDb,"SELECT * from deals where id='$offerid'"); 
                                            $getNextDaterow=mySQLi_fetch_array($getNextDate);
                                            $previousDate= $getNextDaterow['last_Installment_date'];
                                            $FirstDate = date("Y-m-d",strtotime($previousDate));

                                            $newdate = strtotime ( '+1 month' , strtotime ( $previousDate ) ) ;
                                            


                                            // ?>
                                                <span class="next_evaluation"><b>A parcela atual foi paga em <?php echo $FirstDate; ?></b>. <span style="color: #e55f62;">A próxima cobrança será em: <?php echo date('Y-m-d', $newdate);   ?></span></span>
                                            <?php
                                        }

                                    ?>
                                </div>
                            </div>
                        </div>             
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    
 


    </body>
</html>



