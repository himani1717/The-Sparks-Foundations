<!DOCTYPE html>
<html>
<head>
	<title>View customers</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" href = "scripting.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">


  <style type="text/css">
      .mytable{
    
    text-align: center;
    width: 100%;
    padding-top:100px;
    padding-bottom:100px;
    padding-left: 20px;
    padding-right: 20px;
    background: linear-gradient(to top, #000000 0%, #ffffff 120%);
    color: black;
    border: 1px double black;
    
  }
@import url('https://fonts.googleapis.com/css2?family=Chilanka&display=swap');
  .heading1{
    font-family: 'Acme', sans-serif;
    font-size: 20px;
    color: black;
    letter-spacing: 2px;

  }

  .col{
    align-items: center;
    text-align: center;
    font-size: 18px;
    font-family: verdana;
    background: green;

  }

  .dbcol{
    font-size: 15px;
    text-align: center;
    font-family: 'Alata', sans-serif;
    color:black;
    background: white;
    font-weight: bold;
    padding-top: 20px;
  }


  .tbutton{
    background:white;
  }
  </style>
</head>
<body>

  <?php
    require 'config.php';
    $query = "SELECT * FROM user_details";
    $result = mysqli_query($conn,$query);
?>


	<nav class="navbar navbar-default navbar-fixed-top container-fluid">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand mt-0" href="#"><img src="logo.png" class="logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
         <li ><a href="index.php">Home</a></li>
        <li class="active" ><a href="customers.php">customers</a></li>
       <!-- <li><a href="transfer.php">Transfer</a></li>-->
        <li><a href="transactions.php">transactions</a></li>
        <li><a href="about.php">about us</a></li>


      </ul>
   
    </div>
  </div>
</nav>



<div class="mytable">
  <div class="heading1">
  <p><strong>CUSTOMERS NAMES & CREDITS</strong></p>
</div>

       <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="col">SL NO.</th>
                                <th class="col">NAME</th>
                                <th class="col">EMAIL</th>
                                <th class="col">CREDITS</th>
                                <th class="col">ACTION</th>
                            </tr>
                        </thead>
                         <tbody>
                <?php
                    while($rows=mysqli_fetch_array($result)){
                ?>
                    <tr>
                        <td class="dbcol"><?php echo $rows['id'] ?></td>
                        <td class="dbcol"><?php echo $rows['name']?></td>
                        <td class="dbcol"><?php echo $rows['email']?></td>
                        <td class="dbcol"><?php echo $rows['credits']?></td>
                        <td class="tbutton"><a href="transfer.php?id=<?php echo $rows['id'];?>"> <button type="button" class="btn btn-success">Transfer</button></a></td>
                    </tr>
                <?php
                    }
                ?>

                        </tbody>
                    </table>
                </div>
                <div>
  <a href="transactions.php"><div type="button" class="btn btn-success">VIEW ALL TRANSACTIONS</div></a>
</div>
</div>




<footer>
	
	<div class="sociallinks">
      	      
            <a href="https://www.linkedin.com/in/himani-sharma-b4b621210/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/i.pikachu17"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>

      </div>
     <div class= "copyright">
      	© 2023 Himani Sharma All Rights Reserved	
	</div>
     
</footer>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>
</html>