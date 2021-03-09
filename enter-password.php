<?php
session_start();
$errors=[];
$Email = $_SESSION['email'];
$Conn = new mysqli ('Localhost','root','','sucasa_db');
$msg = "Registration successful.";
if ($Conn)
    if (isset($_POST['enter_password'])){

        $password1 = mysqli_real_escape_string($Conn, $_POST['password1']);
        $password2 = mysqli_real_escape_string($Conn, $_POST['password2']);


        if ($password1 != $password2 ){
            array_push($errors,"Incorrect confirmation password!");
        }

        if (strlen($password1)<8){
            array_push($errors,"Password must at least be 8 characters");
        }

        if (count($errors) == 0){
            $password_query = "UPDATE `Customer` SET `password`='$password1' WHERE `customer_email` = '$Email'";
            $password_query_result = mysqli_query($Conn,$password_query);

            if(!$Conn->query($password_query)){

                echo(mysqli_error($Conn));
            }
            else{
                $_SESSION['Msg'] = $msg;
                header("location:http://localhost/SuCasa-Eatery/log-in.php");
            }
        }
    }
    else{
        echo ($Conn->connect_error);
    }
?>
    <html lang="en">

    <head>

        <title> Enter Password </title>

        <meta charset="UTF-8">
        <link rel="stylesheet" href="libraries/bootstrap.min.css"/>
        <link rel="stylesheet" href="libraries/font-awesome.min.css"/>
        <link rel = stylesheet href ="libraries/fonts/custom-font/stylesheet.css"/>

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
        <img src="logo.png "  class=" logo-margin" height ="100" width="100"  >
        <h4 class="modal-title"> SuCasa Eatery</h4>
    </div>

    <div class="modal-body">
<?php include 'FormErrors.php'; ?>
    <div class = "col-12 form-input mx-auto">
<?php

if (isset($_SESSION['email'])){
    if ($Conn){
        $sql = "SELECT * FROM `Customer` WHERE `customer_email` = '$Email'";
        $result = $Conn->query($sql);

        if ($result->num_rows  > 0) {
            while ($row = mysqli_fetch_array($result)) {

                echo '<div class = "form-group col-xs-5 ">';

                echo '<form action="enter-password.php" method="post">';

                echo '<div class="form-group">';
                echo '<label for="text" > Customer Email  </label>';
                echo "<input type ='email' class ='form-control' name = 'email' value='{$row['customer_email']}' />";
                echo '</div>';

                echo '<div class="form-group">
                                           <label for = "Password"> Password </label>
                                           <input  = type = "password" class ="form-control" name="password1" placeholder = "Password" required />
                                      </div>
                                    
                                      <div class="form-group">
                                           <label for = "Password">Confirm Password </label>
                                           <input  = type = "password" class ="form-control" name="password2" placeholder = "Confirm Password" required />
                                      </div>
                                    
                                      <div class="text-right">
                                            <button type = "submit" class = "btn btn-outline-dark"   name = "enter_password" > Submit </button>
                                      </div>';

                echo '</form>';

                echo '</div>';
            }
        }
    }
    else{
        echo ($Conn->connect_error);
    }

}
?>