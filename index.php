<?php
//Destroy any session variables on going back to the index page.
session_start();
session_unset();
session_destroy();
?>
<! DOCTYPE html>
<html lang="en">

<?php
session_start();
session_unset();
session_destroy();
?>

<head>

    <title> Welcome to SuCasa Eatery </title>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="libraries/bootstrap.min.css"/>
    <link rel="stylesheet" href="libraries/font-awesome.min.css"/>
    <link rel= "stylesheet" href= "index.php" />
    <link rel = stylesheet href ="libraries/fonts/custom-font/stylesheet.css"/>
    <script  src ="libraries/bootstrap.bundle.min.js"> </script>
    <script src="libraries/jquery-3.4.1.js"> </script>

    <style type="text/css">
        /* Navigation bar css styling */
        .navbar {
            transition: all 0.4s;
        }
        .navbar .nav-link {
            color: #fff;
            font-size: larger;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: #a19f7c;
            text-decoration: none;
        }

        /* Change navbar styling on scroll */
        .navbar.active {
            background: rgba(0, 0, 0, 0);
            box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar.active .nav-link {
            color: #f8fcff;
        }
        .navbar.active .nav-link:hover,
        .navbar.active .nav-link:focus {
            color: #ffb40d;
            text-decoration: none;
        }

        /* Main page stlye*/
        body, html{
            height: auto;
            margin:0;
            font-family:SansSerif;
        }
        h3{
            font-family: castamere_sansregular;
           color: #dadada;
        }
        .img{
            background-image: url("background1.jpg");
            background-color: #cbc9a3;
            background-size: cover;
            background-repeat: no-repeat;
            background-position:center;
            height: 100%;
            z-index: 1;
        }
        .logo{
            background-color: rgba(140, 81, 6, 0);
            padding: 120px 0;
            text-align: center;
            z-index: 2;

        }
        img.resize{
            height:40%;
            width:20%;

        }
    </style>

</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="menu.php" class="nav-link ">Menu</a></li>
                        <li class="nav-item"><a href="log-in.php" class="nav-link">Make an Order</a></li>
                        <li class="nav-item"><a href="signup-customer.php" class="nav-link ">Sign Up</a> </li>
                    </ul>
                </div>
        </nav>
    </header>

    <div class = img >
        <div class = logo>
            <img class=resize  src= logo.png alt="Eatery Logo">
            <h3> <font color="#cbc9a3">  SuCasa Eatery </font>  </h3>
        </div>
    </div>

</body>



</html>


