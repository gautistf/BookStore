<!--<?php
#session_start();
##header("location: index.php?Message=Login To Continue")
?>-->



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<meta name="description" content="books">
	<meta name="author" content="gautam">

	<title>Online Book Store</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="my.css" rel="stylesheet">
	<style>
	Styling still too do
	</style>
	
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type ="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>

				</button>
				<a class="navbar-brand" href="index.php"><img alt="Brand" src="img/logo.jpg" style="width: 118px;margin-top: -7px;margin-left: -10px;"></a>
			</div>
			<!-- Collect the nav links,forms,and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<?php
						if(isset($_SESSION['user']))
						{
							echo '<li>
							<a href="cart.php" class="btn btn-md"><span class="glyphicon glyphicon-shopping-cart">Cart</span></a></li>
                    <li><a href="destroy.php" class="btn btn-md"> <span class="glyphicon glyphicon-log-out">LogOut</span></a></li>';
						}
						?>

				</ul>
			</div><!--  /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	 <div id="top" >
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" action="Result.php" method="post">
                    <input type="text" name="keyword" class="form-control" placeholder="Search for a Book , Author Or Category" style="width:80%;margin:20px 10% 20px 10%;">
                </form>
            </div>
        </div>
   </div>

   <!--php portion here -->
   <?php
   include "dbconnect.php";
   $PID=$_GET['ID'];
   $query = "SELECT * FROM products WHERE PID='$PID'";
   $result = mysqli_query ($con,$query)or die(mysql_error());

   		if(mysqli_num_rows($result)> 0)
   		{
   			while($row = mysqli_fetch_assoc($result))
   			{
   				$path="img/books/".$row['PID'].".jpg";
   				$target= "cart.php?ID=".$PID."&";

echo '
	<div class="container-fluid" id="books">
		<div class="row">
			<div class="col-sm-10 col-md-6">
						<div class="tag">'. $row["Discount"].'%OFF </div>
							<div class="tag-slide"><img src="img/orange-flag.png">
							</div>
							 <img class="center-block img-responsive" src=" '.$path.'" height="550px" style="padding:20px;">
			</div>
			<div class="col-sm-10 col-md-4 col-md-offset-1">
				<h2> '.$row["Title"] . '</h2>
											<span style="color:#00B9F5"> 
											#'.$row["Author"].'&nbsp &nbsp #'.$row["Publisher"].'
											</span>
											<hr>

											<span style="font-weight:bold;"> Quantity : </span>';
                                echo'<select id="quantity">';
                                   for($i=1;$i<=$row['Available'];$i++)
                                       echo '<option value="'.$i.'">'.$i.'</option>';
                               echo ' </select>';
echo'                           <br><br><br>
                                <a id="buyLink" href="'.$target.'" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                    ADD TO CART for Rs '.$row["Price"] .' <br>
                                    <span style="text-decoration:line-through;"> RS'.$row["MRP"].'</span> 
                                    | '.$row["Discount"].'% discount
                                 </a> 

      </div>
    </div>
          </div>
     ';
echo '
          <div class="container-fluid" id="description">
    <div class="row">
      <h2> Description </h2> 
                        <p>'.$row['Description'] .'</p>
                        <pre style="background:inherit;border:none;">
   PRODUCT CODE  '.$row["PID"].'   <hr> 
   TITLE         '.$row["Title"].' <hr> 
   AUTHOR        '.$row["Author"].' <hr>
   AVAILABLE     '.$row["Available"].' <hr> 
   PUBLISHER     '.$row["Publisher"].' <hr> 
   EDITION       '.$row["Edition"].' <hr>
   LANGUAGE      '.$row["Language"].' <hr>
   PAGES         '.$row["page"].' <hr>
   WEIGHT        '.$row["weight"].' <hr>
                        </pre>
    </div>
  </div>
';
											

   			}
   		}
   		echo '</div>';



   ?>








   <div class="container-fluid" id="service">
   	<div class="row">
   		<div class="col-sm-6 col-md-3 text-center">
   			<span class="glyphicon-heart"></span><br>
   			24X7 Care<br>
   			Happy to help 24X7, call us on 0120-3062244 or click here
   		</div>
   		<div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-ok"></span> <br>
               Trust <br>
               Your money is yours! All refunds come with no question asked guarantee.
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-check"></span> <br>
               Assurance <br>
               We provide 100% assurance. If you have any issue, your money is immediately refunded. Sit back and enjoy your shopping.
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-tags"></span> <br>
               24X7 Care <br>
               Happiness is guaranteed. If we fall short of your expectations, give us a shout.
          </div>

   	</div>
   </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
  <script>
            $(function () {
                var link = $('#buyLink').attr('href');
                $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                $('#quantity').on('change', function () {
                    $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                });
            });
    </script>

</body>
</html>