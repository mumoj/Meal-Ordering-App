<?php
session_start();
session_unset(); //Unset the session variables from change of password.
$errors = [];

$Conn = new mysqli ('Localhost','root','','sucasa_db');
if ($Conn) {
    if (isset($_POST['search'])) {

        $Email = mysqli_real_escape_string($Conn, $_POST['email']);

        $sql = "SELECT * FROM `Customer` WHERE `customer_email` = '$Email'";
        $query = $Conn->query($sql);

        if ($query->num_rows > 0){

            $_SESSION['email'] = $Email;
            header('location:http://localhost/SuCasa-Eatery/change-password2.php');

        }
        else{
                array_push($errors, "Email not found!");
        }
    }
}
else{
    echo ($Conn->connect_error);
}

 ?>

<html lang="en">

<head>

    <title> Change Password </title>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.css"/>
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
    </style>


</head>

<body>
    <div class = img >

        <div class = "modal-dialog ">
            <div class = "modal-content">

                <div class="modal-header mx-auto">
                    <a href = "index.php"> <img src="logo.png " alt ="SuCasa Eatery" class=" logo-margin" height ="100" width="100"  > </a>
                    <h4 class="modal-title"> SuCasa Eatery</h4>
                </div>

                <div class="modal-body">


                    <div class = "col-12 form-input mx-auto">

                        <form action="change-password1.php" method="post">

                            <div class="form-group">
                                <label for="inputfield1" > Please enter your email  </label>
                                <input type ="email" class ="form-control" name = "email" placeholder="Customer Email" id = "inputfield1" required />
                            </div>
                            <?php include 'FormErrors.php'; ?>

                            <div class="text-right">
                                <button type = "submit" class="btn btn-outline-dark" name = "search"> Next </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>