<html>  
    <head>
		<meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head> 
<header class="header">
</html>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">RENT BOARD</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
        <li><a href="chat.php">Inbox</a></li>
        <li><a href="offers.php">Propostas e Negócios</a></li>
        <li><a href="games.php">Meu jogos</a></li> 
        <li><a href="notifications.php">Notificações</a></li> 
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>

<section class="heroSection">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="mainSearch">



          <form action="search.php" method="GET">
            <div class="row">

              <div class="col-md-6">
                <div class="form">
                  <input class="form-control" type="text" name="keywords" placeholder="Digite aqui sua busca..." />
                </div>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="gameType">
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
              <div class="col-md-3">
                <button class="btn btn-danger form-control" type="submit" name="search">Buscar</button>
              </div>

            </div>
          </form>


        </div>
      </div>
    </div>
  </div>
</section>