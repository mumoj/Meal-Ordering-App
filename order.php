<?php
session_start();
//Session variables
 $customer = $_SESSION['Customer'];
 $email = $_SESSION['Customer_Email'];

//Definition of other variables
$Conn = new mysqli ('Localhost','root','','sucasa_db');
$dishes = [];
$bills_of_Dishes = [];
$errors = [];

if ($Conn) {
    //  Data validation
    if (isset($_POST['get-invoice'])) {

        if (isset($_POST['dishANo']) && ($_POST['dishANo'] > 0) ){
            $dishA = mysqli_real_escape_string($Conn, $_POST['dishA']);
            $dishANo = mysqli_real_escape_string($Conn,$_POST['dishANo']);
            $sql = "SELECT price FROM Menu WHERE item_name = '$dishA'"; //  Find the price of a dish
            $result = mysqli_query($Conn, $sql);

            if (mysqli_num_rows($result) == 1){
                if ($row = mysqli_fetch_array($result)) {
                    $price = $row['price'];
                    $dish_Bill = $price * $dishANo;
                    $dishA  = ($dishA.'['.$dishANo.']');
                    array_push($dishes,$dishA);
                    array_push($bills_of_Dishes,$dish_Bill);}
            }
            else{
                echo('<div style="color: red;"> Server issue: Dish A not found in database! </div> Make sure the option values in the order form exactly match the item_names in the Menu table ');}
        }
        if (isset($_POST['dishBNo']) && ($_POST['dishBNo'] > 0) ){
            $dishB = mysqli_real_escape_string($Conn, $_POST['dishB']);
            $dishBNo = mysqli_real_escape_string($Conn,$_POST['dishBNo']);
            $sql =  "SELECT price FROM Menu WHERE item_name = '$dishB'";  //  Find the price of a dish
            $result = mysqli_query($Conn, $sql);

            if (mysqli_num_rows($result) == 1){
                if ($row = mysqli_fetch_array($result)) {
                    $price = $row['price'];
                    $dish_Bill = $price * $dishBNo;
                    $dishB  = ($dishB.'['.$dishBNo.']');
                    array_push($dishes,$dishB);
                    array_push($bills_of_Dishes,$dish_Bill);}
            }
            else{
                echo('<div style="color: red;"> Server issue: Dish B not found in database! </div> Make sure the option values in the order form exactly match the item_names in the Menu table ');}
        }
        if (isset($_POST['dishCNo']) && ($_POST['dishCNo'] > 0) ){
            $dishC = mysqli_real_escape_string($Conn, $_POST['dishC']);
            $dishCNo = mysqli_real_escape_string($Conn,$_POST['dishCNo']);
            $sql =  "SELECT price FROM Menu WHERE item_name = '$dishC'";  //  Find the price of a dish
            $result = mysqli_query($Conn, $sql);

            if (mysqli_num_rows($result) == 1){
                if ($row = mysqli_fetch_array($result)) {
                    $price = $row['price'];
                    $dish_Bill = $price * $dishCNo;
                    $dishC  = ($dishC.'['.$dishCNo.']');
                    array_push($dishes,$dishC);
                    array_push($bills_of_Dishes,$dish_Bill);}
            }
            else{
                echo('<div style="color: red;"> Server issue: Dish C not found in database! </div> Make sure the option values in the order form exactly match the item_names in the Menu table ');}
        }
        if (isset($_POST['dishDNo']) && ($_POST['dishDNo'] > 0) ){
            $dishD = mysqli_real_escape_string($Conn, $_POST['dishD']);
            $dishDNo = mysqli_real_escape_string($Conn,$_POST['dishDNo']);
            $sql =  "SELECT price FROM Menu WHERE item_name = '$dishD'";  //  Find the price of a dish
            $result = mysqli_query($Conn, $sql);

            if (mysqli_num_rows($result) == 1){
                if ($row = mysqli_fetch_array($result)) {
                    $price = $row['price'];
                    $dish_Bill = $price * $dishDNo;
                    $dishD  = ($dishD.'['.$dishDNo.']');
                    array_push($dishes,$dishD);
                    array_push($bills_of_Dishes,$dish_Bill);}
            }
            else{
                echo('<div style="color: red;"> Server issue: Dish D not found in database! </div> Make sure the option values in the order form exactly match the item_names in the Menu table ');}
        }
        if (isset($_POST['dishENo']) && ($_POST['dishENo'] > 0) ){
            $dishE = mysqli_real_escape_string($Conn, $_POST['dishE']);
            $dishENo = mysqli_real_escape_string($Conn,$_POST['dishENo']);
            $sql =  "SELECT price FROM Menu WHERE item_name = '$dishE'";  //  Find the price of a dish
            $result = mysqli_query($Conn, $sql);

            if (mysqli_num_rows($result) == 1){
                if ($row = mysqli_fetch_array($result)) {
                    $price = $row['price'];
                    $dish_Bill = $price * $dishENo;
                    $dishE  = ($dishE.'['.$dishENo.']');
                    array_push($dishes,$dishE);
                    array_push($bills_of_Dishes,$dish_Bill);}
            }
            else{
                echo('<div style="color: red;"> Server issue: Dish E not found in database! </div> Make sure the option values in the order form exactly match the item_names in the Menu table ');}
        }
        if (count($dishes) == 0){
            array_push($errors, "Attention! You have not ordered any dish");}
        else {
            $_SESSION['dishes'] = $dishes;
            $_SESSION['bills'] = $bills_of_Dishes;
            $_SESSION['customer_email'] =  $email;
            $_SESSION['Customer']= $customer;
            $_SESSION['Customer_Email'] =  $email;
            header("location:invoice.php");}
    }

}

 ?>

<html lang="en">
<head>

    <title> Make an Order  </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <link rel="stylesheet" href="libraries/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="libraries/fontawesome-free-5.6.3-web/css/all.css"/>
    <link rel=stylesheet href="libraries/fonts/custom-font/stylesheet.css"/>


    <style type="text/css">

        .navbar {
            transition: all 0.4s;
        }
        .navbar .nav-link {
            color: #000000;
            font-size: larger;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: rgb(87, 87, 71);
            text-decoration: none;
        }

        /* Main page style*/
        body, html {
            height: auto;
            margin: 0;
            font-family: SansSerif;
            color: black;}

        h2 {
            font-family: castamere_sansregular;
            color: #3c3c3c;
            font-size: large;}

        .img {
            background-image: url("background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
            position: relative;}

        .modal-dialog {
            margin-top: 50px;
            right: 300px;
            position: absolute;
            text-align: center;}

        .modal-ku {
            width: 900px;}

        .modal-header {
            display: block;
            width: fit-content;
            border-bottom-color: rgba(0, 0, 0, 0);}

        .modal-content {
            background-color: rgba(181, 179, 142, 0.91);
            opacity: 0.9;
            padding: 0 18px;
            border-radius: 10px;}

        .modal-body {
            text-align: left;}

        .keep-on-line{
            padding-left: 50px;
            white-space: nowrap;
            text-align: end}

        .form-group {
            display: inline-block;
            vertical-align: top;
            padding-left: ;
        }

        .form-control {
            display: inline-block;
            vertical-align: top;
            z-index: 5;
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            opacity: 1;}

        option{
            background-color: #fffde7;
            border:none; }

        option:hover {
            background-color: #1C1C25;}

    </style>
</head>

<body>
<div class = img >
    <header class="header">
        <nav class="navbar navbar-expand-sm fixed-top py-3">
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link "> <i class="far fa-user"> </i> </a></li>
                    <li class="nav-item"> <a class="nav-link" href = "DestroySession.php" > Log Out </a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class = "modal-dialog modal-lg modal-ku ">
        <div class = "modal-content">

            <div class="modal-header ">
                <a href = "index.php"> <img src="logo.png" class=" logo-margin" alt="SuCasa Eatery" height ="60" width="60"  > </a>
                <h2> SuCasa Eatery </h2>
            </div>
            <div class="modal-body">
                <?php include 'FormErrors.php'; ?>
                <div class =  form-input">
                    <form action="order.php" method="post" id = "orderPage">

                        <div class = "row"  >
                                <div class="form-group col-md-5 ">
                                    <div class = keep-on-line >
                                        <label  style= "text-align: center;" > Dish Type A & Number of Orders </label>
                                        <br>
                                        <select name="dishA" form = "orderPage" class = "form-control" >
                                            <option value="Githeri"> Githeri </option>
                                            <option value="Pilau"> Pilau </option>
                                            <option value="Quarter Chicken"> Quarter Chicken </option>
                                            <option value="Half Chicken">Half Chicken </option>
                                            <option value="Full Chicken">Full Chicken </option>
                                            <option value="Rice & Stew ">Rice & Stew </option>
                                        </select>
                                        <input type = "number" class = "form-control col-md-3 "  name = "dishANo" placeholder="0"  min ='0' max="9" />
                                    </div>
                                </div>

                                <div class="col-md-5 form-group" >
                                    <div class = keep-on-line >
                                        <label> Dish Type B & Number of Orders </label>
                                        <br>
                                        <select name="dishB" form = "orderPage" class = "form-control" >
                                            <option value="Githeri">Githeri</option>
                                            <option value="Pilau">Pilau</option>
                                            <option value="Quarter Chicken"> Quarter Chicken </option>
                                            <option value="Half Chicken"> Half Chicken </option>
                                            <option value="Full Chicken"> Full Chicken </option>
                                            <option value="Rice & Stew "> Rice & Stew </option>
                                        </select>
                                        <input type = "number" class = "form-control col-md-3"  name = "dishBNo" placeholder="0" min ='0' max="9" />
                                    </div>
                                </div>
                        </div>
                        <br>
                        <div class = "row"  >
                            <div class="form-group col-md-5 ">
                                <div class = keep-on-line >
                                    <label  style= "text-align: center;" > Dish Type C & Number of Orders </label>
                                    <br>
                                    <select name="dishC" form = "orderPage" class = "form-control" >
                                        <option value="Githeri">Githeri</option>
                                        <option value="Pilau">Pilau</option>
                                        <option value="Quarter Chicken"> Quarter Chicken </option>
                                        <option value="Half Chicken">Half Chicken </option>
                                        <option value="Full Chicken">Full Chicken </option>
                                        <option value="Rice & Stew ">Rice & Stew </option>
                                    </select>
                                    <input type = "number" class = "form-control col-md-3 "  name = "dishCNo" placeholder="0" min ='0' max="9" />
                                </div>
                            </div>

                            <div class="col-md-5 form-group" >
                                <div class = keep-on-line >
                                    <label> Dish Type D & Number of Orders </label>
                                    <br>
                                    <select name="dishD" form = "orderPage" class = "form-control" >
                                        <option value="Githeri">Githeri</option>
                                        <option value="Pilau">Pilau</option>
                                        <option value="Quarter Chicken"> Quarter Chicken </option>
                                        <option value="Half Chicken">Half Chicken </option>
                                        <option value="Full Chicken">Full Chicken </option>
                                        <option value="Rice & Stew ">Rice & Stew </option>
                                    </select>
                                    <input type = "number" class = "form-control col-md-3"  name = "dishDNo" placeholder="0" min ='0' max="9" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class = "row"  >
                            <div class="form-group col-md-5 ">
                                <div class = keep-on-line >
                                    <label  style= "text-align: center;" > Dish Type E & Number of Orders </label>
                                    <br>
                                    <select name="dishE" form = "orderPage" class = "form-control" >
                                        <option value="Githeri">Githeri</option>
                                        <option value="Pilau">Pilau</option>
                                        <option value="Quarter Chicken"> Quarter Chicken </option>
                                        <option value="Half Chicken">Half Chicken </option>
                                        <option value="Full Chicken">Full Chicken </option>
                                        <option value="Rice & Stew ">Rice & Stew </option>
                                    </select>
                                    <input type = "number" class = "form-control col-md-3 "  name = "dishENo" placeholder="0" min ='0' max="9"  />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style = "color: #FFFFFF; "">
                            ! Please  note that deliveries are only done within Moi University Campus at a flat rate of KSh.50.
                            <br>
                            *Also, note that an order generally refers to a plate of a particular meal. For instance, one order of Githeri constitutes a plate of githeri.
                            One can order several types of dishes, upto a  maximum of five.
                        </div>
                        <div class="text-right" >
                            <button type = "submit" class="btn btn-outline-dark" name = "get-invoice"> Get Invoice  </button><BR>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</div>
</body>
</html>