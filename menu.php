<?php
//Connect to db
$Conn = new mysqli ('Localhost','root','','sucasa_db');

//Function to fetch rows
function runQuery($query){
    $Conn = new mysqli ('Localhost','root','','sucasa_db');
    $result = mysqli_query($Conn,$query);
    while ($row = mysqli_fetch_assoc($result)) {
        $resultset[] = $row;
    }
    if (!empty($resultset)){
        return $resultset;
    }
}

require('libraries/fpdf/fpdf.php');

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
        $this->Cell(78);
        // Title
        $this->Cell(50,10,'SuCasa Eatery','0','C' );

        // Line break
        $this->Ln(30);
    }
}

$pdf = new PDF('P','mm','A4');
$title = 'SuCasa Eatery Menu';
$pdf->SetTitle($title);
$pdf->AddPage();

$pdf->RoundedRect(37, 72, 135, 160, 5,'1234', 'D');

$header = array('Dish','Price in Shillings');
$query = "SELECT `item_name`, `price` FROM `Menu`";
$rows = runQuery($query);

$pdf->Ln(10);
$pdf->Cell(50,12); //Centering the table's column heading
$pdf->Cell(42,12,$header[0],'B',0,'C' ) ;
$pdf->Cell(3,12,'','R',0,'C' ) ;
$pdf->Cell(3,12,'','',0,'C' ) ;
$pdf->Cell(42,12,$header[1],'B',0,'C' );
$pdf->Ln(10); //vertical Spacing
foreach ($rows as $row)  {  //Selecting each  row
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    $pdf->Cell(50,12); //Centering the table rows
    $pdf->Cell(45,12,$row['item_name'],'R',0,'C');
    $pdf->Cell(40,12,$row['price'],'',0,'C');

}


$pdf->Output();










