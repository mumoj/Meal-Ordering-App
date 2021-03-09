<?php
//CONTINUE ORDER SESSION
session_start();
//Session variables
$dishes = $_SESSION['dishes'];
$bills_of_Dishes= $_SESSION['bills'];
$customer = $_SESSION['Customer'];
$email = $_SESSION['Customer_Email'];

$footer = "*Please note that this invoice has also been sent to your email(".$email."), and  that we also have a copy for the purposes of verification. \n \n* A member of staff will call you soon on your provided mobile number to enquire about your location.";

$DeliveryFee = 50 ;
function CalculateTotalBills($bills_of_Dishes ){
    $Total = 0;
    foreach($bills_of_Dishes as  $bill) {
        $Total = $Total + $bill;}
    return $Total   ;
}

//Connect to db
$Conn = new mysqli ('Localhost', 'root', '', 'sucasa_db');

//FPDF
require ('libraries/fpdf/fpdf.php');


class PDF extends FPDF
{
    //Define rounded rectangle
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
        if (strpos($corners, '2')===false)
            $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        if (strpos($corners, '3')===false)
            $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        if (strpos($corners, '4')===false)
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        if (strpos($corners, '1')===false)
        {
            $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
            $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

// Page header
    function Header()
    {
        $this->SetFillColor(203,201,163);
        $this->Rect(0, 0, 210, 297, 'FD');

        // Logo
        $this->Image('logo.png', 90, 13, 30 );
        // Line break
        $this->Ln(32);

        // Arial bold 15
        $this->SetFont('Times', 'B', 15);
        // Move to the right
        $this->Cell(79);
        // Title
        $this->Cell(50,10,'SuCasa Eatery','0','C' );

        // Line break
        $this->Ln(30);
    }

}

$pdf = new PDF('P','mm','A4');
$title = 'SuCasa Eatery Invoice';
$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->RoundedRect(37, 72, 135, 160, 5,'1234', 'D');

$Total = CalculateTotalBills($bills_of_Dishes)+$DeliveryFee;
$TotalLabel = 'Total  ';
$DeliveryFeeLabel = "Delivery Fee ";
$header = array('Dish [No. of Orders]','Cost in Ksh.');
$pdf->Ln(10); //Spacing btn title logo and table

$pdf->Cell(45,8); //Centering the table's column heading
//The Table
$pdf->Cell(47,12,$header[0],'B',0,'C' ) ;
$pdf->Cell(3,12,'','R',0,'C' ) ;
$pdf->Cell(3,12,'','',0,'C' ) ;
$pdf->Cell(47,12,$header[1],'B',0,'C' );
$pdf->Ln(3); //Spacing
foreach ($dishes as $i => $dish) {  //Selecting each  row
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln();
    $pdf->Cell(45, 12); //Centering the table rows
    $pdf->Cell(50,12,$dishes[$i],'R',0,'C');
    $pdf->Cell(40,12,$bills_of_Dishes[$i],'',0,'C');}

$pdf->SetFont('Arial', 'I', 12);
$pdf->Ln();
$pdf->Cell(45, 12);
$pdf->Cell(50,12,$DeliveryFeeLabel,'R',0,'C');
$pdf->Cell(40,12,$DeliveryFee,'',0,'C'); //Output Delivery Fee
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln();
$pdf->Ln(3);
$pdf->Cell(45, 3);
$pdf->Cell(25,3,'','',0,'R');
$pdf->Cell(50,3,'','T',0,'R');
$pdf->Ln();
$pdf->Cell(45, 7);
$pdf->Cell(25,7,'','',0,'R');
$pdf->Cell(25,7,$TotalLabel,'R',0,'R');
$pdf->Cell(25,7,$Total,'',0,'C'); //Output the total of the bills

$pdf->SetY(240);
// Arial italic
$pdf->SetFont('Arial','I',12);
$pdf->Cell(15,5);
$pdf->MultiCell(150,5,$footer,'','') ;

$invoice = $pdf->Output('', 'S'); // Dynamically save the invoice pdf as string to send as an attachment with PHP Mailer.


//PHPMAILER.
require 'libraries/PHPMailer-master/src/PHPMailer.php';
require 'libraries/PHPMailer-master/src/SMTP.php';
require 'libraries/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
$body = "Hello ".$customer.", attached is the invoice for your orders.";
//$address =
try {
    //SERVER CONFIGURATION
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sucasaeat@gmail.com';
    $mail->Password = '#Password1';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //PHP MAILER HEADERS
    $mail->setFrom('sucasaeat@gmail.com', 'SuCasa Eatery');
    $mail->addAddress($email);


    //Mail Subject
    $mail->Subject = 'SuCasa Eatery Invoice';

    //Mail body
    $mail->Body = $body;

    $mail->addStringAttachment($invoice, 'invoice.pdf');

    $mail->send();
    $pdf->Output();
} catch (Exception $e) {
    echo "<div style='color: red;'>Message could not be sent</div>"." 
        Mailer Error: {$mail->ErrorInfo}";
}





