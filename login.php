<?php include 'header.php';?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

  
  	<!-- core CSS -->

    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">


    <!-- <link href="css/main.css" rel="stylesheet"> -->


    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/style_1.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style type="text/css">
        body {
  background: #DCDDDF;
  font-family: 'Open Sans', sans-serif;
  color:black;
  line-height: 22px;
}
body > section {
  padding: 70px 0;
}
    </style>

          
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

<!-- contact-form -->	

<section id="about-us">
<div class="container">
    <section id="content">
        <form action="login_proses.php" method="post">
            <h1>Login Form</h1>
            <div>
                <input type="text" placeholder="Username" required="" name="username" id="username" />
            </div>
            <div>
                <input type="password" placeholder="Password" required="" name="password" id="password" />
            </div>
            <div>
                <input type="submit" value="Log in" />
                
            </div>
        </form><!-- form -->
    </section><!-- content -->
</div><!-- container -->
</section>

	<?php include 'footer.php';?>

			
</body>
</html>