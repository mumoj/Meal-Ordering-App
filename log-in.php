<?php
session_start();
$Conn = new mysqli ('Localhost','root','','sucasa_db');
$errors = [];
if ($Conn) {
    if (isset($_POST['submit'])) {

        session_unset(); //Unset change of password and sign up session variables.

        $Email = mysqli_real_escape_string($Conn, $_POST['email']);
        $Password = mysqli_real_escape_string($Conn, $_POST['password']);


        $password = md5($Password);//Encryprt password before comparing it with the database's
        $query = "SELECT * FROM Customer WHERE customer_email ='$Email' AND password ='$Password'";
        $result = mysqli_query($Conn, $query);

        if (mysqli_num_rows($result)== 1){
            if ($row = mysqli_fetch_array($result)) {
                $Email = $row['customer_email'];
                $Customer = $row['customer_name'];

                $_SESSION['Customer'] = $Customer;
                $_SESSION['Customer_Email'] = $Email;

                header('location:order.php'); // Redirect to order page
            }
        }
        else{
            array_push($errors, "The email/password combination is wrong");

        }

    }
}
else{
   echo('Database connection failed') ;

}
 ?>

<html lang="en">

<head>

    <title> Log In </title>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css " href="libraries/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css " href="libraries/css/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="libraries/fontawesome-free-5.6.3-web/css/all.css"/>
    <link rel = stylesheet type="text/css" href ="libraries/fonts/custom-font/stylesheet.css"/>

    <script  src ="libraries/bootstrap.bundle.min.js"> </script>


    <style type="text/css">

        /* Main page style*/
        body, html{
            height: auto;
            margin:0;
            font-family: SansSerif;
            color: black;}

        h4{
            font-family: castamere_sansregular;
            color: #3c3c3c;
            font-size: large;}

        .img{
            background-image: url("background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position:center;
            height: 100%;
            position: relative;}

        .modal-dialog {
            margin-top:90px;
            position:absolute;
            right:520px;
            text-align:center;}

        .modal-header{
            display: block;
            width: fit-content;
            border-bottom-color: rgba(0, 0, 0, 0);}

        .modal-content{
            background-color: rgba(181, 179, 142, 0.91);
            opacity:0.9;
            padding:0 18px;
            border-radius:10px;}

        .modal-body{
            text-align: left;}

        .form-control {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}

        a:link, a:visited {

            color: rgb(255, 255, 255);
            text-align: center;
            text-decoration: none;
            display: inline-block;}

        a:hover, a:active {
            color: #040403;}

    </style>


</head>

<body>
    <div class = img >

        <div class = "modal-dialog ">
            <div class = "modal-content">

                <div class="modal-header mx-auto">
                    <a href = "index.php"> <img src="logo.png" class=" logo-margin" alt="SuCasa Eatery" height ="100" width="100"  > </a>
                    <h4> SuCasa Eatery</h4>
                </div>
                <?php
                if (isset($_SESSION['Msg'])){
                    $msg = $_SESSION['Msg'];
                echo "<div style='color: #007700'><h6> $msg<h6>
                </div>";
                }
                ?>
                <div class="modal-body">

                    <?php include 'FormErrors.php'; ?>
                    <div class = "col-12 form-input mx-auto">

                        <form action="log-in.php" method="post">

                            <div class="form-group">
                                <label for="inputfield1" > Customer Email  </label>
                                <input type ="email" class ="form-control" id = "inputfield1" name = "email" placeholder="Customer Email" required />
                            </div>

                            <div class="form-group">
                                <label for = "inputfield2"> Password </label>
                                <input  = type = "password" class ="form-control" id = "inputfield2" name="password" placeholder = "Password" required />
                            </div>
                            <br>
                            <div class="text-center" >
                                <button type = "submit" class="btn btn-outline-dark" name = "submit"> Log In </button><BR>
                                <br>
                                <a href = "signup-customer.php" > Not a member ? Sign Up  </a><BR>
                                <a href = "change-password1.php" > Change Password  </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>




</body>
</html>