<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $toUser = $_POST['to'];
    $amnt = $_POST['amount'];

    $sql = "SELECT * from user_details where id = $from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the credits are to be transferred.

    $sql = "SELECT * from user_details where id = $toUser";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

  if($amnt > $sql1['credits'])

    {

        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';  
        echo '</script>';
    }

     else if($amnt == 0){
         echo "<script>
         alert('please enter valid amount');
    </script>";
     }

    else {

        //if not then deduct the credits from the user's account that we selected.
        $newCredit = $sql1['credits'] - $amnt;
        $sql = "UPDATE user_details set credits = $newCredit where id=$from";
        mysqli_query($conn,$sql);



        $newCredit = $sql2['credits'] + $amnt;
        $sql = "UPDATE user_details set credits = $newCredit where id=$toUser";
        mysqli_query($conn,$sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transactions(`sender`, `receiver`, `credits`) VALUES ('$sender','$receiver','$amnt')";
        $tns=mysqli_query($conn,$sql);
        if($tns){
           echo "<script type='text/javascript'>
                    alert('Transaction Successfull!');
                    window.location='transactions.php';
                </script>";
        }
        $newCredit= 0;
        $amnt =0;
    }

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Transfer money</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" href = "scripting.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
<style type="text/css">

@import url('https://fonts.googleapis.com/css2?family=Krona+One&display=swap');
.head2{
    text-align: center;
    font-size: 30px;
    font-weight: bold;
    color:black;
    padding-top: 100px;
    font-family: 'Krona One', sans-serif;

}

.from,.tranto,.amount{

    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color:black;
    padding-top: 10px;
    font-family:verdana;
    text-transform: uppercase;

}


.from span{
    color: #990033;
}
@media only screen and (min-width: 600px){
    .section1,.section2{
  padding-left: 40%;
  padding-top: 20px;
  padding-bottom: 20px;
}

.tbtn{
    padding-bottom: 30px;
}


}


@media only screen and (max-width: 480px){
    .tbtn{
        padding-top: 50px;
        padding-bottom: 150px;
    }
}


.complete{
    background: linear-gradient(to top, #000000 0%, #ffffff 100%);
}


</style>
</head>
<body>
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
        <li ><a href="customers.php">customers</a></li>
        <!--<li class="active" ><a href="transfer.php">Transfer</a></li>-->
        <li><a href="transactions.php">transactions</a></li>
        <li><a href="about.php">about us</a></li>

      </ul>
   
    </div>
  </div>
</nav>

<div class="complete">

<div class="container divStyle">

<div class="head2">

    <p>Money transfer</p>

</div>
                   

            <?php
                include 'config.php';
                 $sid=$_GET['id'];
                 $sql = "SELECT * FROM  user_details where id = $sid";


                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_array($query);
            ?>


<form method="post" name="tcredit" class="tabletext" ><br/>


<div class="from">

    <p>From - <span><?php echo $rows['name'] ?></span></p>

</div class="card">


   <p class="tranto">To</p>
   <div class="section1">
   <div class="col-6 col-md-4">
        <select class=" form-control"  data-style="btn-info" name="to" required>
            <option value="" disabled selected> </option>
             
                <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM user_details where id!=$sid";
                $query=mysqli_query($conn,$sql);
                if(!$query)
                {
                    echo "Error ".$sql."<br/>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_array($query)) {
                ?>
                <option value= "<?php echo $rows['id'];?>">
                       <?php echo $rows['name'] ;?>
                </option>
            <?php
                }
            ?>

        
        </select> 
    </div>
    </div>
    <br><br>


            <p class="amount">Amount</p>
            <div class="section2">
            <div class="col-6 col-md-4">
            <input type="number" id="amm" class="form-control" name="amount" min="0" required  /> 
            </div>
            </div>
<br>
<br>
<div class="tbtn">
 <div class="text-center btn3" >
            <button class="btn btn-danger" name="submit" type="submit" id="myBtn">Proceed</button>
            </div></div>

               
        </form>
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>
</html>