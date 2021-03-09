<?php
session_start()
?>
<html lang="en">
<head>

    <title> Customer Sign Up </title>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="libraries/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="libraries/fontawesome-free-5.6.3-web/css/all.css"/>
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
            color:#3c3c3c;
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
            text-align:left; }

        .form-control {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0);}


    </style>


</head>
<?php
$Conn = new mysqli ('Localhost','root','','sucasa_db');
$errors = [];
if ($Conn) {
    if (isset($_POST['sign_up'])) {

        $name = mysqli_real_escape_string($Conn, $_POST['name']);
        $email = mysqli_real_escape_string($Conn, $_POST['email']);
        $mobile = mysqli_real_escape_string($Conn, $_POST['mobile']);


        $sql = "INSERT INTO `Customer`(`customer_name`, `mobile_number`, `customer_email`)
                       VALUES ('$name','$mobile','$email')";

//        //Test the success of the insert query
//        if(!$Conn->query($sql)){
//            if (mysqli_errno($Conn) == 1062){
//                array_push($errors, "Email already used!");
//            }
//            else{
//                echo(mysqli_error($Conn));
//            }
//        }
        if (mysqli_errno($Conn) == 1062) {
            array_push($errors, "Email already used!");
        }

        //Test the success of the insert query
        if (! ($Conn->query($sql) )) {
            die("<font style='color:red'> Couldn't insert into database!  </font>" . $Conn->error);}

        else {
            $_SESSION['email'] = $email;
            header("location:enter-password.php");}
    }
}
else{
    echo($Conn->connect_error);}

?>
<body>
<div class = img >

    <div class = "modal-dialog">
        <div class = "modal-content">

            <div class="modal-header mx-auto ">
                <a href = "index.php"> <img src="logo.png" class=" logo-margin" height ="60" width="60"  > </a>
                <h4 class="modal-title"> SuCasa Eatery </h4>
            </div>

            <div class="modal-body  ">
                <?php include 'FormErrors.php'; ?>
                <div class = "col-sm-12 form-input mx-auto">

                    <form action="signup-customer.php" method="post">

                        <div class="form-group ">
                            <label for="text" > Customer Name  </label>
                            <input type ="text" class ="form-control" name = "name" placeholder="Customer Name"  required/>
                        </div>

                        <div class="form-group">
                            <label for = "email"> Customer Email </label>
                            <input  = type = "email" class ="form-control" name="email" placeholder = "Customer Email" required />
                        </div>

                        <div class="form-group">
                            <label for = "number"> Mobile Number </label>
                            <input  = type = "number" class ="form-control" name="mobile" placeholder = "Mobile Number" required />
                        </div>

                        <div class ="text-right">
                            <button type = "submit" class = "btn btn-outline-dark pull-right"   name = "sign_up" > Sign Up </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
</body>
</html>