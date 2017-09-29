<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">

    <title>CTIS - ISC</title>

    <!-- css for the form -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- css for animations -->
    <link rel='stylesheet prefetch' href='css/animate.min.css'>

    <!-- css for fonts -->
	<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700'>
	<link rel='stylesheet prefetch' href='font-awesome/css/font-awesome.min.css'>
  </head>

  <body>

	<div class='form aniamted bounceIn'>
	  <div class='switch'>
	    <i class='fa fa-pencil fa-times'></i>
	    <div class='tooltip'>Register</div>
	  </div>
	  <div class='login'>
	    <h2>Interactive Soil Characterization</h2>
	    <!-- <img src="img/logo.bmp" style="width: 60%; height: 60%"> original -->
      <img src="img/ctis_transparent_2017.png" style="width: 60%; height: 60%"> <br> <br>
      <!-- <img src="" style="height: max-width: 80px; max-height: 80px;" align="right"> -->
	    <form name="login" action="loginhandler.php" method="post">
	                <input placeholder="username" type="text" name="username" id="uid" value="" />
	                <input placeholder="********" type="password" name="password" id="pwd" value=""/>
	                <input type="submit" name="submit" value="Submit" />
	    </form>
	  </div>
	  <div class='register'>
	    <h2>Create An Account</h2>
	    <div class='alert alert-dismissible fade in'>
		    <div class='fa fa-times-circle' data-dismiss="alert"></div>
	      Register here.
	    </div>
	    <form name="login" action="loginhandler.php" method="post">
	      <input placeholder='Username' type='text' name="uid" id="uid"/>
	      <input placeholder='Password' type='password' name="pwd" id="pwd"/>
	      <input placeholder='Email Address' type='email' name="eml" id="eml"/>
	      <input placeholder='First Name' type='text' name="fna" id="fna"/>
	      <input placeholder='Last Name' type='text' name="lna" id="lna"/>
	      <input placeholder='Phone' type='text' name="phn" id="phn"/>
	      <input type = "hidden" name = "request" value ="true" />
	      <input type="submit" name="register" value="Submit" />
	    </form>
	  </div>

	</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/bootstrap.min.js"></script>


    <script>
    	$('.switch').click(function(){
		   $(this).children('i').toggleClass('fa-pencil');
		   $('.login').animate({height: "toggle", opacity: "toggle"}, "slow");
		   $('.register').animate({height: "toggle", opacity: "toggle"}, "slow");
		});
    </script>





  </body>
</html>
